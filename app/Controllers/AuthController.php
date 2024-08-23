<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

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
            if ($user && password_verify($password, $user['password'])) {
                // Set session data
                session()->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'logged_in' => true,
                    'access_level' => $user['access_lvl']
                ]);

                // Redirect to the dashboard or home page
                return redirect()->to('/home');
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
        
        $method = $this->request->getMethod();
       
        if ($method === 'POST') {
           
            $userModel = new \App\Models\UserModel();
    
            $rules = $userModel->getValidationRules();
            $messages = $userModel->getValidationMessages();
    
            if (!$this->validate($rules, $messages)) {
                return view('auth/register', [
                    'validation' => $this->validator,
                    'data' => $this->request->getPost()
                ]);
            }
    
          
            // Prepare user data for insertion
            $userData = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'full_name' => $this->request->getPost('full_name'),
                'access_lvl' => 1 
            ];
    
           
            if ($userModel->insert($userData)) {
               
    
                // Set success flash message
                session()->setFlashdata('success', 'Registration successful. You can now log in.');
    
                // Redirect to login page
                return redirect()->to('/login');
            } else {
                // Capture and log model errors
               
                session()->setFlashdata('error', 'Registration failed. Please try again.');
    
                // Redirect back with input
                return redirect()->back()->withInput();
            }
        }
        return view('auth/register', [
            'data' => [] 
        ]);
    }
    
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
