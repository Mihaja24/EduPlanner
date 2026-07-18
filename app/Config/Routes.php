<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/cours_list', 'CoursControllers::index');

$routes->group('admin/cours', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
    $routes->get('/', 'CoursController::index');
    $routes->get('new', 'CoursController::new');
    $routes->post('create', 'CoursController::create');
    $routes->get('edit/(:num)', 'CoursController::edit/$1');
    $routes->put('update/(:num)', 'CoursController::update/$1');
    $routes->delete('delete/(:num)', 'CoursController::delete/$1');
});

$routes->group('api/cours', ['namespace' => 'App\Controllers\API'], static function($routes) {
    $routes->get('/', 'CoursAPIController::index');
    $routes->put('(:num)/volume-horaire', 'CoursAPIController::updateVolumeHoraire/$1');
});