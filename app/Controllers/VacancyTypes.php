<?php namespace App\Controllers;

use App\Models\VacancyTypeModel;
use App\Models\UserModel;

class VacancyTypes extends BaseController
{
    protected $vacancyTypeModel;

    public function __construct()
    {
        $this->vacancyTypeModel = new VacancyTypeModel();
    }

    
    public function job_types()
    {
        $data['title'] = 'Vacancy Types';

        
        $data['job_types'] = $this->vacancyTypeModel->findAll();

        
        $usersModel = new UserModel();
        $data['users'] = $usersModel->findAll();

        return view('careers/job_types', $data);
    }

   
    public function job_types_create()
    {
        $validation = \Config\Services::validation();
    
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[255]',
            ];
    
            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                $data['title'] = 'Create Job Type'; 
                return view('careers/job_types_create', $data);
            }
    
            $userID = session()->get('user_id');
    
            if (!$userID) {
                return redirect()->to('/login')->with('error', 'User not logged in.');
            }
    
            $data = [
                'name'        => $this->request->getPost('name'),
                'created_by'  => $userID, 
                'updated_by'  => $userID 
            ];
    
            
            $this->vacancyTypeModel->insert($data);
    
            session()->setFlashdata('success', 'Job Type created successfully.');
    
            return redirect()->to('/job_types');
        }
    
        $data['title'] = 'Create Job Type';
        return view('careers/job_types_create', $data);
    }

    
    public function job_types_edit($id)
    {
        
        $vacancyType = $this->vacancyTypeModel->find($id);

        if (!$vacancyType) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Vacancy type not found');
        }

        $validation = \Config\Services::validation();

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[255]',
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                $data['vacancy_type'] = $vacancyType;
                $data['title'] = 'Edit Job Type';
                return view('careers/job_types_edit', $data);
            }

            $userID = session()->get('user_id'); 

            $data = [
                'name'        => $this->request->getPost('name'),
                'updated_by'  => $userID 
            ];

            
            $this->vacancyTypeModel->update($id, $data);

            session()->setFlashdata('success', 'Job Type updated successfully.');

            return redirect()->to('/job_types');
        }

        $data['job_type'] = $vacancyType;
        $data['title'] = 'Edit Job Type';
        return view('careers/job_types_edit', $data);
    }

    
    public function delete_job_type($id)
    {
        $this->vacancyTypeModel->delete($id);
        return redirect()->to('/job_types');
    }
}
