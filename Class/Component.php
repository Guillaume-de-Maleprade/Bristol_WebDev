<?php

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/config/db_connect.php');

class Component
{
    public $id;
    public $module;
    public $name;
    public $percentage;
    public $type;

    public function __construct($module, $name, $percentage, $type, $id = NULL)
    {
        $this->module = $module;
        $this->name = $name;
        $this->percentage = $percentage;
        $this->type = $type;
        $this->id = $id;
    }

    // CREATE
    public function insert()
    {
        $db = $GLOBALS['db'];
        $query = "INSERT INTO component (module,name,percentage,type) VALUES (?,?,?,?)";
        $req = $db->prepare($query);
        $req->execute([$this->module, $this->name, $this->percentage, $this->type]);
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
