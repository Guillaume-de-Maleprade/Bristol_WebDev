<?php
require('../admin/db_connect.php');

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
        //$db = new DB();
        try {
            $query = "INSERT INTO student (username, mail, name, firstname, address) VALUES ({$this->username}, {$this->mail}, {$this->name}, {$this->firstname}, {$this->address})";
            $req = $db->query($query);
        } catch (PDOException $e) {
            die($e);
        }
    }

    // READ
    public static function readByUserName($username)
    {
        //$db = new DB();
        $username = $db->quote($username);
        $query = "SELECT * FROM student WHERE username = $username";
        $result = $db->query($query);
        if ($result == false) {
            exit("erreur PDO:query($query)");
        }

        $object = $result->fetchObject();
        $student = new Student($object->mail, $object->name, $object->firstname, $object->address, $object->username);
        return $student;
    }

    public static function readByNames($firstname, $name)
    {
        //$db = new DB();
        $firstname = $db->db->quote($firstname);
        $name = $db->quote($name);
        $query = "SELECT * FROM student WHERE name = $name AND firstname = $firstname";
        $result = $db->query($query);
        if ($result == false) {
            exit("erreur PDO:query($query)");
        }

        $object = $result->fetchObject();
        $student = new Student($object->mail, $object->name, $object->firstname, $object->address, $object->username);
        return $student;
    }

    // UPDATE
    public function update()
    {
        //$db = new DB();
        $query = "UPDATE student SET username = {$this->username}, mail = {$this->mail}, name = {$this->name}, firstname = {$this->firstname}, {address = $this->address}";
        $db->exec($query);
    }

    // DELETE
}
