<?php

require_once("../core/init.php");

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: *");

$method = $_SERVER['REQUEST_METHOD'];

// if ($method == "POST") {
if(1){

    $data = json_decode(file_get_contents('php://input'));

    $db = Dbh::getInstance();
    // $db = new Dbh();

    $list = $db->select("test", array("1", "=", "1"))->results();

    // $names = array();

    // foreach ($list as $item) {
    //     array_push($names, $item->{"name"});
    // }
    echo json_encode($list);
}
