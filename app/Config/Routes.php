<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'BooksController::index', ['as' => 'home.index']);
$routes->get('/register', 'Home::register', ['as' => 'home.register']);
$routes->get('/login', 'Home::login', ['as' => 'home.login']);
$routes->get('/logout', 'Home::logout', ['as' => 'home.logout']);

$routes->group('user', function ($routes) {
  $routes->get('', 'UsersController::index');
  $routes->get('me/(:segment)', 'UsersController::me/$1');
  $routes->post('login', 'UsersController::login', ['as' => 'user.login']);
  $routes->post('register', 'UsersController::create', ['as' => 'user.create']);
  $routes->put('update/(:segment)', 'UsersController::update/$1');
  $routes->delete('delete/(:segment)', 'UsersController::delete/$1');
});

$routes->group('book', function ($routes) {
  $routes->get('', 'BooksController::index');
  $routes->get('(:segment)', 'BooksController::show/$1');
  $routes->post('create', 'BooksController::create');
  $routes->put('update/(:segment)', 'BooksController::update/$1');
  $routes->delete('delete/(:segment)', 'BooksController::delete/$1');
});

$routes->group('transaction', function ($routes) {
  $routes->get('', 'TransactionsController::index', ['as' => 'transaction.history']);
  $routes->get('(:segment)', 'TransactionsController::show/$1');
  $routes->post('prepare', 'TransactionsController::prepare', ['as' => 'transaction.prepare']);
  $routes->post('payment', 'TransactionsController::payment', ['as' => 'transaction.payment']);
  $routes->put('update/(:segment)', 'TransactionsController::update/$1');
  $routes->delete('delete/(:segment)', 'TransactionsController::delete/$1');
});
