<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; 
    protected $primaryKey = 'id'; 

    protected $useAutoIncrement = true; 

    protected $returnType = 'array'; 

    protected $useSoftDeletes = false; 


    protected $validationRules = [
        'username' => 'required|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).+$/]|differs[username]',
        'full_name' => 'required'
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username is required.',
            'is_unique' => 'This username is already taken.'
        ],
        'email' => [
            'required' => 'Email is required.',
            'valid_email' => 'Please enter a valid email address.',
            'is_unique' => 'This email is already registered.'
        ],
        'password' => [
            'required' => 'Password is required.',
            'min_length' => 'Password must be at least 8 characters long.',
            'regex_match' => 'Password must include at least one uppercase letter, one lowercase letter, one special character, and be at least 8 characters long.',
            'differs' => 'Password must not be similar to username'
        ],
        'full_name' => [
            'required' => 'Full name is required.'
        ]
    ];

    // Allowed fields for mass assignment
    protected $allowedFields = ['username', 'email', 'password', 'full_name', 'access_lvl'];

    // Date fields
    protected $useTimestamps = true; // Use timestamp fields (created_at, updated_at)
    protected $createdField  = 'created_at'; // Timestamp for creation
    protected $updatedField  = 'updated_at'; // Timestamp for last update

   
}

