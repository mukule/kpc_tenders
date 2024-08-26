<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\DepartmentModel;

class Home extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data['title'] = 'Home';
        return view('pages/home', $data);
    }

   public function staffs()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $userModel = new UserModel();
    $departmentModel = new DepartmentModel();

    // Fetch all users
    $data['users'] = $userModel->findAll();
    
    // Fetch all departments
    $data['departments'] = $departmentModel->findAll();

    $data['title'] = 'Staffs';

    return view('pages/staffs', $data);
}


   public function departments()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $departmentModel = new DepartmentModel();
    $userModel = new UserModel();

    $departments = $departmentModel->findAll();

    // Add usernames for created_by and updated_by
    foreach ($departments as &$department) {
        // Fetch creator username
        $creator = $userModel->find($department['created_by']);
        $department['created_by_username'] = isset($creator['username']) ? $creator['username'] : 'N/A';

        // Fetch updater username
        $updater = $userModel->find($department['updated_by']);
        $department['updated_by_username'] = isset($updater['username']) ? $updater['username'] : 'N/A';
    }

    $data['departments'] = $departments;
    $data['title'] = 'Departments';

    return view('pages/departments', $data);
}


    public function createDepartment()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data['title'] = 'Create Department';

        return view('pages/create_department', $data);
    }

    public function storeDepartment()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $departmentModel = new DepartmentModel();

        $validationRules = [
            'name' => 'required|min_length[3]|max_length[255]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'created_by' => session()->get('user_id'), // Assuming user ID is stored in session
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $departmentModel->insert($data);

        return redirect()->to('/departments')->with('success', 'Department created successfully.');
    }

    public function careers()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $data['title'] = 'Career Management';

  

    return view('careers/home', $data);
}

public function tenders()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $data['title'] = 'Tenders Management';



    return view('tenders/home', $data);
}



}
