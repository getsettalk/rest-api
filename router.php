<?php
require 'routes.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Iterate through the defined routes
foreach ($routes as $route) {
    list($method, $pattern, $handler) = $route;

    // Check if the request method matches
    if ($method === $requestMethod) {
        // Create a regular expression pattern for the route
        $pattern = '^' . str_replace('/', '\/', $pattern) . '$';

        // Check if the request URI matches the pattern
        if (preg_match('/' . $pattern . '/', $requestUri, $matches)) {
            // Continue with your routing logic here

            list($controllerName, $action) = explode('@', $handler);
            require "./api/controllers/{$controllerName}.php";
            $controller = new $controllerName();

            // Extract parameters from the matches
            $parameters = [];

            if (isset($matches['id'])) {
                $parameters['id'] = $matches['id'];
            }

            $controller->$action($parameters); // Pass parameters to the action method
            exit; // Exit to prevent "Route not found" message
        }
    }
}

echo "Route not found"; // Display this message if no matching route is found
