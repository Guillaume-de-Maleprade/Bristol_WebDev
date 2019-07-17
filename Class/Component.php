<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/logger.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/config/db_connect.php');

class Component{ 

    public $component;
    public $date;
    public $room;
    
    public function __construct($component, $date,$room ){
        $this->component = $component;
        $this->date = $date;
        $this->room = $room;
        

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
            $markOb = new Component($object['component'], $object['date'],$object['room']);
            array_push($stArray, $markOb);     
        
        

        return $stArray;}
    }
    
}