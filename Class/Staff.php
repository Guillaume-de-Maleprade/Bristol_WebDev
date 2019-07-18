<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/config/db_connect.php');


class Staff
{
    public $username;
    public $mail;
    public $name;
    public $firstname;

    public function __construct($username, $mail, $name, $firstname)
    {
        $this->username = $username;
        $this->mail = $mail;
        $this->name = $name;
        $this->firstname = $firstname;
    }

    // CREATE
    public function insert()
    {
        myLog("username=$this->username\nmail=$this->mail\nname=$this->name\nfirstname=$this->firstname");
        $db = $GLOBALS['db'];
        $query = "INSERT INTO staff (username,mail,name,firstname) VALUES (?,?,?,?)";
        $req = $db->prepare($query);
        if ($req->execute([$this->username, $this->mail, $this->name, $this->firstname]) === TRUE){
            myLog("Staff member created");
        }
        else myLog("Failed to insert staff member");
    }
    // READ
    public static function readByUserName($username)
    {
        $db = $GLOBALS['db'];
        $username = $db->quote($username);
        $query = "SELECT * FROM staff WHERE username = $username";
        $result = $db->query($query);
        if ($result == false) {
            exit("Error PDO:query($query)");
        }

        $object = $result->fetchObject();
        if($object == FALSE) return NULL;
        $staff = new Staff($object->mail, $object->name, $object->firstname, $object->username);
        return $staff;
    }

    public static function readAll(){
        $db = $GLOBALS['db'];

        $query = "SELECT * FROM staff WHERE 1";
        $array = $db->query($query);
        if ($array == false) {
            exit("Error PDO:query($query)");
        }
        $stArray = [];
        foreach($array as $object) {
            $staff = new Staff($object['username'], $object['mail'], $object['name'], $object['firstname']);
            array_push($stArray, $staff);
        }
        return $stArray;
    }
    // UPDATE
    public function update(){

    }
    // DELETE
    public static function delete($username){
        $db = $GLOBALS['db'];
        $query  ="DELETE FROM staff WHERE username = $username";
        $result = $db->query($query);
        if($result == false){
            $errorMsg = $db->errorInfo()[2];
            exit("PDO:query('$query') : $errorMsg");
        }else{
            echo("Staff deleted");
        }
    }
}
