<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/User.php');

//CREPIN LEA

$name = "Crepin";
$firstname = "Lea";
$address = "impasse des paquerettes";
$roleID = 1;
$username = str_replace(" ", "-", $name ).".". $firstname;
$username = strtolower($username);
$i = "";
while(User::readByUserName($username . $i)!= NULL){
    if(strlen($i)<1) $i = 0;
    $i++;
}
$username .= $i;
$mail = $username."@uwe.ac.uk";
$student = new User($mail, $name, $firstname, $address, $username, $roleID);
$student->insert();

//DEMALEPRADE GUILLAUME

$name = "DeMaleprade";
$firstname = "Guillaume";
$address = "impasse des paquerettes";
$roleID = 1;
$username = str_replace(" ", "-", $name ).".". $firstname;
$username = strtolower($username);
$i = "";
while(User::readByUserName($username . $i)!= NULL){
    if(strlen($i)<1) $i = 0;
    $i++;
}
$username .= $i;
$mail = $username."@uwe.ac.uk";
$student = new User($mail, $name, $firstname, $address, $username, $roleID);
$student->insert();

//Student

$name = "Student";
$firstname = "Student";
$address = "impasse des paquerettes";
$roleID = 1;
$username = str_replace(" ", "-", $name ).".". $firstname;
$username = strtolower($username);
$i = "";
while(User::readByUserName($username . $i)!= NULL){
    if(strlen($i)<1) $i = 0;
    $i++;
}
$username .= $i;
$mail = $username."@uwe.ac.uk";
$student = new User($mail, $name, $firstname, $address, $username, $roleID);
$student->insert();

//Staff

$name = "Staff";
$firstname = "Staff";
$address = "impasse des paquerettes";
$roleID = 2;
$username = str_replace(" ", "-", $name ).".". $firstname;
$username = strtolower($username);
$i = "";
while(User::readByUserName($username . $i)!= NULL){
    if(strlen($i)<1) $i = 0;
    $i++;
}
$username .= $i;
$mail = $username."@uwe.ac.uk";
$student = new User($mail, $name, $firstname, $address, $username, $roleID);
$student->insert();