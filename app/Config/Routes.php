<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'BikesController::index', ['as' => 'home.index']);
$routes->get('/register', 'Home::register', ['as' => 'home.register']);
$routes->get('/login', 'Home::login', ['as' => 'home.login']);
$routes->get('/logout', 'Home::logout', ['as' => 'home.logout']);
$routes->get('/admin/sales', 'AdminsController::sales', ['as' => 'admin.sales']);

$routes->group('user', function ($routes) {
  $routes->get('', 'UsersController::index');
  $routes->get('me/(:segment)', 'UsersController::me/$1');
  $routes->post('login', 'UsersController::login', ['as' => 'user.login']);
  $routes->post('register', 'UsersController::create', ['as' => 'user.create']);
  $routes->put('update/(:segment)', 'UsersController::update/$1');
  $routes->delete('delete/(:segment)', 'UsersController::delete/$1');
});

$routes->group('admin/bike', function ($routes) {
  $routes->get('', 'AdminsController::index', ['as' => 'admin.bike']);
  $routes->get('add', 'AdminsController::add', ['as' => 'admin.bike-add']);
  $routes->get('update/(:segment)', 'AdminsController::update/$1', ['as' => 'admin.bike-update']);
});

$routes->group('bike', function ($routes) {
  $routes->get('', 'BikesController::index');
  $routes->get('(:segment)', 'BikesController::show/$1');
  $routes->post('create', 'BikesController::create', ['as' => 'bike.create']);
  $routes->post('update/(:segment)', 'BikesController::update/$1', ['as' => 'bike.update']);
  $routes->delete('delete/(:segment)', 'BikesController::delete/$1');
});

$routes->group('cart', function ($routes) {
  $routes->get('', 'CartController::index');
  $routes->get('(:segment)', 'CartController::show/$1');
  $routes->post('create', 'CartController::create');
  $routes->post('add', 'CartController::addToCart', ['as' => 'cart.add']);
  $routes->post('change_count', 'CartController::changeProductCount', ['as' => 'cart.count']);
});

$routes->group('transaction', function ($routes) {
  $routes->get('', 'TransactionsController::index', ['as' => 'transaction.history']);
  $routes->get('(:segment)', 'TransactionsController::show/$1');
  $routes->post('prepare', 'TransactionsController::prepare', ['as' => 'transaction.prepare']);
  $routes->post('payment', 'TransactionsController::payment', ['as' => 'transaction.payment']);
  $routes->delete('delete/(:segment)', 'TransactionsController::delete/$1');
});
