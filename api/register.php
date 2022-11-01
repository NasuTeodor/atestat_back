<?php

require_once "../core/init.php";

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: *");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST") {

    $data = json_decode(file_get_contents('php://input'));
    $user = trim($data->user);
    $pass = trim($data->pass);
    $again = trim($data->again);
    $poza = $data->poza;

    if ($user == "") {
        echo "user gol";
        exit();
    }
    if ($pass == "" || $pass != $again) {
        echo "parola invalida";
        exit();
    }

    $us = new User($user, $pass);
    $taken = $us->takenUser();
    if ($taken) {
        echo "user existent";
        exit();
    }

    if (!$taken)
        $did = $us->createUser($poza);

    echo "user created";
}
