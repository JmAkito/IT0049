<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public pages
$routes->get('/', 'Pages::home');
$routes->get('/about', 'Pages::about');

// Authentication routes
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::authenticate');
$routes->get('/logout', 'Auth::logout');

// Protected customer routes
$routes->group('customers', ['filter' => 'auth'], static function ($routes) {
    $routes->get('', 'Customers::index');
    $routes->get('new', 'Customers::new');
    $routes->post('', 'Customers::create');
    $routes->get('(:num)/edit', 'Customers::edit/$1');
    $routes->post('(:num)/update', 'Customers::update/$1');
});

// Protected user routes
$routes->group('users', ['filter' => 'auth'], static function ($routes) {
    $routes->get('', 'Users::index');
    $routes->get('new', 'Users::new');
    $routes->post('', 'Users::create');
    $routes->get('(:num)/edit', 'Users::edit/$1');
    $routes->post('(:num)/update', 'Users::update/$1');
});