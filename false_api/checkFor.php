<?php

require_once "../core/init.php";

$chat = new Chat("user1", "user2");

// $chat->testFor()." ";
// print_r($chat->getMessages(1));

echo $chat->testFor();
// echo "<br>". $chat->_chat;