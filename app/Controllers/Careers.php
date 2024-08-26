<?php namespace App\Controllers;

use App\Models\EducationLevelsModel;

class Careers extends BaseController
{
    protected $educationLevelsModel;

    public function __construct()
    {
        $this->educationLevelsModel = new EducationLevelsModel();
    }

    // Display Education Levels
public function edu_lvls()
{
    $data['title'] = 'Education Levels'; // Set the title

    // Fetch education levels
    $data['education_levels'] = $this->educationLevelsModel->findAll();

    // Fetch users data
    $usersModel = new \App\Models\UserModel();
    $data['users'] = $usersModel->findAll();

    return view('careers/edu_lvls', $data);
}



 public function create_edu_lvls()
{
   
    $validation = \Config\Services::validation();

    if ($this->request->getMethod() === 'POST') {
        
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
        ];

       
        if (! $this->validate($rules)) {
            
            $data['validation'] = $this->validator;
            $data['title'] = 'Create Education Level'; 
            return view('education_levels/create', $data);
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

        
        $this->educationLevelsModel->insert($data);

        
        return redirect()->to('/edu_lvls');
    }

    
    $data['title'] = 'Create Education Level';

   
    return view('careers/create_edu_lvls', $data);
}

public function edit_edu_lvls($id)
{
    
    $educationLevel = $this->educationLevelsModel->find($id);

    
    if (!$educationLevel) {
        
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Education level not found');
    }

    
    $validation = \Config\Services::validation();

    if ($this->request->getMethod() === 'POST') {
        
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
        ];

        
        if (! $this->validate($rules)) {
            
            $data['validation'] = $this->validator;
            $data['education_level'] = $educationLevel;
            $data['title'] = 'Edit Education Level'; 
            return view('careers/edit_edu_lvls', $data);
        }

        
        $userID = session()->get('user_id'); 

        
        $data = [
            'name'        => $this->request->getPost('name'),
            'updated_by'  => $userID 
        ];

        
        $this->educationLevelsModel->update($id, $data);

        
        return redirect()->to('/edu_lvls');
    }

    
    $data['education_level'] = $educationLevel;
    $data['title'] = 'Edit Education Level'; 
    return view('careers/edit_edu_lvls', $data);
}

    
    public function delete($id)
    {
        $this->educationLevelsModel->delete($id);
        return redirect()->to('/edu_lvls');
    }
}
