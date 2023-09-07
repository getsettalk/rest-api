<?php
use Medoo\Medoo;
require("vendor/autoload.php");

// Connect to the database.
$db = new Medoo([
    'type' => 'mysql',
    'host' => 'localhost',
    'database' => 'rimeso_network',
    'username' => 'root',
    'password' => ''
]);


?>