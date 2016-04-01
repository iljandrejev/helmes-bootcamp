<?php

use Phroute\Phroute\RouteCollector;

require_once "../src/bootstrap.php";

$router = new RouteCollector();
// GET: Index
$router->get('/', ['Controller\Reservation','defaultView']);

// GET: Reservations
$router->get('/reservation', ['Controller\Reservation','defaultView']);
$router->get('/reservation/create', ['Controller\Reservation','createView']);
$router->get('/reservation/edit/{id:i}', ['Controller\Reservation','editView']);
$router->get('/reservation/details/{id:i}', ['Controller\Reservation','detailsView']);
$router->get('/reservation/delete/{id:i}', ['Controller\Reservation','deleteView']);

// GET: Restaurants
$router->get('/restaurant',['Controller\Restaurant','defaultView']);
$router->get('/restaurant/create', ['Controller\Restaurant','createView']);
$router->get('/restaurant/edit/{id:i}', ['Controller\Restaurant','editView']);
$router->get('/restaurant/details/{id:i}', ['Controller\Restaurant','detailsView']);
$router->get('/restaurant/delete/{id:i}', ['Controller\Restaurant','deleteView']);

// GET: Contacts
$router->get('/contact', ['Controller\Contact','defaultView']);

// POST: Reservations
$router->post('/reservation/add', ['Controller\Reservation','addAction']);
$router->post('/reservation/edit', ['Controller\Reservation','editAction']);
$router->post('/reservation/delete', ['Controller\Reservation','deleteAction']);

// POST: Restaurants
$router->post('/restaurant/add', ['Controller\Restaurant','addAction']);
$router->post('/restaurant/edit', ['Controller\Restaurant','editAction']);
$router->post('/restaurant/delete', ['Controller\Restaurant','deleteAction']);

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
echo $response;