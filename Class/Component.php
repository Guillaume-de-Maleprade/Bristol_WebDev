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
}