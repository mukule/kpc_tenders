<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'id';

    protected $returnType = 'array'; // Can also be 'object' if preferred
    protected $useSoftDeletes = false; // Set to true if using soft deletes

    protected $allowedFields = ['name', 'active', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    // Validation rules for data
    protected $validationRules = [
        'name' => 'required|string|max_length[255]',
        // Add more validation rules as needed
    ];

    // Custom error messages for validation
    protected $validationMessages = [
        'name' => [
            'required' => 'The department name is required.',
            'string' => 'The department name must be a string.',
            'max_length' => 'The department name cannot exceed 255 characters.'
        ],
        // Add more error messages as needed
    ];

    // Set timestamps for created_at and updated_at
    protected $useTimestamps = true;

    // Optional: specify the date format if different from default
    protected $dateFormat = 'datetime';
}
