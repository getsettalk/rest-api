<?php
namespace api\controllers;

class ApiController
{
    public $res = [];
    public static function getUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $res['message']="working Fine";
            $res['status']=true;
            $res['data']= $data;
            echo json_encode($res);

        } else {
            // Handle unsupported HTTP methods
            header('HTTP/1.1 405 Method Not Allowed');
            $res['message'] = '405 - Method Not Allowed';
            echo json_encode($res);
        }
    }
    public static function getUserID($id)
    {
        // Check if the request method is GET or POST
        if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'POST') {

            // Perform logic based on the $id
            if ($id !== null) {

                $userData = $id;


                // header('Content-Type: application/json');
                echo $id;
            } else {
                // Handle the case when no ID is provided
                echo "No user ID provided.";
            }
        } else {
            // Handle unsupported HTTP methods
            header('HTTP/1.1 405 Method Not Allowed');
            echo '405 - Method Not Allowed';
        }
    }


}