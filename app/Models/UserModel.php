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

    // Remove validation rules
    protected $validationRules = []; // No validation rules defined

    protected $validationMessages = []; // No custom validation messages defined

    // Allowed fields for mass assignment
    protected $allowedFields = ['username', 'email', 'password', 'full_name', 'access_lvl', 'department_id', 'active'];

    // Date fields
    protected $useTimestamps = true; // Use timestamp fields (created_at, updated_at)
    protected $createdField  = 'created_at'; // Timestamp for creation
    protected $updatedField  = 'updated_at'; // Timestamp for last update
}
