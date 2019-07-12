<?php
require_once('db_connect.php');

class Student
{
    public $username;
    public $mail;
    public $name;
    public $address;

    function __construct($username, $mail, $name, $address)
    {
        $this->username = $username;
        $this->mail = $mail;
        $this->name = $name;
        $this->address = $address;
    }


    public static function getByUserName($userName){
        $query = "SELECT * FROM student WHERE name = $userName";
        $result = $db->query($query);
        if($result==false) exit("erreur PDO:query($query)");
        $object = $result->fetchObject();
        $student = new Student($object->username, $object->mail, $object->name, $object->address);
        return $student;
    }

    function insertStudent(){
        $query = "INSERT INTO student VALUES (?,?,?,?)";
        $req = $db->prepare($query);
        $req->execute(array($this->username, $this->mail, $this->name, $this->address));
    }
}
