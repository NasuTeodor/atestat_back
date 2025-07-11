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
    $pass = $data->pass;

    if($uid == '' || $pass == '')
        exit();

    $user = new User($uid, $pass);
    $user->removeUser();

}