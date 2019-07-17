<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/logger.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/config/db_connect.php');

class Mark{ 

    public $module;
    public $assetsmark=array();
    
    public function __construct($module, $component,$mark ){
        $this->module = $module;
        $this->assetsmark[0] =array("component" => $component,"mark"=>$mark );

    }
    // READ mark
    public static function readMarkByUserName($username)
    {
        $db = $GLOBALS['db'];
        $username = $db->quote($username);
        $query = "SELECT module, component, mark FROM component, marking  WHERE id=component and student = $username";
        $array = $db->query($query);
        if ($array == false) {
            exit("Error PDO:query($query)");
        }
        $stArray = [];

        foreach($array as $object) {
            $markOb='';
            foreach($stArray as $obj){

                if($obj->module==$object['module']){
                    $markOb= array($object['component'],$object['mark']);
                    array_push( $obj->assetsmark, $markOb );
                }
            }
                
              if($markOb=='') { 
            {
            $markOb = new Mark($object['module'], $object['component'],$object['mark']);
            array_push($stArray, $markOb);
            }
            }
        }
        

        return $stArray;
    }
    
}