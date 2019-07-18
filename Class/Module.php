<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/config/db_connect.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/User.php');


class Module
{
    public $id;
    public $title;


    public function __construct($title, $id = NULL)
    {
        $this->id = $id;
        $this->title = $title;
    }

    // CREATE
    public function insert()
    {
        try {
            $db = $GLOBALS['db'];
            $query = "INSERT INTO module (title) VALUES (?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$this->title]);
        } catch (PDOException $e) {
            die($e);
        }
    }

    // READ
    public static function readByStudentUserName($username)
    {
        $db = $GLOBALS['db'];
        $user = User::readByUserName($username);
        if($user == NULL) return NULL;
        $userID = $user->id;
        $query = "SELECT * FROM enrollment WHERE student = $userID";
        $array = $db->query($query);
        if ($array == false) {
            exit("Error PDO:query($query)");
        }
        print_r($array);
        $stArray = [];
        foreach($array as $object) {
            $module = array('title'=>$object);
            echo $module['title'][0];
            array_push($stArray, $module);
        }
        return $stArray;
    }

    public static function getIDFromTitle($title){
        $db = $GLOBALS['db'];
        $query = "SELECT id FROM module WHERE title = $title";
        $res = $db->query($query);
        if ($res == false) {
            exit("Error PDO:query($query)");
        }
        $object = $res->fetchObject();
        if($object == NULL) return NULL;
        //print_r($object);

        //$user = new Module($object->id);

        return $object->id;
    }

    public static function readAll(){

    }

    // UPDATE
    public function update()
    {

    }

    // DELETE
    public static function delete($id){
        $db = $GLOBALS['db'];
        $query = "DELETE FROM module WHERE id = $id";
        $db->exec($query);
    }
}
