<?php

require_once __DIR__ . '/../src/Router.php';
require_once __DIR__ . '/../src/helpers.php';

$router = new Router();

// Define routes
$router->get('/', 'HomeController@index');
// Account endpoints:
$router->get('/resource/register', 'AccountController@showRegisterForm');
$router->get('/resource/login', 'AccountController@showLoginForm');
$router->post('/account/create', 'AccountController@create');
$router->get('/users', 'AccountController@index');
$router->get('/user/{id}', 'AccountController@show');


// Dispatch request
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
