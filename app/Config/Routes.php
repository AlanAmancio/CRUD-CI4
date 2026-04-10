<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// rotas de cargos
$routes->get('/', 'DashboardController::index');
$routes->get('/cargos', 'CargosController::index');
$routes->get('/cargos/new', 'CargosController::new');
$routes->post('/cargos/create', 'CargosController::create');
$routes->get('/cargos/edit/(:num)', 'CargosController::edit/$1');
$routes->post('/cargos/update/(:num)', 'CargosController::update/$1');
$routes->get('/cargos/delete/(:num)', 'CargosController::delete/$1');

// rota de funcionarios
$routes->get('/funcionarios', 'FuncionariosController::index');
$routes->get('/funcionarios/new', 'FuncionariosController::new');
$routes->post('/funcionarios/create', 'FuncionariosController::create');
$routes->get('/funcionarios/edit/(:num)', 'FuncionariosController::edit/$1');
$routes->post('/funcionarios/update/(:num)', 'FuncionariosController::update/$1');
$routes->get('/funcionarios/delete/(:num)', 'FuncionariosController::delete/$1');
