<?php

require_once "../core/init.php";


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: *");

$method = $_SERVER['REQUEST_METHOD'];

//NU STIU DACA MERGE AI GRIJA CAMARADE
if ($method == "POST") {

    $data = json_decode(file_get_contents('php://input'));
    $uid = $data->uid;

    $chat = new Chat($uid, $uid);
    $user = new User(" ", " ");
    $userList = $user->getUsers();
    $chatList = array();

    foreach($userList as $usr){
        if($usr != $uid)
        {
            $chat->setUsers($uid, $usr);
            $conv = $chat->testFor();
            if($conv)
                array_push($chatList, $chat->chat);
        }
    }

    echo json_encode($chatList);

}