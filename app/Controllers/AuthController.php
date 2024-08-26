<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\DepartmentModel;

class AuthController extends BaseController
{
 
    public function login()
{
    // Check if the form is submitted
    if ($this->request->getMethod() === 'POST') {
        // Validate the form inputs
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // If validation fails, return to the login page with errors
            return view('auth/login', ['validation' => $this->validator]);
        }

        // Retrieve form data
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Load the UserModel
        $userModel = new UserModel();

        // Find the user by username or email
        $user = $userModel->where('username', $username)
                          ->orWhere('email', $username)
                          ->first();

        // Check if user exists and password matches
        if ($user) {
            // Check if user is active
            if ($user['active'] != 1) {
                // If user is not active, show an error message
                session()->setFlashdata('error', 'Inactive account.');
                return redirect()->back()->withInput();
            }

            if (password_verify($password, $user['password'])) {
                // Set session data
                session()->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'logged_in' => true,
                    'access_level' => $user['access_lvl'],
                    'department_id' => $user['department_id'] // Add department_id to session
                ]);

                // Set flashdata with the username
                session()->setFlashdata('success', 'Logged in as ' . $user['username']);

                // Redirection based on access level and department ID
                $accessLevel = $user['access_lvl'];
                $departmentId = $user['department_id'] ?? null;

                if ($accessLevel == 1 || $accessLevel == 2) {
                    return redirect()->to('/home'); // Redirect to home for access level 1 or 2
                } elseif ($accessLevel != 1 && $accessLevel != 2) {
                    if ($departmentId == 1) {
                        return redirect()->to('/careers'); // Redirect to careers if department ID is 1
                    } elseif ($departmentId == 2) {
                        return redirect()->to('/tenders'); // Redirect to tenders if department ID is 2
                    } else {
                        return redirect()->to('/access-denied')->with('error', 'You do not have access to the system.'); // Redirect to access denied if no department ID
                    }
                }
            } else {
                // If password does not match, show an error message
                session()->setFlashdata('error', 'Invalid username or password');
                return redirect()->back()->withInput();
            }
        } else {
            // If user does not exist, show an error message
            session()->setFlashdata('error', 'Invalid username or password');
            return redirect()->back()->withInput();
        }
    }

    // Load the login view
    return view('auth/login');
}


public function register()
{
    $method = $this->request->getMethod();

    if ($method === 'POST') {
        $userModel = new UserModel();
        $departmentModel = new DepartmentModel();

        // Define validation rules
        $rules = [
            'username' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).+$/]|differs[username]',
            'full_name' => 'required|min_length[3]|max_length[100]',
            'access_lvl' => 'required|integer|in_list[1,2,3]',
            'department_id' => 'required|integer'
        ];

        // Define custom validation messages
        $messages = [
            'username' => [
                'is_unique' => 'This username is already taken.'
            ],
            'email' => [
                'is_unique' => 'This email is already registered.'
            ],
            'password' => [
                'regex_match' => 'Password must include at least one uppercase letter, one lowercase letter, one special character, and be at least 8 characters long.',
                'differs' => 'Password must not be similar to username.'
            ]
        ];

        // Perform validation
        if (!$this->validate($rules, $messages)) {
            return view('auth/register', [
                'validation' => $this->validator,
                'data' => $this->request->getPost(),
                'departments' => $departmentModel->findAll(),
                'access_levels' => [
                    1 => 'Superuser',
                    2 => 'Admin',
                    3 => 'Staff'
                ],
                'title' => 'Register'
            ]);
        }

        // Prepare user data for insertion
        $userData = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'full_name' => $this->request->getPost('full_name'),
            'access_lvl' => $this->request->getPost('access_lvl'),
            'department_id' => $this->request->getPost('department_id')
        ];

        if ($userModel->insert($userData)) {
            session()->setFlashdata('success', 'Successfully added Staff.');
            return redirect()->to('/staffs');
        } else {
            session()->setFlashdata('error', 'Registration failed. Please try again.');
            return redirect()->back()->withInput();
        }
    }

    $departmentModel = new DepartmentModel();
    return view('auth/register', [
        'data' => [],
        'departments' => $departmentModel->findAll(),
        'access_levels' => [
            1 => 'Superuser',
            2 => 'Admin',
            3 => 'Staff'
        ],
        'title' => 'Register'
    ]);
}


public function editStaff($id)
{
    // Log the ID being processed
    log_message('info', 'Editing staff with ID: ' . $id);

    // Check if user is logged in
    if (!session()->get('logged_in')) {
        return redirect()->to('/login')->with('error', 'You must be logged in to access this page.');
    }

    // Check user access level (only users with access level 1 or 2 can update staff)
    $currentUserAccessLevel = session()->get('access_level');
    if ($currentUserAccessLevel < 1 || $currentUserAccessLevel > 2) {
        return redirect()->to('/')->with('error', 'You do not have permission to edit staff.');
    }

    $userModel = new UserModel();
    $departmentModel = new DepartmentModel();

    // Find the user by ID
    $user = $userModel->find($id);

    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    if ($this->request->getMethod() === 'POST') {
        // Extract input values
        $inputUsername = $this->request->getPost('username');
        $inputEmail = $this->request->getPost('email');

        // Validation rules for the controller
        $rules = [
            'username' => [
                'rules' => 'permit_empty|min_length[3]|max_length[20]|is_unique[users.username,id,' . $id . ']',
                'errors' => [
                    'is_unique' => 'The username is already taken.'
                ]
            ],
            'email' => [
                'rules' => 'permit_empty|valid_email|is_unique[users.email,id,' . $id . ']',
                'errors' => [
                    'is_unique' => 'The email is already registered.'
                ]
            ],
            'full_name' => 'required|min_length[3]|max_length[100]',
            'department_id' => 'required|integer',
            'access_lvl' => 'required|integer|in_list[1,2,3]'
        ];

        // Validation messages
        $messages = [
            'username' => [
                'is_unique' => 'The username is already taken.'
            ],
            'email' => [
                'is_unique' => 'The email is already registered.'
            ]
        ];

        // Perform validation
        if (!$this->validate($rules, $messages)) {
            // Debugging: Output validation errors
            log_message('error', 'Validation Errors for ID ' . $id . ': ' . print_r($this->validator->getErrors(), true));

            return view('auth/edit', [
                'validation' => $this->validator,
                'data' => $user,
                'departments' => $departmentModel->findAll(),
                'access_levels' => [
                    1 => 'Superuser',
                    2 => 'Admin',
                    3 => 'Functional User'
                ],
                'title' => 'Edit Staff'
            ]);
        }

        // Prepare the updated user data
        $updatedUserData = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'full_name' => $this->request->getPost('full_name'),
            'department_id' => $this->request->getPost('department_id'),
            'access_lvl' => $this->request->getPost('access_lvl')
        ];

        try {
            if ($userModel->update($id, $updatedUserData)) {
                log_message('info', 'Successfully updated staff with ID: ' . $id);
                return redirect()->to('/staffs')->with('success', 'Staff details updated successfully.');
            } else {
                // Debugging: Output model errors
                log_message('error', 'Model Update Errors for ID ' . $id . ': ' . print_r($userModel->errors(), true));

                $errors = $userModel->errors();
                return redirect()->back()->with('error', $errors ? implode(', ', $errors) : 'Failed to update staff details. Please try again.');
            }
        } catch (\Exception $e) {
            log_message('error', 'Exception updating staff with ID ' . $id . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    return view('auth/edit', [
        'data' => $user,
        'departments' => $departmentModel->findAll(),
        'access_levels' => [
            1 => 'Superuser',
            2 => 'Admin',
            3 => 'Functional User'
        ],
        'title' => 'Edit Staff'
    ]);
}


    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }


    public function updateStaffStatus($id)
    {
        $userModel = new UserModel();
        
        // Fetch the current user's active status
        $user = $userModel->find($id);

        if (!$user) {
            // Handle the case where the user does not exist
            return redirect()->back()->with('error', 'User not found.');
        }

        // Toggle the active status
        $newStatus = $user['active'] == 1 ? 0 : 1;

        // Update the status
        $updateData = ['active' => $newStatus];
        
        $userModel->update($id, $updateData);

        return redirect()->back()->with('success', 'User status updated successfully.');
    }



}
