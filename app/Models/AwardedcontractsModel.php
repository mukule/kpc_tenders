<?php namespace App\Models;

use CodeIgniter\Model;

class AwardedContractsModel extends Model
{
    
    protected $table = 'awarded_contracts';

    
    protected $primaryKey = 'id';

    
    protected $allowedFields = [
        'ref_num',
        'cont_details',
        'pro_method',
        'cont_cat',
        'supp_name',
        'cont_value',
        'start_date',
        'end_date',
        'created_by',
        'updated_by'
    ];

    
    protected $useTimestamps = true;

    
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
