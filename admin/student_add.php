<?php

require_once('../tools/logger.php');

require_once('../Class/Student.php');

print_r($_POST);

if(isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['address'])){

    $name = htmlspecialchars($_POST['name']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $address = htmlspecialchars($_POST['address']);

    $username = str_replace(" ", "-", $name ).".". $firstname;
    $i = "";
    while(Student::readByUserName($username . $i)!= NULL){
        if(strlen($i)<1) $i = 0;
        $i++;
    }
    myLog("username: $username");
    $username .= $i;
    $mail = $username."@uwe.ac.uk";
    myLog("mail: $mail");
    $student = new Student($mail, $name, $firstname, $address, $username);
    $student->insert();

}