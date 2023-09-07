<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow cross-origin requests (CORS)
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE'); // Specify allowed HTTP methods
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Specify allowed headers
header('Cache-Control: no-cache, must-revalidate'); // Prevent caching

require_once 'vendor/autoload.php'; // Include Composer's autoloader

$request_uri = $_SERVER['REQUEST_URI'];
$routeFound = false;
$routes = require_once './routes.php';

// Modify the request_uri to match the defined routes
$request_uri = str_replace('/rimeso_network', '', $request_uri);

foreach ($routes as $route => $handler) {
    // Check if the route contains parameter placeholders
    if (strpos($route, '{') !== false && strpos($route, '}') !== false) {
        // Replace parameter placeholders with regex patterns
        $pattern = preg_quote($route);
        $pattern = preg_replace('/\\\{([^}]+)\\\}/', '([^/]+)', $pattern);

        // Perform a regex match on the request_uri
        if (preg_match("#^$pattern$#", $request_uri, $matches)) {
            list($controller, $method) = explode('@', $handler);
            $controller = 'api\\controllers\\' . $controller;

            // Check if the controller class exists before calling its method
            if (class_exists($controller)) {
                // Extract the captured parameters from $matches
                $params = array_slice($matches, 1); // Skip the first match (the full URL)
                $controller::$method(...$params); // Call the controller method with parameters
                $routeFound = true;
                break; // Break the loop once a matching route is found
            }
        }
    } elseif ($request_uri === $route) {
        list($controller, $method) = explode('@', $handler);
        $controller = 'api\\controllers\\' . $controller;

        // Check if the controller class exists before calling its method
        if (class_exists($controller)) {
            $controller::$method();
            $routeFound = true;
            break; // Break the loop once a matching route is found
        }
    }
}


if (!$routeFound) {
    header('HTTP/1.1 404 Not Found');
    echo json_encode(array("status"=>false, "messge"=>"404 - Route Not Found"));
}
?>