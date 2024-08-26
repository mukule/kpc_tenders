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
        'document_type',
        'site_visit_details1',
        'site_visit_details2',
        'tender_file',
        'eligibility',
        'created_by',
        'updated_by'
    ];

    // Dates are automatically formatted
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
