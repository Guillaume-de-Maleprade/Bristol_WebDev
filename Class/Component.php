<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/config/db_connect.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/User.php');

class Component{
    public $module;
    public $name;
    public $percentage;
    public $type;

    public function __construct($name, $percentage, $type, $module)
    {
        $this->name = $name;
        $this->percentage = $percentage;
        $this->type = $type;
        $this->module = $module;
    }

    public function getTypeName(){
        $db = $GLOBALS['db'];
        $query = "SELECT * FROM type WHERE id=$this->type";
        $res = $db->query($query);
        if ($res == false) exit("Error PDO:query($query)");
        $obj = $res->fetchObject();
        return $obj->name;
    }

    public static function getComponentsForModule($module)
    {
        $db = $GLOBALS['db'];
        $query = "SELECT * FROM module WHERE id=$module";
        $res = $db->query($query);
        if (res == false) exit("Error PDO::query($query)");
        $arr = [];
        foreach ($arr as $obj){
            $cmp = new Component($obj->name, $obj->percentage, $obj->type, $obj->module);
            array_push($arr, $cmp);
        }
        return $arr;
    }

    public function insert(){
        try {
            $db = $GLOBALS['db'];
            $query = "INSERT INTO component(module, name, percentage, type) VALUES (?,?,?,?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$this->module, $this->name, $this->percentage, $this->type]);
        } catch (PDOException $e) {
            die($e);
        }
    }
    // READ
    public static function readByModuleName($moduleName)
    {
        $moduleID = Module::getIDFromTitle($moduleName);
        self::readByModuleID($moduleID);
    }

    public static function readByModuleID($moduleID)
    {
        $db = $GLOBALS['db'];
        $query = "SELECT * FROM component WHERE module = $moduleID";
        $result = $db->query($query);
        if ($result == false) {
            exit("Error PDO:query($query)");
        }

        $stArray = [];
        foreach($result as $object) {
            $component = new Component($object['module'], $object['name'], $object['percentage'], $object['type'], $object['id']);
            array_push($stArray, $component);
        }
        return $stArray;
    }

    public static function readAll(){
        $db = $GLOBALS['db'];

        $query = "SELECT * FROM component WHERE 1";
        $array = $db->query($query);
        if ($array == false) {
            exit("Error PDO:query($query)");
        }
        $stArray = [];
        foreach($array as $object) {
            $component = new Component($object['module'], $object['name'], $object['percentage'], $object['type'], $object['id']);
            array_push($stArray, $component);
        }
        return $stArray;
    }

    // UPDATE
    public function update(){

    }
    // DELETE
    public static function delete($username){
        $db = $GLOBALS['db'];
        $query  ="DELETE FROM staff WHERE username = $username";
        $result = $db->query($query);
        if($result == false){
            $errorMsg = $db->errorInfo()[2];
            exit("PDO:query('$query') : $errorMsg");
        }else{
            echo("Staff deleted");
        }
    }
}
