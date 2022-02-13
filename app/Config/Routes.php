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
$routes->setDefaultController('Autenticacion');
$routes->setDefaultMethod('login');
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

$routes->get('/', 'MasterController::index');

$routes->group('platform', function ($routes) {
    $routes->get('dashboard', 'MasterController::index');

    // Productos
    $routes->get('productos', 'ProductoController::index');

    $routes->group('productos', function ($routes) {
        $routes->get('crear', 'ProductoController::crear');
        $routes->post('crear', 'ProductoController::guardar');
        $routes->get('editar/(:num)', 'ProductoController::editar/$1');
        $routes->put('editar/(:num)', 'ProductoController::actualizar');
        $routes->get('listado', 'ProductoController::listado');
        $routes->get('consultar/(:num)', 'ProductoController::consultar/$1');
    });

    // Ventas
    $routes->get('ventas', 'VentaController::index');

    $routes->group('ventas', function ($routes) {
        $routes->get('crear', 'VentaController::crear');
        $routes->post('crear', 'VentaController::guardar');
    });
});
