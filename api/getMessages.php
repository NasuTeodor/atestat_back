<?php

require_once "../core/init.php";

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: *");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST") {
    
    $data = json_decode(file_get_contents('php://input'));
    
    $uid1 = $data->uid1;
    $uid2 = $data->uid2;

    $chat = new Chat($uid1, $uid2);
    $exists = $chat->testFor();
    if(!$exists)
        echo "nu se are chatul";
    else{
        $mesaje = $chat->getMessages(50);
        echo json_encode($mesaje);
    }

}