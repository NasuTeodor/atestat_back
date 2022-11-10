<?php

require_once "../core/init.php";


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: *");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST") {

    $data = json_decode(file_get_contents('php://input'));
    $uid = $data->uid;

    $user = new User(" ", " ");
    $userList = $user->getUsers();
    $chatList = array();
    
    foreach($userList as $usr){
        if($usr->uid != $uid)
        {
            $chat = new Chat($uid, $usr->uid);
            $chat->setUsers($uid, $usr);
            if($chat->testFor())
                array_push($chatList, $usr);
        }
    }

    echo json_encode($chatList);

}