<?php

require_once "../core/init.php";

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: *");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST") {

    $data = json_decode(file_get_contents('php://input'));

    $db = Dbh::getInstance();
    // $db = new Dbh();

    $results = $db->select("users", array('1','=','1'))->results();
    $users = array();

    foreach ($results as $key => $value) {
        // print_r($value->uid);
        array_push($users, $value->uid);
    }
    
    echo json_encode($users);

}