<?php

require 'db_connect.php';

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
        $result = $db->query($query);
        if ($result == false) {
            exit("erreur PDO:query($query)");
        }

        $object = $result->fetchObject();
        if($object == FALSE) return NULL;
        $student = new Student($object->mail, $object->name, $object->firstname, $object->address, $object->username);
        return $student;
    }

    public static function readByNames($firstname, $name)
    {
        $db = $GLOBALS['db'];
        $firstname = $db->quote($firstname);
        $name = $db->quote($name);
        $query = "SELECT * FROM student WHERE name = $name AND firstname = $firstname";
        $result = $db->query($query);
        if ($result == false) {
            exit("erreur PDO:query($query)");
        }

        $object = $result->fetchObject();
        if($object == FALSE) return NULL;
        $student = new Student($object->mail, $object->name, $object->firstname, $object->address, $object->username);
        return $student;
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
