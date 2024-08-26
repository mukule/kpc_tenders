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
        $data['title'] = 'Tenders';
        $data['tenders'] = $this->tendersModel->findAll();

        $usersModel = new UserModel();
        $data['users'] = $usersModel->findAll();

        return view('tenders/tenders', $data);
    }

   
    public function tenders_create()
{
    $validation = \Config\Services::validation();

    if ($this->request->getMethod() === 'POST') {
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'ref_number' => 'required|min_length[3]|max_length[100]|is_unique[tenders.ref_number]', // Ensure unique ref_number
            'start_date' => 'required|valid_date',
            'close_date' => 'required|valid_date',
            'document_type' => 'required|integer',
            'site_visit_details1' => 'permit_empty|string',
            'site_visit_details2' => 'permit_empty|string',
            'tender_file' => 'uploaded[tender_file]|ext_in[tender_file,pdf]|max_size[tender_file,5120]', // Validate file type and size
            'eligibility' => 'required|integer',
            'created_by' => 'required|integer',
            'updated_by' => 'permit_empty|integer'
        ];

        if (! $this->validate($rules)) {
            $data['validation'] = $this->validator;
            $data['title'] = 'Create Tender';
            $data['doc_types'] = $this->docTypesModel->findAll();
            $data['eligibilities'] = $this->eligibilityModel->findAll();
            return view('tenders/tenders_create', $data);
        }

        $file = $this->request->getFile('tender_file');
        $fileName = $file->getName(); // Get original file name
        $uploadPath = FCPATH . 'tender_docs'; // Use FCPATH to store in the public directory

        // Ensure the directory exists
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true); // Create directory if not exists
        }

        // Check if file already exists and modify name if necessary
        $originalFileName = $fileName;
        $filePath = $uploadPath . '/' . $fileName;
        $i = 1;
        while (file_exists($filePath)) {
            $fileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '-' . $i . '.' . $file->getExtension();
            $filePath = $uploadPath . '/' . $fileName;
            $i++;
        }

        // Move file to the directory
        $file->move($uploadPath, $fileName);

        $data = [
            'name'                => $this->request->getPost('name'),
            'ref_number'          => $this->request->getPost('ref_number'),
            'start_date'          => $this->request->getPost('start_date'),
            'close_date'          => $this->request->getPost('close_date'),
            'document_type'       => $this->request->getPost('document_type'),
            'site_visit_details1' => $this->request->getPost('site_visit_details1'),
            'site_visit_details2' => $this->request->getPost('site_visit_details2'),
            'tender_file'         => $fileName,
            'eligibility'         => $this->request->getPost('eligibility'),
            'created_by'          => $this->request->getPost('created_by'),
            'updated_by'          => $this->request->getPost('updated_by')
        ];

        $this->tendersModel->insert($data);

        session()->setFlashdata('success', 'Tender created successfully.');
        return redirect()->to('/tenders');
    }

    $data['title'] = 'Create Tender';
    $data['doc_types'] = $this->docTypesModel->findAll();
    $data['eligibilities'] = $this->eligibilityModel->findAll();
    return view('tenders/tenders_create', $data);
}

    

    public function edit($id)
    {
        $tender = $this->tendersModel->find($id);
        if (!$tender) {
            throw PageNotFoundException::forPageNotFound('Tender not found');
        }

        $validation = \Config\Services::validation();

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[255]',
                'ref_number' => 'required|min_length[3]|max_length[100]',
                'start_date' => 'required|valid_date',
                'close_date' => 'required|valid_date',
                'document_type' => 'required|integer',
                'site_visit_details1' => 'permit_empty|string',
                'site_visit_details2' => 'permit_empty|string',
                'tender_file' => 'permit_empty|ext_in[tender_file,pdf]',
                'eligibility' => 'required|integer',
                'updated_by' => 'required|integer'
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                $data['tender'] = $tender;
                $data['title'] = 'Edit Tender';
                return view('tenders/edit', $data);
            }

            $file = $this->request->getFile('tender_file');
            $fileName = $file->isValid() ? $file->getRandomName() : $tender['tender_file'];
            if ($file->isValid()) {
                $file->move(WRITEPATH . 'uploads/tenders', $fileName);
            }

            $data = [
                'name'                => $this->request->getPost('name'),
                'ref_number'          => $this->request->getPost('ref_number'),
                'start_date'          => $this->request->getPost('start_date'),
                'close_date'          => $this->request->getPost('close_date'),
                'document_type'       => $this->request->getPost('document_type'),
                'site_visit_details1' => $this->request->getPost('site_visit_details1'),
                'site_visit_details2' => $this->request->getPost('site_visit_details2'),
                'tender_file'         => $fileName,
                'eligibility'         => $this->request->getPost('eligibility'),
                'updated_by'          => $this->request->getPost('updated_by')
            ];

            $this->tendersModel->update($id, $data);

            session()->setFlashdata('success', 'Tender updated successfully.');
            return redirect()->to('/tenders');
        }

        $data['tender'] = $tender;
        $data['title'] = 'Edit Tender';
        $data['doc_types'] = $this->docTypesModel->findAll();
        $data['eligibilities'] = $this->eligibilityModel->findAll();
        return view('tenders/edit', $data);
    }

    public function delete($id)
    {
        $this->tendersModel->delete($id);
        session()->setFlashdata('success', 'Tender deleted successfully.');
        return redirect()->to('/tenders');
    }
}
