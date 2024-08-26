<?php namespace App\Models;

use CodeIgniter\Model;

class VacancyFunctionModel extends Model
{
    protected $table      = 'vac_function';
    protected $primaryKey = 'id';

    protected $returnType     = 'array'; // Or 'object' if you prefer objects
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'name',
        'created_by',
        'updated_by'
    ];

    // Dates are automatically formatted
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation is not used
    protected $skipValidation = true;
}
