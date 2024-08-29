<?php

namespace App\Controllers;

use App\Models\ProcurementPlanModel;
use App\Models\UserModel;

class ProcurementPlans extends BaseController
{

    public function proc_plans()
    {
        $model = new ProcurementPlanModel();
        $userModel = new UserModel(); 

        $data = [
            'title' => 'Procurement Plans', 
            'procurementPlans' => $model->findAll(),
            'users' => $userModel->findAll() 
        ];

        return view('tenders/proc_plans', $data);
    }

    public function proc_plans_create()
{
    $model = new ProcurementPlanModel();

    if ($this->request->getMethod() === 'POST') {
        $rules = [
            'type_of_procurement_plan' => 'required|string',
            'goods_desc' => 'required|string',
            'units' => 'required|string',
            'quantity' => 'required|string',
            'pro_methods' => 'required|string',
            'agpo_category' => 'required|string',
            'section' => 'required|string',
            'created_by' => 'required|integer',
            'updated_by' => 'required|integer'
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator->getErrors();
            $data['title'] = 'Create Procurement Plans';
            return view('tenders/proc_plans_create', $data);
        }

        $model->save([
            'type_of_procurement_plan' => $this->request->getPost('type_of_procurement_plan'),
            'goods_desc' => $this->request->getPost('goods_desc'),
            'units' => $this->request->getPost('units'),
            'quantity' => $this->request->getPost('quantity'),
            'pro_methods' => $this->request->getPost('pro_methods'),
            'agpo_category' => $this->request->getPost('agpo_category'),
            'section' => $this->request->getPost('section'),
            'created_by' => session()->get('user_id'),
            'updated_by' => session()->get('user_id')
        ]);

        return redirect()->to('/proc_plans');
    }

    // Pass the title to the view
    $data['title'] = 'Create Procurement Plans';
    return view('tenders/proc_plans_create', $data);
}


    public function proc_plans_edit($id)
    {
        $model = new ProcurementPlanModel();
        $data['procurement_plan'] = $model->find($id);

        if (!$data['procurement_plan']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the procurement plan with id ' . $id);
        }

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'type_of_procurement_plan' => 'required|string',
                'goods_desc' => 'required|string',
                'units' => 'required|string',
                'quantity' => 'required|string',
                'pro_methods' => 'required|string',
                'agpo_category' => 'required|string',
                'section' => 'required|string',
                'updated_by' => 'required|integer'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator->getErrors();
                $data['title'] = 'Update Procurement Plans';
                return view('tenders/proc_plans_edit', $data);
            }

            $model->update($id, [
                'type_of_procurement_plan' => $this->request->getPost('type_of_procurement_plan'),
                'goods_desc' => $this->request->getPost('goods_desc'),
                'units' => $this->request->getPost('units'),
                'quantity' => $this->request->getPost('quantity'),
                'pro_methods' => $this->request->getPost('pro_methods'),
                'agpo_category' => $this->request->getPost('agpo_category'),
                'section' => $this->request->getPost('section'),
                'updated_by' => session()->get('user_id')
            ]);

            return redirect()->to('/proc_plans');
        }

        $data['title'] = 'Update Procurement Plans';
        return view('tenders/proc_plans_edit', $data);
    }

    public function proc_plans_delete($id)
    {
        $model = new ProcurementPlanModel();
        $model->delete($id);
        return redirect()->to('/proc_plans');
    }
}
