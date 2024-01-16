<?php

// Controllers
include_once('./app/controllers/HomeController.php');
include_once('./app/controllers/BoardController.php');
include_once('./app/controllers/ExceptionController.php');
include_once('./app/controllers/ThreadController.php');

// Routes
include_once('./app/routes/web.php');
include_once('./app/routes/api.php');

// URL parsing
$request_uri = $_SERVER['REQUEST_URI'];
$uri = parse_url($request_uri, PHP_URL_PATH);
$uri = rtrim($uri, '/');

// Routes
$routes = [];

// Merge routes
$routes = array_merge($routes, $api_routes, $web_routes);

// Check if the requested route exists
$matched = false;
foreach ($routes as $route => $controllerAction) {
    $pattern = '/^' . str_replace('/', '\/', $route) . '$/';

    if (preg_match($pattern, $uri, $matches)) {
        // Extract slugs from the URL
        $slugs = array_slice($matches, 1);
        // Split the controller and method
        list($controllerName, $methodName) = explode('@', $controllerAction);
        // Create an instance of the controller
        $controller = new $controllerName();
        // Call the specified method, passing slugs as arguments
        call_user_func_array([$controller, $methodName], $slugs);
        $matched = true;
        break;
    }
}

if (!$matched) {
    // Handle 404 Not Found
    http_response_code(404);
    
    $controller = new ExceptionController();
    $controller->pageNotFound();
}
