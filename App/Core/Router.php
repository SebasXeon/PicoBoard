<?php

// Routes
use App\Routes\WebRoutes;
use App\Routes\ApiRoutes;

// URL parsing
$request_uri = $_SERVER['REQUEST_URI'];
$uri = parse_url($request_uri, PHP_URL_PATH);
$uri = rtrim($uri, '/');

// Routes
$routes = [];

// Web routes
$webRoutes = new WebRoutes();
$routes = array_merge($routes, $webRoutes->routes());

// API routes
$apiRoutes = new ApiRoutes();
$routes = array_merge($routes, $apiRoutes->routes());

// Check if the requested route exists
$matched = false;
foreach ($routes as $route => $controllerAction) {
    $pattern = '/^' . str_replace('/', '\/', $route) . '$/';

    if (preg_match($pattern, $uri, $matches)) {
        // Extract slugs from the URL
        $slugs = array_slice($matches, 1);
        // Split the controller and method
        list($controllerName, $methodName) = explode('@', $controllerAction);
        // Prepend the namespace
        $controllerName = 'App\\Controllers\\' . $controllerName;
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
