<?php

// Controllers
include_once('./app/controllers/HomeController.php');
include_once('./app/controllers/ExceptionController.php');

// URL parsing
$request_uri = $_SERVER['REQUEST_URI'];
$uri = parse_url($request_uri, PHP_URL_PATH);
$uri = rtrim($uri, '/');


// Routes
$routes = [
    '' => 'HomeController@index'
];

// Route the request
if (array_key_exists($uri, $routes)) {
    list($controllerName, $methodName) = explode('@', $routes[$uri]);

    $controller = new $controllerName();


    $controller->$methodName();
} else {
    // 404 error
    http_response_code(404);
    
    $controller = new ExceptionController();
    $controller->pageNotFound();
}
