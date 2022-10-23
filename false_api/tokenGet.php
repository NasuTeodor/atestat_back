<?php 

require_once "../core/init.php";

$tk = new Token();

// print_r($tk->getAllToken()) ;

$tk->generateToken("2");

