<?php namespace App\Models;

use CodeIgniter\Model;

class EligibilityModel extends Model
{
    protected $table      = 'eligibility';
    protected $primaryKey = 'id';

    protected $returnType     = 'array'; 
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'name',
        'created_by',
        'updated_by'
    ];

    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    
    protected $skipValidation = true;
}
