<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'ViewsController::index', ['as' => 'view_home']);
$routes->get('/project', 'ViewsController::project', ['as' => 'view_project']);
$routes->get('/kriteria', 'ViewsController::kriteria', ['as' => 'view_kriteria']);
$routes->get('/data', 'ViewsController::data', ['as' => 'view_data']);
$routes->get('/hasil', 'ViewsController::hasil', ['as' => 'view_hasil']);


$routes->get('/api/v1/project', 'ProjectController::show', ['as' => 'api_get_project']);
$routes->post('/api/v1/project', 'ProjectController::store', ['as' => 'api_post_project']);
$routes->put('/api/v1/project', 'ProjectController::update', ['as' => 'api_put_project']);
$routes->delete('/api/v1/project', 'ProjectController::destroy', ['as' => 'api_delete_project']);

$routes->get('/api/v1/kriteria', 'KriteriaController::show', ['as' => 'api_get_kriteria']);
$routes->post('/api/v1/kriteria', 'KriteriaController::store', ['as' => 'api_post_kriteria']);
$routes->put('/api/v1/kriteria', 'KriteriaController::update', ['as' => 'api_put_kriteria']);
$routes->delete('/api/v1/kriteria', 'KriteriaController::destroy', ['as' => 'api_delete_kriteria']);

$routes->get('/api/v1/data', 'DataController::show', ['as' => 'api_get_data']);
$routes->post('/api/v1/data', 'DataController::store', ['as' => 'api_post_data']);
$routes->put('/api/v1/data', 'DataController::update', ['as' => 'api_put_data']);
$routes->delete('/api/v1/data', 'DataController::destroy', ['as' => 'api_delete_data']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
