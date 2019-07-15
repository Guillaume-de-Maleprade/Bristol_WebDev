<?php

require 'db_connect.php';

class Staff
{
    public $username;
    public $mail;
    public $name;
    public $firstname;

    public function __construct($mail, $name, $firstname, $username)
    {
        /*if(strlen($username) < 2){
            $username = $name .".". $firstname;
            $i = "";
            while(readByUserName($username . $i)!= NULL){
                if(strlen($i)<1) $i = 0;
                $i++;
            }
            $username .= $i;
        }
        if(strlen($mail) < 2){
            $mail = $username."@uwe.ac.uk";
        }*/

        $this->username = $username;
        $this->mail = $mail;
        $this->name = $name;
        $this->firstname = $firstname;
    }

    // CREATE
    public function insert()
    {
        $query = "INSERT INTO staff (username,mail,name,firstname) VALUES (?,?,?,?)";
        $req = $db->prepare($query);
        $req->execute(array($this->username, $this->mail, $this->name, $this->firstname));
    }
    // READ
    public static function readByUserName($userName)
    {
        $query = "SELECT * FROM staff WHERE username = $userName";
        $result = $db->query($query);
        if($result==false) return NULL;
        $object = $result->fetchObject();
        $staff = new Staff($object->username, $object->mail, $object->name);
        return $staff;
    }
    // UPDATE
    public function update(){

    }
    // DELETE
    public function delete($username){
        $query  ="DELETE FROM staff WHERE username = $username";
        $result = $bdd->query($query);
        if($result == false){
            $errorMsg = $bdd->errorInfo()[2];
            exit("PDO:query('$query') : $errorMsg");
        }else{
            echo("Staff deleted");
        }
    }
}
