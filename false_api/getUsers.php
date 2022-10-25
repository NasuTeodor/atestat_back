<?php

require_once "../core/init.php";


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: *");


    // $db = Dbh::getInstance();
    $db = new Dbh();

    $users = $db->select("users", array("1", "=", "1"))->results();

    print_r($users[0]);
    foreach ($users as $key => $value) {
        print_r($value->uid." ");
    }    
