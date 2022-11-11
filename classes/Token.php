<?php

require_once("../core/init.php");

class Token
{

    private $_db;

    public function __construct()
    {
        $this->_db = Dbh::getInstance();
    }

    public function checkToken($token)
    {
        $this->updateToken();
        $list = $this->getAllToken();
        if (in_array($token, $list))
            return 1;
        else
            return 0;
    }

    //TOKEN THIS THING
    //generate | update | getAll | remove
    public function generateToken()
    {
        $time = time();
        $tokens = $this->getAllToken();

        if (!(in_array($time, $tokens))) {
            $this->_db->insert("tokens", array("data" => $time));
            return $time;
        } else
            return 0;
    }

    public function updateToken()
    {
        $time = time();
        $tokens = $this->_db->select("tokens", array("1", "=", "1"))->results();
        foreach ($tokens[0] as $key => $val) {
            $diff = $time - $val;
            if ($diff >= 3600)
                $this->_db->delete("tokens", array("data", "=", $val));
        }
        return $this;
    }

    public function getAllToken()
    {
        $final = array();
        $tokens = $this->_db->select("tokens", array("1", "=", "1"))->results();
        foreach ($tokens as $key => $val) {
            foreach ($val as $data) {
                array_push($final, $data);
            }
        }
        return $final;
    }

    public function removeToken($token)
    {
        $this->_db->delete("tokens", array("data", "=", $token));
    }
}
