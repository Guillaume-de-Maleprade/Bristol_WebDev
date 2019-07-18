<?php

require ($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/config/db_connect.php');

class User
{
    public $id;
    public $username;
    public $mail;
    public $name;
    public $firstname;
    public $address;
    public $role;
    public $password;


    public function __construct($mail, $name, $firstname, $address, $username, $role, $password = null, $id = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->mail = $mail;
        $this->name = $name;
        $this->firstname = $firstname;
        $this->address = $address;
        $this->role = $role;
        $this->password = $password;
    }

    // CREATE
    public function insert()
    {
        try {
            $password = self::newPassword();
            $db = $GLOBALS['db'];
            $query = "INSERT INTO people (username, mail, name, firstname, address, role, password) VALUES (?,?,?,?,?,?,?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$this->username, $this->mail, $this->name, $this->firstname, $this->address, $this->role, $this->password]);
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/logs/password.txt', $this->username.' - '.$password . PHP_EOL, FILE_APPEND | LOCK_EX);
            return true;
        } catch (PDOException $e) {
            die($e);
        }
    }

    //CREATE PASSWORD (length 8)
    public function newPassword()
    {
        $password=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8);
        $this->password = password_hash($password,1);
        return $password;
    }

    // GETTER
    public function getRole(){
        return self::getRoleFromIndex($this->role);
    }


    // READ
    public static function readByUserName($username)
    {
        $db = $GLOBALS['db'];
        $username = $db->quote($username);
        $query = "SELECT * FROM people WHERE username = $username";
        $res = $db->query($query);
        if ($res == false) {
            exit("Error PDO:query($query)");
        }
        $object = $res->fetchObject();
        if($object == NULL) return NULL;
        print_r($object);

        $user = new User($object->mail, $object->name, $object->firstname, $object->address, $object->username, $object->role,  $object->password,  $object->id);

        return $user;
    }

    public static function readAll($role)
    {
        $db = $GLOBALS['db'];
        $role = $db->quote($role);
        $query = "SELECT * FROM people WHERE role = $role";
        $array = $db->query($query);
        if ($array == false) {
            exit("Error PDO:query($query)");
        }
        $stArray = [];
        foreach ($array as $object) {
            $user = new User($object['mail'], $object['name'], $object['firstname'], $object['address'], $object['username'], $object['role'],  $object['password'],  $object['id']);
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

    public static function getRoleFromIndex($id)
    {
        $db = $GLOBALS['db'];
        $query = "SELECT name FROM role WHERE id = $id ";
        $res = $db->query($query);
        if ($res == false) {
            exit("Error PDO:query($query)");
        }
        $object = $res->fetchObject();
        return $object->name;
    }

    public static function getIndexFromRole($role)
    {
            $db = $GLOBALS['db'];
            $query = "SELECT id FROM role WHERE name = \"$role\"";
            $res = $db->query($query);
            if ($res == false) {
                exit("Error PDO:query($query)");
            }
            $object = $res->fetchObject();
            if($object == NULL) return NULL;
            return $object->id;
    }

    public static function readByNames($firstname, $name)
    {
        $db = $GLOBALS['db'];
        $firstname = $db->quote($firstname);
        $name = $db->quote($name);
        $query = "SELECT * FROM people WHERE name = $name AND firstname = $firstname";
        $array = $db->query($query);
        if ($array == false) {
            exit("Error PDO:query($query)");
        }
        $stArray = [];
        foreach ($array as $object) {
            $user = new User($object['mail'], $object['name'], $object['firstname'], $object['address'], $object['username'], $object['role'],  $object['password'],  $object['id']);
            array_push($stArray, $user);
        }
        return $stArray;
    }

    // UPDATE
    public function update()
    {
        $db = $GLOBALS['db'];
        $query = "UPDATE people SET username = {$this->username}, mail = {$this->mail}, name = {$this->name}, firstname = {$this->firstname}, address ={$this->address}, role ={$this->role}";
        $db->exec($query);
    }

    // DELETE
    public static function delete($username)
    {
        $db = $GLOBALS['db'];
        $query = "DELETE FROM people WHERE username = $username";
        $db->exec($query);
    }
}