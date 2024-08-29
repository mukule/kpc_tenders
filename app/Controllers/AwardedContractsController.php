<?php namespace App\Controllers;

use App\Models\AwardedContractsModel;
use CodeIgniter\Controller;
use App\Models\UserModel;

class AwardedContractsController extends Controller
{
    protected $awardedContractsModel;
    protected $userModel;

    public function __construct()
    {
        $this->awardedContractsModel = new AwardedContractsModel();
        $this->userModel = new UserModel();
    }

    public function awarded_cons()
    {
        // Fetch awarded contracts
        $data['awardedContracts'] = $this->awardedContractsModel->findAll();
        
        // Fetch users
        $usersModel = new UserModel();
        $data['users'] = $usersModel->findAll();
        
        // Set the title for the page
        $data['title'] = 'Awarded Contracts';
        
        // Return the view with the data
        return view('tenders/awarded_cons', $data);
    }
    

   
   
    public function awarded_cons_create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
    
        $validation = \Config\Services::validation();
        $session = session();
    
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'ref_num' => 'required|min_length[3]|max_length[100]|is_unique[awarded_contracts.ref_num]',
                'cont_details' => 'required|min_length[3]',
                'pro_method' => 'required',
                'cont_cat' => 'required',
                'supp_name' => 'required|min_length[3]',
                'cont_value' => 'required|numeric',
                'start_date' => 'required|valid_date',
                'end_date' => 'required|valid_date',
                'created_by' => 'required|integer',
                'updated_by' => 'permit_empty|integer'
            ];
    
            if (!$this->validate($rules)) {
                // Set the validation errors in flash data
                $session->setFlashdata('validation', $this->validator->getErrors());
                return redirect()->back()->withInput();  // Redirect back with input data
            }
    
            // Custom validation for dates
            $errors = [];
            $startDate = $this->request->getPost('start_date');
            $endDate = $this->request->getPost('end_date');
            $currentDate = date('Y-m-d');
    
            if ($startDate < $currentDate) {
                $errors['start_date'] = 'Start Date should be higher than the current date.';
            }
    
            if ($endDate < $currentDate) {
                $errors['end_date'] = 'End Date should be higher than the current date.';
            }
    
            if ($startDate > $endDate) {
                $errors['date_range'] = 'End Date must be higher than Start Date.';
            }
    
            if (!empty($errors)) {
                // Set the custom errors in flash data
                $session->setFlashdata('validation', $errors);
                return redirect()->back()->withInput();  // Redirect back with input data
            }
    
            $userID = session()->get('user_id');
            if (!$userID) {
                return redirect()->to('/login')->with('error', 'User not logged in.');
            }
    
            // Prepare data for insertion
            $data = [
                'ref_num' => $this->request->getPost('ref_num'),
                'cont_details' => $this->request->getPost('cont_details'),
                'pro_method' => $this->request->getPost('pro_method'),
                'cont_cat' => $this->request->getPost('cont_cat'),
                'supp_name' => $this->request->getPost('supp_name'),
                'cont_value' => $this->request->getPost('cont_value'),
                'start_date' => $this->request->getPost('start_date'),
                'end_date' => $this->request->getPost('end_date'),
                'created_by' => $userID,
                'updated_by' => $userID
            ];
    
            $this->awardedContractsModel->insert($data);
            $session->setFlashdata('success', 'Awarded Contract created successfully.');
            return redirect()->to('/awarded_cons');
        }
    
        // Render create form with necessary data
        $data = [
            'title' => 'Create Awarded Contract',
            'users' => $this->userModel->findAll(),
            'validation' => $session->getFlashdata('validation') // Get validation errors from flash data
        ];
    
        return view('tenders/awarded_cons_create', $data);
    }

    public function awarded_cons_edit($id = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $validation = \Config\Services::validation();
        $session = session();

        // Retrieve the existing contract by ID
        $contract = $this->awardedContractsModel->find($id);

        if (!$contract) {
            return redirect()->to('/awarded_cons')->with('error', 'Awarded Contract not found.');
        }

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'ref_num' => "required|min_length[3]|max_length[100]|is_unique[awarded_contracts.ref_num,id,{$id}]",
                'cont_details' => 'required|min_length[3]',
                'pro_method' => 'required',
                'cont_cat' => 'required',
                'supp_name' => 'required|min_length[3]',
                'cont_value' => 'required|numeric',
                'start_date' => 'required|valid_date',
                'end_date' => 'required|valid_date',
                'created_by' => 'required|integer',
                'updated_by' => 'permit_empty|integer'
            ];

            if (!$this->validate($rules)) {
                
                $session->setFlashdata('validation', $this->validator->getErrors());
                return redirect()->back()->withInput(); 
            }

            
            $errors = [];
            $startDate = $this->request->getPost('start_date');
            $endDate = $this->request->getPost('end_date');
            $currentDate = date('Y-m-d');

            if ($startDate < $currentDate) {
                $errors['start_date'] = 'Start Date should be higher than the current date.';
            }

            if ($endDate < $currentDate) {
                $errors['end_date'] = 'End Date should be higher than the current date.';
            }

            if ($startDate > $endDate) {
                $errors['date_range'] = 'End Date must be higher than Start Date.';
            }

            if (!empty($errors)) {
                
                $session->setFlashdata('validation', $errors);
                return redirect()->back()->withInput(); 
            }

            $userID = session()->get('user_id');
            if (!$userID) {
                return redirect()->to('/login')->with('error', 'User not logged in.');
            }

           
            $data = [
                'ref_num' => $this->request->getPost('ref_num'),
                'cont_details' => $this->request->getPost('cont_details'),
                'pro_method' => $this->request->getPost('pro_method'),
                'cont_cat' => $this->request->getPost('cont_cat'),
                'supp_name' => $this->request->getPost('supp_name'),
                'cont_value' => $this->request->getPost('cont_value'),
                'start_date' => $this->request->getPost('start_date'),
                'end_date' => $this->request->getPost('end_date'),
                'updated_by' => $userID 
            ];

            $this->awardedContractsModel->update($id, $data);
            $session->setFlashdata('success', 'Awarded Contract updated successfully.');
            return redirect()->to('/awarded_cons');
        }

       
        $data = [
            'title' => 'Edit Awarded Contract',
            'contract' => $contract,  
            'users' => $this->userModel->findAll(),
            'validation' => $session->getFlashdata('validation')
        ];

        return view('tenders/awarded_cons_edit', $data);
}


public function awarded_cons_delete($id)
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    
    $contract = $this->awardedContractsModel->find($id);
    if (!$contract) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Contract not found');
    }

    
    $this->awardedContractsModel->delete($id);

   
    session()->setFlashdata('success', 'Awarded Contract deleted successfully.');
    return redirect()->to('/awarded_cons');
}


    
}
