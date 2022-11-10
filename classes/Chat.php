<?php

require_once "../core/init.php";

class Chat
{

    public $_db, $_uid1, $_uid2, $_chat;

    public function __construct($user1, $user2)
    {
        $this->_db = Dbh::getInstance();
        // $this->_db = new Dbh();
        $this->_uid1 = $user1;
        $this->_uid2 = $user2;
    }

    public function setUsers($uid1, $uid2)
    {
        $this->uid1 = $uid1;
        $this->uid2 = $uid2;
        $this->_chat = "";
    }

    // ESTE 100% VULNERABIL LA SQL INJECTION SI SUNT CONSTIENT DE ASTA
    public function testFor()
    {
        $test1 = "DESCRIBE chat" . $this->_uid1 . $this->_uid2;
        $test2 = "DESCRIBE chat" . $this->_uid2 . $this->_uid1;

        // echo $test1 . "<br>" . $test2 . "<br>";

        $result1 = $this->_db->special_query($test1);
        $result2 = $this->_db->special_query($test2);

        // echo $result1 . "<br>" . $result2;
        if ($result1 || $result2) {
            if ($result1) {
                $this->_chat = explode(" ", $test1)[1];
            } else {
                $this->_chat = explode(" ", $test2)[1];
            }
            return 1;
        }
        return 0;
    }

    //ESTE LA FEL DE VULNERABILA LA SQL INJECTION
    public function createChat()
    {
        if (!$this->testFor()) {
            $sql = 'CREATE TABLE chat' . $this->_uid1 . $this->_uid2 . '( uid varchar(256), mesaj varchar(1024), timp int(11) )';
            $this->_db->query($sql, array());
        }
    }

    public function getMessages($numberOf)
    {
        // echo $this->_chat;
        $mesaje = $this->_db->select_order($this->_chat, array('1', '=', '1'))->results();
        $firstN = array_slice($mesaje, 0, $numberOf, true);
        $firstN = array_reverse($firstN);
        return $firstN;
    }
}
