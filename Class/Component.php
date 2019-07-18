<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/logger.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/config/db_connect.php');

class Component{ 

    public $component;

    public function __construct($component){
        $this->component = $component;
 
        

    }
    // READ mark
    public static function readMarkByUserName($username)
    {
        $db = $GLOBALS['db'];
        $username = $db->quote($username);
        $query = "SELECT component.name as component, room_booking.date as date, room.number as room FROM component, room_booking, room, module, enrollment, people
        WHERE module.id=enrollment.module and component.id=enrollment.module and student=people.id and room_booking.component=component.id and
        room.id=room_booking.room and people.username=$username";
        $array = $db->query($query);
        if ($array == false) {
            exit("Error PDO:query($query)");
        }
        $stArray = [];

        foreach($array as $object) {
            $markOb = array("component"=>$object['component'], "date"=>$object['date'],"room"=>$object['room']);
            array_push($stArray, $markOb);     
        
        

        return $stArray;}
    }
    
}