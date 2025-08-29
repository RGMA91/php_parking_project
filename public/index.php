<?php

$envPath = __DIR__ . '/../.env';
// Load .env variables
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue; // Skip comments
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $_ENV[trim($name)] = trim($value);
        }
    }
}

require_once __DIR__ . '/../src/Router.php';
require_once __DIR__ . '/../src/helpers.php';

$router = new Router();

// Define routes
$router->get('/', 'HomeController@index');
// Account endpoints:
$router->get('/resource/register', 'AccountController@showRegisterForm');
$router->get('/resource/login', 'AccountController@showLoginForm');
$router->post('/account/create', 'AccountController@create');
$router->post('/account/login', 'AccountController@login');

// Authorization endpoints:
$router->post('/jwtvalidation', 'AuthorizationController@validate');

// Parking endpoints:
$router->get('/parking/list','ParkingController@getParkingList');

// Booking endpoints:
$router->get('/resource/booking','BookingController@getBookingForm');
$router->post('/booking/create','BookingController@create');


// Dispatch request
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
