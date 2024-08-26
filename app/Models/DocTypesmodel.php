<?php namespace App\Models;

use CodeIgniter\Model;

class DocTypesModel extends Model
{
    protected $table      = 'doc_types';
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

    // Validation is not used
    protected $skipValidation = true;

   
}
