<?php

require_once "../core/init.php";

$uid = "user1";

$user = new User(" ", " ");
$userList = $user->getUsers();

$chatList = array();

foreach ($userList as $usr) {
    if ($usr != $uid) {
        $chat = new Chat($uid, $usr);
        if ($chat->testFor()) {
            echo "am gasit ina";
            array_push($chatList, $chat->_chat);
        }
    }
}

print_r($chatList);
