<?php namespace App\Controllers;

use App\Models\EligibilityModel;
use App\Models\UserModel;

class Eligibility extends BaseController
{
    protected $eligibilityModel;

    public function __construct()
    {
        $this->eligibilityModel = new EligibilityModel();
    }

    
    public function eligibilities()
    {
        $data['title'] = 'Eligibility Criteria';
        $data['eligibility'] = $this->eligibilityModel->findAll();

        $usersModel = new UserModel();
        $data['users'] = $usersModel->findAll();

        return view('tenders/eligibilities', $data);
    }

    
    public function eligibilities_create()
    {
        $validation = \Config\Services::validation();

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[255]',
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                $data['title'] = 'Create Eligibility'; 
                return view('tenders/eligibilities_create', $data);
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

            $this->eligibilityModel->insert($data);

            session()->setFlashdata('success', 'Eligibility criterion created successfully.');

            return redirect()->to('/eligibilities');
        }

        $data['title'] = 'Create Eligibility';
        return view('tenders/eligibilities_create', $data);
    }

    // Edit an existing eligibility criterion
    public function eligibilities_edit($id)
    {
        $eligibility = $this->eligibilityModel->find($id);

        if (!$eligibility) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Eligibility criterion not found');
        }

        $validation = \Config\Services::validation();

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[255]',
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                $data['eligibility'] = $eligibility;
                $data['title'] = 'Edit Eligibility';
                return view('tenders/eligibilities_edit', $data);
            }

            $userID = session()->get('user_id'); 

            $data = [
                'name'        => $this->request->getPost('name'),
                'updated_by'  => $userID 
            ];

            $this->eligibilityModel->update($id, $data);

            session()->setFlashdata('success', 'Eligibility criterion updated successfully.');

            return redirect()->to('/eligibilities');
        }

        $data['eligibility'] = $eligibility;
        $data['title'] = 'Edit Eligibility';
        return view('tenders/eligibilities_edit', $data);
    }

    // Delete an eligibility criterion
    public function delete_eligibility($id)
    {
        $this->eligibilityModel->delete($id);
        return redirect()->to('/eligibilities');
    }
}
