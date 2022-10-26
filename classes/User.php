<?php

require_once("../core/init.php");

class User
{
    private $_db, $_uid, $_pass;

    public function __construct($uid, $pass)
    {

        // $this->_db = Dbh::getInstance();
        $this->_db = new Dbh();
        $this->_uid = $uid;
        $this->_pass = $pass;
    }

    public function setCreds($uid, $pass)
    {
        $this->_uid = $uid;
        $this->_pass = $pass;
    }

    public function fullCheck()
    {
        $result = $this->_db->select("users", array("pass", "=", $this->_pass))->results();
        // if(in_array($this->_uid, $result[0]))
        //     return 1;
        // else
        //     return 0;
        // print_r($result[0]->{'pass'});

        if(count($result) == 0)
            return 0;

        if ($result[0]->{'uid'} == $this->_uid && $result[0]->{'pass'} == $this->_pass)
            return 1;
        else return 0;
    }

    public function removeUser()
    {
        $this->_db->delete("users", array("pass", "=", $this->_pass));
    }

    //corecteaza campurile pentru baza
    public function createUser($img)
    {
        $taken = $this->takenUser();
        if (!$taken) {
            $this->_db->insert("users", array(
                "uid" => $this->_uid,
                "pass" => $this->_pass,
                "poza" => $img
        ));
            return 1;
        } else
            return 0;
    }

    //CHECK FOR ALREADY TAKEN TO BE USED IN CREATE USER
    private function takenUser()
    {
        $users = $this->_db->select("users", array("1", "=", "1"))->results();
        // if(in_array($this->_uid ,$users[0]->{'uid'}))
        //     return 1;
        // else return 0;
        // print_r($users);
        // echo " <br>";
        foreach ($users as $key => $val) {
            if ($this->_uid == $val->{"uid"})
                return 1;
        }
        return 0;
    }

    public function getUsers()
    {
        $results = $this->_db->select("users", array("1", "=", "1"))->results();
        $users = array();
        foreach($results as $key=>$val){
            array_push($users, $val->{"uid"});
        }
        return $users;
    }
}
