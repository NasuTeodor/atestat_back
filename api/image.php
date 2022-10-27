<?php

require_once "../core/init.php";


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: *");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST"){
    $data = json_decode(file_get_contents('php://input'));
    $img = $data->poza;
    echo json_encode($img);
}