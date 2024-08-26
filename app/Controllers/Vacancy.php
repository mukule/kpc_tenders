<?php namespace App\Controllers;

use App\Models\VacancyModel;
use App\Models\VacancyFunctionModel;
use App\Models\EducationLevelsModel;
use App\Models\VacancyTypeModel;
use App\Models\UserModel;

class Vacancy extends BaseController
{
    protected $vacancyModel;
    protected $vacancyFunctionModel;
    protected $educationLevelsModel;
    protected $vacancyTypeModel;

    public function __construct()
    {
        $this->vacancyModel = new VacancyModel();
        $this->vacancyFunctionModel = new VacancyFunctionModel();
        $this->educationLevelsModel = new EducationLevelsModel();
        $this->vacancyTypeModel = new VacancyTypeModel();
        $this->userModel = new UserModel();
    }

    
    public function vacancies()
    {
        $data['title'] = 'Vacancies';
        $data['vacancies'] = $this->vacancyModel->findAll();
        $data['vacancy_functions'] = $this->vacancyFunctionModel->findAll();
        $data['education_levels'] = $this->educationLevelsModel->findAll();
        $data['vacancy_types'] = $this->vacancyTypeModel->findAll();
    
        
        $usersModel = new UserModel();
        $users = $usersModel->findAll();
        
        
        $data['users'] = [];
        foreach ($users as $user) {
            $data['users'][$user['id']] = $user;
        }
    
        return view('careers/vacancies', $data);
    }
    

    
    public function vacancies_create()
{
    $validation = \Config\Services::validation();
    $session = session(); 

    if ($this->request->getMethod() === 'POST') {
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'ref' => 'required|is_unique[vacancy.ref]',
            'open_date' => 'required|valid_date',
            'close_date' => 'required|valid_date',
            'vac_function' => 'required',
            'min_educational_level' => 'required',
            'vac_type' => 'required'
        ];

        
        if (! $this->validate($rules)) {
            $data = [
                'validation' => $this->validator->getErrors(),
                'title' => $this->request->getPost('title'),
                'ref' => $this->request->getPost('ref'),
                'open_date' => $this->request->getPost('open_date'),
                'close_date' => $this->request->getPost('close_date'),
                'vac_function' => $this->request->getPost('vac_function'),
                'min_educational_level' => $this->request->getPost('min_educational_level'),
                'vac_type' => $this->request->getPost('vac_type'),
                'vacancy_functions' => $this->vacancyFunctionModel->findAll(),
                'education_levels' => $this->educationLevelsModel->findAll(),
                'vacancy_types' => $this->vacancyTypeModel->findAll()
            ];

            $session->setFlashdata($data);
            return redirect()->back(); 
        }

        
        $errors = [];
        $openDate = $this->request->getPost('open_date');
        $closeDate = $this->request->getPost('close_date');
        $currentDate = date('Y-m-d');

        if ($openDate < $currentDate) {
            $errors['open_date'] = 'Open Date should be Higher than current Date';
        }

        if ($closeDate < $currentDate) {
            $errors['close_date'] = 'Close Date should be higher than Current Date';
        }

        if ($openDate > $closeDate) {
            $errors['date_range'] = 'Close date must be after open date.';
        }

        if (!empty($errors)) {
            $data = [
                'validation' => $errors,
                'title' => $this->request->getPost('title'),
                'ref' => $this->request->getPost('ref'),
                'open_date' => $this->request->getPost('open_date'),
                'close_date' => $this->request->getPost('close_date'),
                'vac_function' => $this->request->getPost('vac_function'),
                'min_educational_level' => $this->request->getPost('min_educational_level'),
                'vac_type' => $this->request->getPost('vac_type'),
                'vacancy_functions' => $this->vacancyFunctionModel->findAll(),
                'education_levels' => $this->educationLevelsModel->findAll(),
                'vacancy_types' => $this->vacancyTypeModel->findAll()
            ];

            $session->setFlashdata($data);
            return redirect()->back(); 
        }

        
        $userID = session()->get('user_id');
        if (!$userID) {
            return redirect()->to('/login')->with('error', 'User not logged in.');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'ref' => $this->request->getPost('ref'),
            'open_date' => $this->request->getPost('open_date'),
            'close_date' => $this->request->getPost('close_date'),
            'vac_function' => $this->request->getPost('vac_function'),
            'min_educational_level' => $this->request->getPost('min_educational_level'),
            'vac_type' => $this->request->getPost('vac_type'),
            'created_by' => $userID,
            'updated_by' => $userID
        ];

        $this->vacancyModel->insert($data);
        $session->setFlashdata('success', 'Vacancy created successfully.');
        return redirect()->to('/vacancies');
    }

    
    $data = [
        'title' => 'Create Vacancy',
        'vacancy_functions' => $this->vacancyFunctionModel->findAll(),
        'education_levels' => $this->educationLevelsModel->findAll(),
        'vacancy_types' => $this->vacancyTypeModel->findAll()
    ];

    
    if ($session->has('validation')) {
        $data['validation'] = $session->getFlashdata('validation');
    }
    if ($session->has('title')) {
        $data['title'] = $session->getFlashdata('title');
        $data['ref'] = $session->getFlashdata('ref');
        $data['open_date'] = $session->getFlashdata('open_date');
        $data['close_date'] = $session->getFlashdata('close_date');
        $data['vac_function'] = $session->getFlashdata('vac_function');
        $data['min_educational_level'] = $session->getFlashdata('min_educational_level');
        $data['vac_type'] = $session->getFlashdata('vac_type');
    }

    return view('careers/vacancies_create', $data);
}

    

public function vacancies_edit($id)
{
    $vacancy = $this->vacancyModel->find($id);

    if (!$vacancy) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Vacancy not found');
    }

    $validation = \Config\Services::validation();
    $session = session();

    if ($this->request->getMethod() === 'POST') {
        // Define validation rules
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'ref' => "required|is_unique[vacancy.ref,id,{$id}]",
            'open_date' => 'required|valid_date',
            'close_date' => 'required|valid_date',
            'vac_function' => 'required',
            'min_educational_level' => 'required',
            'vac_type' => 'required'
        ];

        // Validate the form data
        if (!$this->validate($rules)) {
            $data = [
                'validation' => $this->validator->getErrors(),
                'vacancy' => $vacancy,
                'title' => 'Edit Vacancy',
                'vacancy_functions' => $this->vacancyFunctionModel->findAll(),
                'education_levels' => $this->educationLevelsModel->findAll(),
                'vacancy_types' => $this->vacancyTypeModel->findAll()
            ];
            return view('careers/vacancies_edit', $data);
        }

        // Extract and validate date fields
        $openDate = $this->request->getPost('open_date');
        $closeDate = $this->request->getPost('close_date');
        $currentDate = date('Y-m-d');

        $errors = [];

        if ($openDate < $currentDate) {
            $errors['open_date'] = 'Open Date should be higher than the current date.';
        }

        if ($closeDate < $currentDate) {
            $errors['close_date'] = 'Close Date should be higher than the current date.';
        }

        if ($openDate > $closeDate) {
            $errors['date_range'] = 'Close date must be after open date.';
        }

        if (!empty($errors)) {
            $data = [
                'validation' => $errors,
                'vacancy' => $vacancy,
                'title' => 'Edit Vacancy',
                'vacancy_functions' => $this->vacancyFunctionModel->findAll(),
                'education_levels' => $this->educationLevelsModel->findAll(),
                'vacancy_types' => $this->vacancyTypeModel->findAll()
            ];
            return view('careers/vacancies_edit', $data);
        }

        // Process form submission
        $userID = session()->get('user_id');

        $data = [
            'title' => $this->request->getPost('title'),
            'ref' => $this->request->getPost('ref'),
            'open_date' => $this->request->getPost('open_date'),
            'close_date' => $this->request->getPost('close_date'),
            'vac_function' => $this->request->getPost('vac_function'),
            'min_educational_level' => $this->request->getPost('min_educational_level'),
            'vac_type' => $this->request->getPost('vac_type'),
            'updated_by' => $userID
        ];

        $this->vacancyModel->update($id, $data);
        session()->setFlashdata('success', 'Vacancy updated successfully.');
        return redirect()->to('/vacancies');
    }

    // Prepare data for the form view
    $data['vacancy'] = $vacancy;
    $data['title'] = 'Edit Vacancy';
    $data['vacancy_functions'] = $this->vacancyFunctionModel->findAll();
    $data['education_levels'] = $this->educationLevelsModel->findAll();
    $data['vacancy_types'] = $this->vacancyTypeModel->findAll();

    return view('careers/vacancies_edit', $data);
}

    // Delete a vacancy
    public function delete($id)
    {
        $this->vacancyModel->delete($id);
        session()->setFlashdata('success', 'Vacancy deleted successfully.');
        return redirect()->to('/vacancies');
    }
}
