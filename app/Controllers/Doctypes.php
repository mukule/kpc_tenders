<?php namespace App\Controllers;

use App\Models\DocTypesModel;
use App\Models\UserModel;

class DocTypes extends BaseController
{
    protected $docTypesModel;

    public function __construct()
    {
        $this->docTypesModel = new DocTypesModel();
    }

    
    public function docs()
    {
        $data['title'] = 'Document Types';
        $data['doc_types'] = $this->docTypesModel->findAll();

        $usersModel = new UserModel();
        $data['users'] = $usersModel->findAll();

        return view('tenders/docs', $data);
    }

    
    public function docs_create()
    {
        $validation = \Config\Services::validation();

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[255]',
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                $data['title'] = 'Create Document Type';
                return view('tenders/docs_create', $data);
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

            $this->docTypesModel->insert($data);

            session()->setFlashdata('success', 'Document type created successfully.');

            return redirect()->to('/docs');
        }

        $data['title'] = 'Create Document Type';
        return view('tenders/docs_create', $data);
    }

    // Edit an existing document type
    public function docs_edit($id)
    {
        $docType = $this->docTypesModel->find($id);

        if (!$docType) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Document type not found');
        }

        $validation = \Config\Services::validation();

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[255]',
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                $data['doc_type'] = $docType;
                $data['title'] = 'Edit Document Type';
                return view('tenders/docs_edit', $data);
            }

            $userID = session()->get('user_id');

            $data = [
                'name'        => $this->request->getPost('name'),
                'updated_by'  => $userID 
            ];

            $this->docTypesModel->update($id, $data);

            session()->setFlashdata('success', 'Document type updated successfully.');

            return redirect()->to('/docs');
        }

        $data['doc_type'] = $docType;
        $data['title'] = 'Edit Document Type';
        return view('tenders/docs_edit', $data);
    }

    // Delete a document type
    public function docs_delete($id)
    {
        $this->docTypesModel->delete($id);
        return redirect()->to('/docs');
    }
}
