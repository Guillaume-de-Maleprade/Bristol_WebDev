<?php

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/config/db_connect.php');

class Student
{
    public $username;
    public $mail;
    public $name;
    public $firstname;
    public $address;


    public function __construct($mail, $name, $firstname, $address, $username)
    {
        $this->username = $username;
        $this->mail = $mail;
        $this->name = $name;
        $this->firstname = $firstname;
        $this->address = $address;
    }

    // CREATE
    public function insert()
    {
        try {
            $db = $GLOBALS['db'];
            $query = "INSERT INTO student (username, mail, name, firstname, address) VALUES (?,?,?,?,?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$this->username, $this->mail, $this->name, $this->firstname, $this->address]);
        } catch (PDOException $e) {
            die($e);
        }
    }

    // READ
    public static function readByUserName($username)
    {
        $db = $GLOBALS['db'];
        $username = $db->quote($username);
        $query = "SELECT * FROM student WHERE username = $username";
        $array = $db->query($query);
        if ($array == false) {
            exit("Error PDO:query($query)");
        }
        $stArray = [];
        foreach($array as $object) {
            $student = new Student($object['mail'], $object['name'], $object['firstname'], $object['address'], $object['username']);
            array_push($stArray, $student);
        }
        return $stArray;
    }

    public static function readAll(){
        $db = $GLOBALS['db'];

        $query = "SELECT * FROM student WHERE 1";
        $array = $db->query($query);
        if ($array == false) {
            exit("Error PDO:query($query)");
        }
        $stArray = [];
        foreach($array as $object) {
            $student = new Student($object['mail'], $object['name'], $object['firstname'], $object['address'], $object['username']);
            array_push($stArray, $student);
        }
        return $stArray;
    }

    public static function readByNames($firstname, $name)
    {
        $db = $GLOBALS['db'];
        $firstname = $db->quote($firstname);
        $name = $db->quote($name);
        $query = "SELECT * FROM student WHERE name = $name AND firstname = $firstname";
        $array = $db->query($query);
        if ($array == false) {
            exit("Error PDO:query($query)");
        }
        $stArray = [];
        foreach($array as $object) {
            $student = new Student($object['mail'], $object['name'], $object['firstname'], $object['address'], $object['username']);
            array_push($stArray, $student);
        }
        return $stArray;
    }

    // UPDATE
    public function update()
    {
        $db = $GLOBALS['db'];
        $query = "UPDATE student SET username = {$this->username}, mail = {$this->mail}, name = {$this->name}, firstname = {$this->firstname}, {address = $this->address}";
        $db->exec($query);
    }

    // DELETE
    public static function delete($username){
        $db = $GLOBALS['db'];
        $query = "DELETE FROM student WHERE username = $username";
        $db->exec($query);
    }
}
