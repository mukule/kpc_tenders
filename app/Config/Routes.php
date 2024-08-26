<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 //Auth Routes
$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::login');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::register');
$routes->get('/editStaff/(:num)', 'AuthController::editStaff/$1');
$routes->post('/editStaff/(:num)', 'AuthController::editStaff/$1');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/updateStaffStatus/(:num)', 'AuthController::updateStaffStatus/$1');

//Home routes
$routes->get('/home', 'Home::index');
$routes->get('/staffs', 'Home::staffs');
$routes->get('/departments', 'Home::departments');
$routes->get('/departments/create', 'Home::createDepartment');
$routes->post('/departments/store', 'Home::storeDepartment');
$routes->get('/tenders', 'Home::tenders');
$routes->get('/careers', 'Home::careers');

//careers
$routes->get('/edu_lvls', 'Careers::edu_lvls');
$routes->get('careers/create_edu_lvls', 'Careers::create_edu_lvls');
$routes->post('careers/create_edu_lvls', 'Careers::create_edu_lvls');
$routes->get('careers/edit_edu_lvls/(:num)', 'Careers::edit_edu_lvls/$1');
$routes->post('careers/edit_edu_lvls/(:num)', 'Careers::edit_edu_lvls/$1');
$routes->get('careers/del_edu_lvls/(:num)', 'Careers::delete/$1');

$routes->get('/job_functions', 'VacancyFunctions::job_functions');
$routes->get('careers/job_functions_create', 'VacancyFunctions::job_functions_create');
$routes->post('careers/job_functions_create', 'VacancyFunctions::job_functions_create');
$routes->get('/careers/job_functions_edit/(:num)', 'VacancyFunctions::job_functions_edit/$1');
$routes->post('/careers/job_functions_edit/(:num)', 'VacancyFunctions::job_functions_edit/$1');
$routes->get('delete_job_function/(:num)', 'VacancyFunctions::delete_job_function/$1');

$routes->get('/job_types', 'VacancyTypes::job_types');
$routes->get('/careers/job_types_create', 'VacancyTypes::job_types_create');
$routes->post('/careers/job_types_create', 'VacancyTypes::job_types_create');
$routes->get('/careers/job_types_edit/(:num)', 'VacancyTypes::job_types_edit/$1');
$routes->post('/careers/job_types_edit/(:num)', 'VacancyTypes::job_types_edit/$1');
$routes->get('/delete_job_type/(:num)', 'VacancyTypes::delete_job_type/$1');

$routes->get('/vacancies', 'Vacancy::vacancies');
$routes->get('/careers/vacancies_create', 'Vacancy::vacancies_create');
$routes->post('/careers/vacancies_create', 'Vacancy::vacancies_create');
$routes->get('/careers/vacancies_edit/(:num)', 'Vacancy::vacancies_edit/$1');
$routes->post('/careers/vacancies_edit/(:num)', 'Vacancy::vacancies_edit/$1');
$routes->get('/vacancies_delete/(:num)', 'Vacancy::delete/$1');

//eligibility
$routes->get('/eligibilities', 'Eligibility::eligibilities');
$routes->get('/tenders/eligibilities_create', 'Eligibility::eligibilities_create');
$routes->post('/tenders/eligibilities_create', 'Eligibility::eligibilities_create');
$routes->get('/tenders/eligibilities_edit/(:num)', 'Eligibility::eligibilities_edit/$1');
$routes->post('/tenders/eligibilities_edit/(:num)', 'Eligibility::eligibilities_edit/$1');
$routes->get('/delete_eligibility/(:num)', 'Eligibility::delete_eligibility/$1');

//Doc types
$routes->get('/docs', 'DocTypes::docs');
$routes->get('/tenders/docs_create', 'DocTypes::docs_create');
$routes->post('/tenders/docs_create', 'DocTypes::docs_create');
$routes->get('/tenders/docs_edit/(:num)', 'DocTypes::docs_edit/$1');
$routes->post('/tenders/docs_edit/(:num)', 'DocTypes::docs_edit/$1');
$routes->get('/docs_delete/(:num)', 'DocTypes::docs_delete/$1');

//Tenders
$routes->get('/tender_uploads', 'Tenders::tenders');  
$routes->get('tenders/tenders_create', 'Tenders::tenders_create');
$routes->post('create', 'Tenders::create');
$routes->get('edit/(:num)', 'Tenders::edit/$1'); 
$routes->post('edit/(:num)', 'Tenders::edit/$1'); 
$routes->get('delete/(:num)', 'Tenders::delete/$1'); 