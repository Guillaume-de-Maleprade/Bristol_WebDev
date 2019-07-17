<?php

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/logger.php');
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/Staff.php');

print_r($_POST);
myLog("M'enfin?");

if(isset($_POST['name']) && isset($_POST['firstname'])){
    myLog("adding a staff member");

    $name = htmlspecialchars($_POST['name']);
    $firstname = htmlspecialchars($_POST['firstname']);

    $username = str_replace(" ", "-", $name ).".". $firstname;
    $username = strtolower($username);
    $i = "";
    while(Staff::readByUserName($username . $i)!= NULL){
        if(strlen($i)<1) $i = 0;
        $i++;
    }
    myLog("username: $username");
    $username .= $i;
    $mail = $username."@uwe.ac.uk";
    myLog("mail: $mail");
    $staff = new Staff($username, $mail, $name, $firstname);
    $staff->insert();

}