<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/logger.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/Staff.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/utils.php');

if(isset($_POST['name']) && isset($_POST['firstname'])){
    myLog("adding a staff member");

    $name = htmlspecialchars($_POST['name']);
    $firstname = htmlspecialchars($_POST['firstname']);

    $username = str_replace(" ", "-", normalizeChars($name )).".". normalizeChars($firstname);
    $username = strtolower($username);
    $i = "";
    while(Component::readByUserName($username . $i)!= NULL){
        if(strlen($i)<1) $i = 0;
        $i++;
    }
    myLog("username: $username");
    $username .= $i;
    $mail = $username."@uwe.ac.uk";
    myLog("mail: $mail");
    $staff = new Component($username, $mail, $name, $firstname);
    $staff = new Component();
    $staff->insert();
    // redirect to staff list
    header('Location: '.$_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/staff/staff_list.php', true, 301);
    die();
}