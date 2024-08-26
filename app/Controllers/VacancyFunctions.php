<?php namespace App\Controllers;

use App\Models\VacancyFunctionModel;
use App\Models\UserModel;

class VacancyFunctions extends BaseController
{
    protected $vacancyFunctionModel;

    public function __construct()
    {
        $this->vacancyFunctionModel = new VacancyFunctionModel();
    }

    
    public function job_functions()
    {
        $data['title'] = 'Vacancy Functions';

        
        $data['vacancy_functions'] = $this->vacancyFunctionModel->findAll();

        
        $usersModel = new UserModel();
        $data['users'] = $usersModel->findAll();

        return view('careers/job_functions.php', $data);
    }

    // Create Vacancy Function
    public function create()
    {
        // Load validation library
        $validation = \Config\Services::validation();

        if ($this->request->getMethod() === 'POST') {
            // Define validation rules
            $rules = [
                'name' => 'required|min_length[3]|max_length[255]',
            ];

            // Validate input
            if (! $this->validate($rules)) {
                // Get validation errors
                $data['validation'] = $this->validator;
                $data['title'] = 'Create Vacancy Function'; // Set title for the view
                return view('vacancy_functions/create', $data);
            }

            // Retrieve the logged-in user's ID
            $userID = session()->get('user_id');

            // Check if user ID is set
            if (!$userID) {
                // Handle the case where user ID is not available
                return redirect()->to('/login')->with('error', 'User not logged in.');
            }

            // Prepare data for insertion
            $data = [
                'name'        => $this->request->getPost('name'),
                'created_by'  => $userID, // Set the creator ID dynamically
                'updated_by'  => $userID  // Set the updater ID dynamically
            ];

            // Insert data into the database
            $this->vacancyFunctionModel->insert($data);

            // Redirect to the list of vacancy functions
            return redirect()->to('/vacancy_functions');
        }

        // Set title for the view
        $data['title'] = 'Create Vacancy Function';

        // Display the creation form
        return view('vacancy_functions/create', $data);
    }

    // Edit Vacancy Function
    public function edit($id)
    {
        // Retrieve the vacancy function by ID
        $vacancyFunction = $this->vacancyFunctionModel->find($id);

        // Check if the vacancy function exists
        if (!$vacancyFunction) {
            // Handle the case where the vacancy function does not exist
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Vacancy function not found');
        }

        // Load validation library
        $validation = \Config\Services::validation();

        if ($this->request->getMethod() === 'POST') {
            // Define validation rules
            $rules = [
                'name' => 'required|min_length[3]|max_length[255]',
            ];

            // Validate input
            if (! $this->validate($rules)) {
                // Get validation errors
                $data['validation'] = $this->validator;
                $data['vacancy_function'] = $vacancyFunction;
                $data['title'] = 'Edit Vacancy Function'; // Set the title
                return view('vacancy_functions/edit', $data);
            }

            // Retrieve the logged-in user's ID
            $userID = session()->get('user_id'); // Adjust based on your session data

            // Prepare data for update
            $data = [
                'name'        => $this->request->getPost('name'),
                'updated_by'  => $userID // Set the updater ID dynamically
            ];

            // Update the vacancy function in the database
            $this->vacancyFunctionModel->update($id, $data);

            // Redirect to the list of vacancy functions
            return redirect()->to('/vacancy_functions');
        }

        // Pass the vacancy function data and title to the view
        $data['vacancy_function'] = $vacancyFunction;
        $data['title'] = 'Edit Vacancy Function'; // Set the title
        return view('vacancy_functions/edit', $data);
    }

    // Delete Vacancy Function
    public function delete($id)
    {
        $this->vacancyFunctionModel->delete($id);
        return redirect()->to('/vacancy_functions');
    }
}
