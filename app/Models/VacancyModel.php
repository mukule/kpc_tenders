<?php namespace App\Models;

use CodeIgniter\Model;

class VacancyModel extends Model
{
    protected $table      = 'vacancy';
    protected $primaryKey = 'id';

    protected $returnType     = 'array'; // Or 'object' if you prefer objects
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'title',
        'ref',
        'vac_function',
        'open_date',
        'close_date',
        'min_educational_level',
        'min_work_experience',
        'vac_type',
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
