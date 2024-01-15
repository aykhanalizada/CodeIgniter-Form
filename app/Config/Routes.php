<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login','Home::login');
$routes->get('/register','Home::register');
$routes->get('/profile','Home::profile');

$routes->post('/register','Home::register');
$routes->post('/login','Home::login');

$routes->get('/logout','Home::logout');

