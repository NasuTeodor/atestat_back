<?php

require_once "../core/init.php";

$chat = new Chat("user2", "user1");

$chat->testFor()." ";
print_r($chat->getMessages(1));