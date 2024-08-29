<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcurementPlanModel extends Model
{
    protected $table = 'procurement_plans'; 
    protected $primaryKey = 'id'; 

    protected $allowedFields = [
        'type_of_procurement_plan',
        'goods_desc',
        'units',
        'quantity',
        'pro_methods',
        'agpo_category',
        'section',
        'created_by',
        'updated_by'
    ];

    protected $useTimestamps = true; 
    protected $createdField = 'created_at'; 
    protected $updatedField = 'updated_at'; 

    
}
