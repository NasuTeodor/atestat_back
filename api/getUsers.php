<?php

require_once "../core/init.php";


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: *");

$method = $_SERVER['REQUEST_METHOD'];

//NU STIU DACA MERGE AI GRIJA CAMARADE
if ($method) {

    $data = json_decode(file_get_contents('php://input'));

    // if($data->uid1 == "" || !is_nan($data->uid1))
    //     return "user gol";
    // if($data->uid2 == "" || !is_nan($data->uid2))
    //     return "user gol";

    $db = Dbh::getInstance();
    // $db = new Dbh();

    $results = $db->select("users", array('1','=','1'))->results();
    $users = array();

    foreach ($results as $key => $value) {
        // foreach($value)
        // print_r($value->uid);
        array_push($users, $value->uid);
    }
    
    echo json_encode($users);

}