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
