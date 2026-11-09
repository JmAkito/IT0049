<?php

namespace Config;

$routes = Services::routes();

$routes->get('/', 'AuthController::index');
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::attemptLogin');
$routes->get('logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');

    $routes->get('products', 'ProductController::index');
    $routes->get('products/new', 'ProductController::new');
    $routes->post('products', 'ProductController::create');
    $routes->get('products/(:num)/edit', 'ProductController::edit/$1');
    $routes->post('products/(:num)/update', 'ProductController::update/$1');
    $routes->post('products/(:num)/delete', 'ProductController::delete/$1');

    $routes->get('customers', 'CustomerController::index');
    $routes->get('customers/new', 'CustomerController::new');
    $routes->post('customers', 'CustomerController::create');
    $routes->get('customers/(:num)/edit', 'CustomerController::edit/$1');
    $routes->post('customers/(:num)/update', 'CustomerController::update/$1');
    $routes->post('customers/(:num)/delete', 'CustomerController::delete/$1');

    $routes->get('staff', 'StaffController::index');
    $routes->get('staff/new', 'StaffController::new');
    $routes->post('staff', 'StaffController::create');
    $routes->get('staff/(:num)/edit', 'StaffController::edit/$1');
    $routes->post('staff/(:num)/update', 'StaffController::update/$1');
    $routes->post('staff/(:num)/delete', 'StaffController::delete/$1');

    $routes->get('sales', 'SaleController::index');
    $routes->get('sales/new', 'SaleController::new');
    $routes->post('sales', 'SaleController::create');
});