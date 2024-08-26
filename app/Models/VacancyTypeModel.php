<?php namespace App\Models;

use CodeIgniter\Model;

class VacancyTypeModel extends Model
{
    protected $table      = 'vac_type';
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
