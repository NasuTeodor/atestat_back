<?php
//POATE POATE VEZI SA NU SE SUPERE
session_start();

header('Access-Control-Allow-Origin: http://localhost:3000');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: *");

//SI MAI MULT KAMIKAZE
// $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
// $cleardb_server = $cleardb_url["host"];
// $cleardb_username = $cleardb_url["user"];
// $cleardb_password = $cleardb_url["pass"];
// $cleardb_db = substr($cleardb_url["path"], 1);
// $active_group = 'default';
// $query_builder = TRUE;

// spl_autoload_register(function ($class) {
//     if (file_exists('./classes/' . $class . '.php')) {
//         require_once './classes/' . $class . ".php";
//     } else {
//         require_once '../classes/' . $class . ".php";
//     }
// });

spl_autoload_register('loader');

function loader($class){
    if (file_exists('./classes/' . $class . '.php')) {
        require_once './classes/' . $class . ".php";
    } else {
        require_once '../classes/' . $class . ".php";
    }
};