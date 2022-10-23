<?php

require_once("../core/init.php");

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: *");

$method = $_SERVER['REQUEST_METHOD'];

//NU STIU DACA MERGE AI GRIJA CAMARADE
if ($method == "POST") {

    $data = json_decode(file_get_contents('php://input'));
    // echo $data->user . " " . $data->pass;
    if($data->user == "" || $data->pass == ""){
        echo "gol";
        exit();
    }
    $user = new User($data->user, $data->pass);
    $user->setCreds($data->user, $data->pass);
    $token = new Token();

    if($user->fullCheck()){
        if(isset($_SESSION["token"])){
            $token->updateToken();
            if($token->checkToken($_SESSION['token'])){
                echo "esti bun bv";
            } else {
                unset($_SESSION['token']);
                echo "esti prost de ai asta";
            }

        } else {
            $token->updateToken();
            $gen = $token->generateToken(); 
            if($gen != 0)
                echo json_encode($gen);
            else
                echo "meci mai prst";
        }

    } else 
        echo "user prost bv";

}
