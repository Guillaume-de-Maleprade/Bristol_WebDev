<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/config/db_connect.php');


function addComponentToModule($moduleID, $name, $percentage, $type)
{
    if (is_numeric($percentage) && $percentage >= 0 && $percentage <= 100)
    {
        // ajout uniquement si
        $query = "INSERT INTO component VALUES ($moduleID, $name, $percentage, $type)";
    }
    else {
        // PANIC
    }
}

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

    public function createModule($moduleName)
    {
        /*
         * 1. create module
         * 2. add entry in the teaching table
         */
        $query = "INSERT into module VALUES ($moduleName)";
        if ($db->exec($query) === true){
            $moduleRes = $db->$query("SELECT * INTO module WHERE titre=$moduleName");
            if ($moduleRes == false) exit("erreur PDO query : $query");
            $module = $moduleRes->fetchObject();
            $db->exec("INSERT INTO teaching VALUES ($module->id, $this->username)");
        }

    }


}
