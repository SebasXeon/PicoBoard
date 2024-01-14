<?php
$api_routes = [
    
];


// Add /api/ prefix to API routes
foreach ($api_routes as $route => $controllerAction) {
    $routes['/api' . $route] = $controllerAction;
}