<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        // Check if the form is submitted
        if ($this->request->getMethod() === 'post') {
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
            if ($user && password_verify($password, $user['password'])) {
                // Set session data
                session()->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'logged_in' => true,
                    'access_level' => $user['access_lvl']
                ]);

                // Redirect to the dashboard or home page
                return redirect()->to('/dashboard');
            } else {
                // If login fails, show an error message
                session()->setFlashdata('error', 'Invalid username or password');
                return redirect()->back()->withInput();
            }
        }

        // Load the login view
        return view('auth/login');
    }

    
    public function register()
{
    $validation = \Config\Services::validation();
    
    // Check if the form is submitted
    if ($this->request->getMethod() === 'post') {
        $rules = [
            'username' => 'required|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).+$/]|differs[username]',
            'confirm_password' => 'required|matches[password]',
            'full_name' => 'required'
        ];

        if (!$this->validate($rules)) {
            return view('auth/register', [
                'validation' => $validation,
                'data' => $this->request->getPost()
            ]);
        }

        // Continue with saving the user...
    }

    // Load the register view
    return view('auth/register', [
        'data' => [] // Initial values if any
    ]);
}


    
    public function logout()
    {
        // Destroy the session and redirect to the login page
        session()->destroy();
        return redirect()->to('/login');
    }
}
