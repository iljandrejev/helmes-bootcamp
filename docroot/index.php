<?php

use Phroute\Phroute\RouteCollector;

require_once "../src/bootstrap.php";

$router = new RouteCollector();

$router->get('/', ['Controller\Reservation','defaultView']);

$router->get('/reservation', ['Controller\Reservation','defaultView']);
$router->get('/reservation/create', ['Controller\Reservation','createView']);
$router->get('/reservation/edit/{id:i}', ['Controller\Reservation','editView']);
$router->get('/reservation/details/{id:i}', ['Controller\Reservation','detailsView']);
$router->get('/reservation/delete/{id:i}', ['Controller\Reservation','deleteView']);

$router->get('/contact', ['Controller\Contact','defaultView']);

$router->post('/reservation/add', ['Controller\Reservation','addAction']);
$router->post('/reservation/edit', ['Controller\Reservation','editAction']);
$router->post('/reservation/delete', ['Controller\Reservation','deleteAction']);

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
echo $response;