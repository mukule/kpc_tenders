<?php namespace App\Controllers;

use App\Models\TendersModel;
use App\Models\DocTypesModel;
use App\Models\EligibilityModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\UserModel;

class Tenders extends BaseController
{
    protected $tendersModel;
    protected $docTypesModel;
    protected $eligibilityModel;

    public function __construct()
    {
        $this->tendersModel = new TendersModel();
        $this->docTypesModel = new DocTypesModel();
        $this->eligibilityModel = new EligibilityModel();
    }

    public function tenders()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data['title'] = 'Tenders';
        $data['tenders'] = $this->tendersModel->findAll();
    
        $usersModel = new UserModel();
        $data['users'] = $usersModel->findAll();
    
        $eligibilityModel = new EligibilityModel();
        $data['eligibilities'] = $eligibilityModel->findAll();
    
        return view('tenders/tenders', $data);
    }
    

    public function tenders_create()
{

    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $validation = \Config\Services::validation();
    $session = session();

    if ($this->request->getMethod() === 'POST') {
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'ref_number' => 'required|min_length[3]|max_length[100]|is_unique[tenders.ref_number]', // Ensure unique ref_number
            'start_date' => 'required|valid_date',
            'close_date' => 'required|valid_date',
            'document_types' => 'required', // Changed from document_type to document_types
            'site_visit_details1' => 'permit_empty|string',
            'site_visit_details2' => 'permit_empty|string',
            'eligibility' => 'required|integer',
            'created_by' => 'required|integer',
            'updated_by' => 'permit_empty|integer'
        ];

        // Perform general validation
        if (! $this->validate($rules)) {
            $data = [
                'validation' => $this->validator->getErrors(),
                'name' => $this->request->getPost('name'),
                'ref_number' => $this->request->getPost('ref_number'),
                'start_date' => $this->request->getPost('start_date'),
                'close_date' => $this->request->getPost('close_date'),
                'document_types' => $this->request->getPost('document_types'),
                'site_visit_details1' => $this->request->getPost('site_visit_details1'),
                'site_visit_details2' => $this->request->getPost('site_visit_details2'),
                'eligibility' => $this->request->getPost('eligibility'),
                'created_by' => $this->request->getPost('created_by'),
                'updated_by' => $this->request->getPost('updated_by'),
                'doc_types' => $this->docTypesModel->findAll(),
                'eligibilities' => $this->eligibilityModel->findAll()
            ];

            $session->setFlashdata($data);
            return redirect()->back(); 
        }

        // Perform custom date validation
        $errors = [];
        $startDate = $this->request->getPost('start_date');
        $closeDate = $this->request->getPost('close_date');
        $currentDate = date('Y-m-d');

        if ($startDate < $currentDate) {
            $errors['start_date'] = 'Start Date should be higher than the current date.';
        }

        if ($closeDate < $currentDate) {
            $errors['close_date'] = 'Close Date should be higher than the current date.';
        }

        if ($startDate > $closeDate) {
            $errors['date_range'] = 'Close Date must be higher than Start Date.';
        }

        // If there are custom errors, set them and return to the view
        if (!empty($errors)) {
            $data = [
                'validation' => $errors,
                'name' => $this->request->getPost('name'),
                'ref_number' => $this->request->getPost('ref_number'),
                'start_date' => $this->request->getPost('start_date'),
                'close_date' => $this->request->getPost('close_date'),
                'document_types' => $this->request->getPost('document_types'),
                'site_visit_details1' => $this->request->getPost('site_visit_details1'),
                'site_visit_details2' => $this->request->getPost('site_visit_details2'),
                'eligibility' => $this->request->getPost('eligibility'),
                'created_by' => $this->request->getPost('created_by'),
                'updated_by' => $this->request->getPost('updated_by'),
                'doc_types' => $this->docTypesModel->findAll(),
                'eligibilities' => $this->eligibilityModel->findAll()
            ];

            $session->setFlashdata($data);
            return redirect()->back(); 
        }

        $userID = session()->get('user_id');
        if (!$userID) {
            return redirect()->to('/login')->with('error', 'User not logged in.');
        }

        $data = [
            'name'                => $this->request->getPost('name'),
            'ref_number'          => $this->request->getPost('ref_number'),
            'start_date'          => $this->request->getPost('start_date'),
            'close_date'          => $this->request->getPost('close_date'),
            'document_types'      => json_encode($this->request->getPost('document_types')), 
            'site_visit_details1' => $this->request->getPost('site_visit_details1'),
            'site_visit_details2' => $this->request->getPost('site_visit_details2'),
            'eligibility'         => $this->request->getPost('eligibility'),
            'created_by'          => $userID,
            'updated_by'          => $userID
        ];

        $this->tendersModel->insert($data);
        $session->setFlashdata('success', 'Tender created successfully.');
        return redirect()->to('/tender_uploads');
    }

    $data = [
        'title' => 'Create Tender',
        'doc_types' => $this->docTypesModel->findAll(),
        'eligibilities' => $this->eligibilityModel->findAll()
    ];

    if ($session->has('validation')) {
        $data['validation'] = $session->getFlashdata('validation');
    }
    if ($session->has('name')) {
        $data['name'] = $session->getFlashdata('name');
        $data['ref_number'] = $session->getFlashdata('ref_number');
        $data['start_date'] = $session->getFlashdata('start_date');
        $data['close_date'] = $session->getFlashdata('close_date');
        $data['document_types'] = $session->getFlashdata('document_types');
        $data['site_visit_details1'] = $session->getFlashdata('site_visit_details1');
        $data['site_visit_details2'] = $session->getFlashdata('site_visit_details2');
        $data['eligibility'] = $session->getFlashdata('eligibility');
        $data['created_by'] = $session->getFlashdata('created_by');
        $data['updated_by'] = $session->getFlashdata('updated_by');
    }

    return view('tenders/tenders_create', $data);
}


public function tenders_edit($id)
{

    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }
    // Find the tender with the given ID
    $tender = $this->tendersModel->find($id);
    
    if (!$tender) {
        // Tender not found, handle error
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Tender not found');
    }

    $validation = \Config\Services::validation();
    $session = session();

    if ($this->request->getMethod() === 'POST') {
        // Validation rules
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'ref_number' => 'required|min_length[3]|max_length[100]',
            'start_date' => 'required|valid_date',
            'close_date' => 'required|valid_date',
            'document_types' => 'required',
            'site_visit_details1' => 'permit_empty|string',
            'site_visit_details2' => 'permit_empty|string',
            'eligibility' => 'required|integer',
            'updated_by' => 'required|integer'
        ];

        // Validate form input
        $validationErrors = !$this->validate($rules) ? $this->validator->getErrors() : [];

        // Custom date validation
        $customErrors = [];
        $startDate = $this->request->getPost('start_date');
        $closeDate = $this->request->getPost('close_date');
        $currentDate = date('Y-m-d');

        if ($startDate < $currentDate) {
            $customErrors['start_date'] = 'Start Date should be later than the current date.';
        }

        if ($closeDate < $currentDate) {
            $customErrors['close_date'] = 'Close Date should be later than the current date.';
        }

        if ($startDate > $closeDate) {
            $customErrors['date_range'] = 'Close Date must be after Start Date.';
        }

        
        if (!empty($validationErrors) || !empty($customErrors)) {
            $data = [
                'validation' => array_merge($validationErrors, $customErrors), 
                'tender' => array_merge(['id' => $id], $this->request->getPost()),
                'title' => 'Edit Tender',
                'doc_types' => $this->docTypesModel->findAll(),
                'eligibilities' => $this->eligibilityModel->findAll()
            ];

            
            return view('tenders/tenders_edit', $data);
        }

       
        $updateData = [
            'name'                => $this->request->getPost('name'),
            'ref_number'          => $this->request->getPost('ref_number'),
            'start_date'          => $this->request->getPost('start_date'),
            'close_date'          => $this->request->getPost('close_date'),
            'document_types'      => json_encode($this->request->getPost('document_types')),
            'site_visit_details1' => $this->request->getPost('site_visit_details1'),
            'site_visit_details2' => $this->request->getPost('site_visit_details2'),
            'eligibility'         => $this->request->getPost('eligibility'),
            'updated_by'          => $this->request->getPost('updated_by')
        ];

        
        $this->tendersModel->update($id, $updateData);

        
        $session->setFlashdata('success', 'Tender updated successfully.');
        return redirect()->to('/tender_uploads');
    }

    
    $data = [
        'tender' => $tender,
        'title' => 'Edit Tender',
        'doc_types' => $this->docTypesModel->findAll(),
        'eligibilities' => $this->eligibilityModel->findAll()
    ];

    return view('tenders/tenders_edit', $data);
}


    public function tender_delete($id)
    {
        $this->tendersModel->delete($id);
        session()->setFlashdata('success', 'Tender deleted successfully.');
        return redirect()->to('/tender_uploads');
    }
}
