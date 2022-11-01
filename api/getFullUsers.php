<?php

require_once "../core/init.php";

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: *");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST") {

    $data = json_decode(file_get_contents('php://input'));
    $user = $data->user;

    $db = Dbh::getInstance();
    $results = $db->select("users", array('1', '=', '1'))->results();

    if ($user == "")
        echo json_encode($results);
    else
        foreach ($results as $key => $val) {
            if ($val->{"uid"} == $user)
                echo json_encode($val);
        }
}
