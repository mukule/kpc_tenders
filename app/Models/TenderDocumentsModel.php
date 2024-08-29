<?php namespace App\Models;

use CodeIgniter\Model;

class TenderDocumentsModel extends Model
{
    protected $table      = 'tender_documents'; 
    protected $primaryKey = 'id'; 

    
    protected $allowedFields = [
        'tender_id',
        'doc_type_id',
        'document_name',
        'file', 
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    
}
