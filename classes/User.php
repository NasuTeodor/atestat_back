<?php

require_once("../core/init.php");

class User
{
    private $_db, $_uid, $_pass;

    public function __construct($uid, $pass)
    {

        $this->_db = Dbh::getInstance();
        // $this->_db = new Dbh();
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

        if (count($result) == 0)
            return 0;

        if ($result[0]->{'uid'} == $this->_uid && $result[0]->{'pass'} == $this->_pass)
            return 1;
        else return 0;
    }

    public function removeUser()
    {
        if ($this->fullCheck())
            $this->_db->delete("users", array("pass", "=", $this->_pass));
    }

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

    public function updateImge($img)
    {
        $sql = 'UPDATE users SET poza = ? WHERE uid = ?';
        $this->_db->query($sql, array($img, $this->_uid));
    }

    //CHECK FOR ALREADY TAKEN TO BE USED IN CREATE USER
    public function takenUser()
    {
        $users = $this->_db->select("users", array("1", "=", "1"))->results();

        foreach ($users as $key => $val) {
            if ($this->_uid == $val->{"uid"})
                return 1;
        }

        // nu pot sa cred ca verific si astea || greseala la struct bazei de date

        foreach ($users as $key => $val) {
            if ($this->_pass == $val->{"pass"})
                return 1;
        }
        return 0;
    }

    public function getUsers()
    {
        $results = $this->_db->select("users", array("1", "=", "1"))->results();
        return $results;
    }
}
