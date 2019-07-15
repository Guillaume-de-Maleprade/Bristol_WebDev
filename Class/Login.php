<?php

require 'db_connect.php';

class Login
{
    public $username;
    public $password;
    public $role;


    public function __construct($username, $password, $role)
    {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    // CREATE
    public function insert()
    {
        try {
            $db = $GLOBALS['db'];
            $query = "INSERT INTO login (username, password, role) VALUES (?,?,?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$this->username, $this->password, $this->role]);
        } catch (PDOException $e) {
            die($e);
        }
    }

    // READ
    public static function readByUserName($username)
    {
        $db = $GLOBALS['db'];
        $username = $db->quote($username);
        $query = "SELECT * FROM login WHERE username = $username";

        $result = $db->query($query);
        if ($result == false) return false;

        $object = $result->fetchObject();
        if($object == FALSE) return false;

        $login = new login($object->username, $object->password, $object->role);
        return $login;
    }

    // UPDATE
    public function update()
    {
        $db = $GLOBALS['db'];
        $query = "UPDATE login SET username = {$this->username}, password = {$this->password}, role = {$this->role}";
        $db->exec($query);
    }

    // DELETE
    public static function delete($username){
        $db = $GLOBALS['db'];
        $query = "DELETE FROM login WHERE username = $username";
        $db->exec($query);
    }
}
