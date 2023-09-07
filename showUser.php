<?php
// Set the Content-Type header to indicate JSON response
header('Content-Type: application/json');

// Set additional headers
header('Access-Control-Allow-Origin: *'); // Allow cross-origin requests (CORS)
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE'); // Specify allowed HTTP methods
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Specify allowed headers
header('Cache-Control: no-cache, must-revalidate'); // Prevent caching

require "./inc/config.php";
// ✔✔ user (member) registration api


// Define an endpoint for getting data
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Assuming you have a "users" table
    $data = $db->select('users', '*');
    http_response_code(200); // 200 OK
    echo json_encode($data);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed']);
}

?>