<?php

require ($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/config/db_connect.php');

class User
{
    public $username;
    public $mail;
    public $name;
    public $firstname;
    public $address;
    public $role;


    public function __construct($mail, $name, $firstname, $address, $username, $role)
    {
        $this->username = $username;
        $this->mail = $mail;
        $this->name = $name;
        $this->firstname = $firstname;
        $this->address = $address;
        $this->role = $role;
    }

    // CREATE
    public function insert()
    {
        try {
            $db = $GLOBALS['db'];
            $query = "INSERT INTO user (username, mail, name, firstname, address, role) VALUES (?,?,?,?,?,?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$this->username, $this->mail, $this->name, $this->firstname, $this->address, $this->role]);
        } catch (PDOException $e) {
            die($e);
        }
    }

    // READ
    public static function readByUserName($username)
    {
        $db = $GLOBALS['db'];
        $username = $db->quote($username);
        $query = "SELECT * FROM user WHERE username = $username";
        $array = $db->query($query);
        if ($array == false) {
            exit("Error PDO:query($query)");
        }
        $stArray = [];
        foreach ($array as $object) {
            $user = new User($object['mail'], $object['name'], $object['firstname'], $object['address'], $object['username'], $object['role']);
            array_push($stArray, $user);
        }
        return $stArray;
    }

    public static function readAll($role)
    {
        $db = $GLOBALS['db'];

        $query = "SELECT * FROM user WHERE role = $role";
        $array = $db->query($query);
        if ($array == false) {
            exit("Error PDO:query($query)");
        }
        $stArray = [];
        foreach ($array as $object) {
            $user = new User($object['mail'], $object['name'], $object['firstname'], $object['address'], $object['username'], $role);
            array_push($stArray, $user);
        }
        return $stArray;
    }


    public static function readAllStudent()
    {
        return self::readAll("Student");
    }

    public static function readAllStaff()
    {
        return self::readAll("Staff");
    }

    public static function readByNames($firstname, $name)
    {
        $db = $GLOBALS['db'];
        $firstname = $db->quote($firstname);
        $name = $db->quote($name);
        $query = "SELECT * FROM user WHERE name = $name AND firstname = $firstname";
        $array = $db->query($query);
        if ($array == false) {
            exit("Error PDO:query($query)");
        }
        $stArray = [];
        foreach ($array as $object) {
            $user = new User($object['mail'], $object['name'], $object['firstname'], $object['address'], $object['username']);
            array_push($stArray, $user);
        }
        return $stArray;
    }

    // UPDATE
    public function update()
    {
        $db = $GLOBALS['db'];
        $query = "UPDATE user SET username = {$this->username}, mail = {$this->mail}, name = {$this->name}, firstname = {$this->firstname}, address ={$this->address}, role ={$this->role}";
        $db->exec($query);
    }

    // DELETE
    public static function delete($username)
    {
        $db = $GLOBALS['db'];
        $query = "DELETE FROM user WHERE username = $username";
        $db->exec($query);
    }
}