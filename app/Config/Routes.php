<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::store');
$routes->get('/', 'AuthController::login');
$routes->post('/authenticate', 'AuthController::authenticate');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'authGuard']);
$routes->get('/profile', 'DashboardController::profile', ['filter' => 'authGuard']);
$routes->post('/profile/update', 'DashboardController::updateProfile', ['filter' => 'authGuard']);
$routes->get('/dashboard', 'SearchController::index', ['filter' => 'authGuard']);
$routes->post('/search', 'SearchController::search', ['filter' => 'authGuard']);
