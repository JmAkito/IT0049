<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public pages
$routes->get('/', 'Pages::home');
$routes->get('/about', 'Pages::about');
$routes->get('/profile', 'Pages::profile');
$routes->get('/tasks', 'Tasks::index');

// Authentication
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::authenticate');
$routes->get('/logout', 'Auth::logout');

// Protected task-management actions
$routes->get('/tasks/new', 'Tasks::new', ['filter' => 'auth']);
$routes->post('/tasks', 'Tasks::create', ['filter' => 'auth']);
$routes->get('/tasks/(:num)/edit', 'Tasks::edit/$1', ['filter' => 'auth']);
$routes->post('/tasks/(:num)/update', 'Tasks::update/$1', ['filter' => 'auth']);
$routes->post('/tasks/(:num)/archive', 'Tasks::archive/$1', ['filter' => 'auth']);