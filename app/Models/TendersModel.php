<?php namespace App\Models;

use CodeIgniter\Model;

class TendersModel extends Model
{
    protected $table      = 'tenders';
    protected $primaryKey = 'id';

    protected $returnType     = 'array'; 
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'name',
        'ref_number',
        'start_date',
        'close_date',
        'document_types', // Updated field name
        'site_visit_details1',
        'site_visit_details2',
        'eligibility',
        'created_by',
        'updated_by'
    ];

    // Dates are automatically formatted
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Optionally, if you want automatic JSON encoding/decoding
    protected $cast = [
        'document_types' => 'json',
    ];
}
