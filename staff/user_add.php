<?php

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/logger.php');

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/User.php');

session_start();

if(isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['address']) && isset($_POST['role']) && $_SESSION['role']== 'Staff'){

    $name = htmlspecialchars($_POST['name']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $address = htmlspecialchars($_POST['address']);
    $strRole = htmlspecialchars($_POST['role']);

    $roleID = User::getIndexFromRole($strRole);


    $username = str_replace(" ", "-", $name ).".". $firstname;
    $username = strtolower($username);

    $i = "";
    while(User::readByUserName($username . $i)!= NULL){
        if(strlen($i)<1) $i = 0;
        $i++;
    }
    myLog("username: $username");
    $username .= $i;
    $mail = $username."@uwe.ac.uk";
    myLog("mail: $mail");
    $student = new User($mail, $name, $firstname, $address, $username, $roleID);
    $success = $student->insert();
    header("Location: /Bristol_WebDev/user.php?page=user_add&success=$success");
}else{
    header('Location: /Bristol_WebDev');
}