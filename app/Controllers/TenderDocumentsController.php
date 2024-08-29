<?php namespace App\Controllers;

use App\Models\DocTypesModel;
use App\Models\TenderDocumentsModel;
use App\Models\TendersModel;

class TenderDocumentsController extends BaseController
{
    protected $docTypesModel;
    protected $tenderDocumentsModel;
    protected $tendersmodel;

    public function __construct()
    {
        $this->docTypesModel = new DocTypesModel();
        $this->tenderDocumentsModel = new TenderDocumentsModel();
        $this->tendersModel = new TendersModel();
    }

    
    public function tender_docs($tenderId)
    {
        $tender = $this->tendersModel->find($tenderId);
        
       
        if (!$tender || !isset($tender['document_types'])) {
            throw new \Exception('Tender not found or document types not set.');
        }
        
        
        $documentTypeIds = json_decode($tender['document_types'], true);
        
        
        $documentTypes = $this->docTypesModel
            ->whereIn('id', $documentTypeIds)
            ->findAll();
        
       
        $tenderDocuments = $this->tenderDocumentsModel
            ->where('tender_id', $tenderId)
            ->findAll();
        
      
        $data = [
            'documentTypes' => $documentTypes,
            'tenderDocuments' => $tenderDocuments,
            'tenderId' => $tenderId, 
            'title' => 'Documents for Tender #' . $tenderId
        ];
        
        return view('tenders/tender_docs', $data);
    }


    public function tender_doc($docId)
{
    
    $document = $this->tenderDocumentsModel->find($docId);

    
    if (!$document) {
        log_message('error', 'Document not found. ID: ' . $docId);
        return $this->response->setStatusCode(404)->setBody('Document not found.');
    }

    
    $filePath = WRITEPATH . $document['file'];

    
    log_message('debug', 'Checking file path: ' . $filePath);

    
    if (!file_exists($filePath)) {
        log_message('error', 'File not found. Path: ' . $filePath);
        return $this->response->setStatusCode(404)->setBody('File not found.');
    }

    
    $mimeType = mime_content_type($filePath);

    
    log_message('debug', 'MIME type: ' . $mimeType);

    
    return $this->response
                ->setContentType($mimeType)  
                ->setHeader('Content-Disposition', 'inline; filename="' . $document['document_name'] . '"')  
                ->setBody(file_get_contents($filePath));  
}

    
    
public function tender_docs_create($tenderId, $docTypeId)
{
    if ($this->request->getMethod() === 'POST') {
        // Handle POST request to create document
        $tender = $this->tendersModel->find($tenderId);
        if (!$tender) {
            throw new \Exception('Tender not found.');
        }

        $docType = $this->docTypesModel->find($docTypeId);
        if (!$docType) {
            throw new \Exception('Document type not found.');
        }

        $documentName = $this->request->getPost('document_name');
        $file = $this->request->getFile('file');

        if (!$documentName || !$file->isValid()) {
            throw new \Exception('Invalid document name or file.');
        }

       
        $filePath = $file->store('tender_documents');

       
        $filePathWithPrefix = 'uploads/' . $filePath;

       
        $data = [
            'tender_id' => $tenderId,
            'doc_type_id' => $docTypeId,
            'document_name' => $documentName,
            'file' => $filePathWithPrefix,  
            'created_by' => session()->get('user_id'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        
        if (!$this->tenderDocumentsModel->insert($data)) {
            throw new \Exception('Failed to create tender document.');
        }

        
        return redirect()->to('/tender_docs/' . $tenderId)->with('success', 'Document created successfully.');
    } else {
        
        $tender = $this->tendersModel->find($tenderId);
        if (!$tender) {
            throw new \Exception('Tender not found.');
        }

        $docType = $this->docTypesModel->find($docTypeId);
        if (!$docType) {
            throw new \Exception('Document type not found.');
        }

        
        $data = [
            'tenderId' => $tenderId,
            'docTypeId' => $docTypeId,
            'title' => 'Add ' . esc($docType['name']) . ' to ' . esc($tender['name']),
        ];

        return view('tenders/tender_docs_create', $data);
    }
}


public function tender_docs_edit($docId)
{
    if ($this->request->getMethod() === 'POST') {
        $document = $this->tenderDocumentsModel->find($docId);
        if (!$document) {
            throw new \Exception('Document not found.');
        }

        $tender = $this->tendersModel->find($document['tender_id']);
        if (!$tender) {
            throw new \Exception('Tender not found.');
        }

        $docType = $this->docTypesModel->find($document['doc_type_id']);
        if (!$docType) {
            throw new \Exception('Document type not found.');
        }

        $documentName = $this->request->getPost('document_name');
        $file = $this->request->getFile('file');

        if (!$documentName) {
            throw new \Exception('Invalid document name.');
        }

        
        $data = [
            'document_name' => $documentName,
            'updated_by' => session()->get('user_id'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Check if a new file is uploaded
        if ($file->isValid()) {
            // Delete the old file if it exists
            $oldFilePath = $document['file'];
            if (!empty($oldFilePath) && file_exists(WRITEPATH . $oldFilePath)) {
                unlink(WRITEPATH . $oldFilePath);
            }

            // Store the new file and update the path
            $filePath = $file->store('tender_documents');
            $filePathWithPrefix = 'uploads/' . $filePath;
            $data['file'] = $filePathWithPrefix;
        }

        // Update the document in the database
        if (!$this->tenderDocumentsModel->update($docId, $data)) {
            throw new \Exception('Failed to update tender document.');
        }

        return redirect()->to('/tender_docs/' . $document['tender_id'])->with('success', 'Document updated successfully.');
    } else {
        // Handle GET request
        $document = $this->tenderDocumentsModel->find($docId);
        if (!$document) {
            throw new \Exception('Document not found.');
        }

        $tender = $this->tendersModel->find($document['tender_id']);
        if (!$tender) {
            throw new \Exception('Tender not found.');
        }

        $docType = $this->docTypesModel->find($document['doc_type_id']);
        if (!$docType) {
            throw new \Exception('Document type not found.');
        }

        // Prepare data to be passed to the view
        $data = [
            'document' => $document,
            'tender' => $tender,
            'docType' => $docType,
            'title' => 'Edit ' . esc($docType['name']) . ' for ' . esc($tender['name']),
        ];

        return view('tenders/tender_docs_edit', $data);
    }
}

public function tender_doc_delete($docId)
{
    // Find the document record by its ID
    $document = $this->tenderDocumentsModel->find($docId);

    // Check if the document exists
    if (!$document) {
        throw new \Exception('Document not found.');
    }

    // Determine the file path
    $filePath = WRITEPATH . $document['file'];

    // Delete the file from the filesystem if it exists
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Delete the document record from the database
    if (!$this->tenderDocumentsModel->delete($docId)) {
        throw new \Exception('Failed to delete tender document.');
    }

    // Redirect to the tender documents page with a success message
    return redirect()->to('/tender_docs/' . $document['tender_id'])->with('success', 'Document deleted successfully.');
}




    
}
