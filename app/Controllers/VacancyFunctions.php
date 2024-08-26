<?php namespace App\Controllers;

use App\Models\VacancyFunctionModel;
use App\Models\UserModel;

class VacancyFunctions extends BaseController
{
    protected $vacancyFunctionModel;

    public function __construct()
    {
        $this->vacancyFunctionModel = new VacancyFunctionModel();
    }

    
    public function job_functions()
    {
        $data['title'] = 'Vacancy Functions';

        
        $data['vacancy_functions'] = $this->vacancyFunctionModel->findAll();

        
        $usersModel = new UserModel();
        $data['users'] = $usersModel->findAll();

        return view('careers/job_functions.php', $data);
    }

    
    public function job_functions_create()
    {
        $validation = \Config\Services::validation();
    
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[255]',
            ];
    
            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                $data['title'] = 'Create Job Function'; 
                return view('careers/job_functions_create', $data);
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
    
            
            $this->vacancyFunctionModel->insert($data);
    
            
            session()->setFlashdata('success', 'Job Function created successfully.');
    
           
            return redirect()->to('/job_functions');
        }
    
        $data['title'] = 'Create Job Function';
        return view('careers/job_functions_create', $data);
    }
    

    
    public function job_functions_edit($id)
{
    
    $vacancyFunction = $this->vacancyFunctionModel->find($id);

    
    if (!$vacancyFunction) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Vacancy function not found');
    }

    
    $validation = \Config\Services::validation();

    
    if ($this->request->getMethod() === 'POST') {
        
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
        ];

       
        if (! $this->validate($rules)) {
            
            $data['validation'] = $this->validator;
            $data['vacancy_function'] = $vacancyFunction;
            $data['title'] = 'Edit Vacancy Function';
            return view('careers/job_functions_edit', $data);
        }

        
        $userID = session()->get('user_id'); 

        
        $data = [
            'name'        => $this->request->getPost('name'),
            'updated_by'  => $userID 
        ];

        
        $this->vacancyFunctionModel->update($id, $data);

        
        session()->setFlashdata('success', 'Job Function updated successfully.');

       
        return redirect()->to('/job_functions');
    }

    
    $data['vacancy_function'] = $vacancyFunction;
    $data['title'] = 'Edit Vacancy Function';
    return view('careers/job_functions_edit', $data);
}


    
    public function delete_job_function($id)
    {
        $this->vacancyFunctionModel->delete($id);
        return redirect()->to('/job_functions');
    }
}
