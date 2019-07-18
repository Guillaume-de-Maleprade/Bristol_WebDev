<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/config/db_connect.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/User.php');

class Module {
    public $title;
    public $staffname;

    public function __construct($title, $staffname="")
    {
        $this->title = $title;
        $this->staffname =  $staffname;
    }

    public function insert()
    {
        /* steps
         * 1. create module
         * 2. add entry in the teaching table
         */
        $db = $GLOBALS['db'];
        $query = "INSERT into module VALUES ($this->title)";
        // add entry only if there is someone teaching the module
        if ($this->staffname !== '' && $db->exec($query) === true) {
            $moduleRes = $db->$query("SELECT * INTO module WHERE titre=$this->title");
            if ($moduleRes == false) exit("erreur PDO query : $query");
            $module = $moduleRes->fetchObject();
            $staff = Staff::readByUserName($this->staffname);
            $db->exec("INSERT INTO teaching VALUES ($module->id, $staff->id)");
        }
    }

    public static function getModulesByStaff($username){
        $db = $GLOBALS['db'];
        $user = $db->quote($username);
        // search id
        $query = "SELECT *
                  FROM user u 
                  JOIN role r on u.role=r.id
                  WHERE r.name='Staff' username=$user";
        $res = $db->query($query);
        if ($res == false){
            exit("Error PDO:query($query)");
        }
        $obj = $res->fetchObject();
        if ($obj == false) return NULL;
        $id = $obj->id;
        // search in the teaching table
        $query = "SELECT * FROM module WHERE id in (select * from teaching where staff=$id)";
        $result = $db->query($query);
        if ($result == false) return NULL;
        $arr = [];
        foreach ($result as $obj){
            $module = new Module(obj['title']);
            array_push($arr, $module);
        }
        return $arr;
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