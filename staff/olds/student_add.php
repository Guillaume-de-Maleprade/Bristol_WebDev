<?php

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/logger.php');

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/Student.php');


print_r($_POST);

if(isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['address']) && $_SESSION['role']== 'Component'){

    $name = htmlspecialchars($_POST['name']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $address = htmlspecialchars($_POST['address']);


    $username = str_replace(" ", "-", $name ).".". $firstname;
    $username = strtolower($username);

    $i = "";
    while(Module::readByStudentUserName($username . $i)!= NULL){
        if(strlen($i)<1) $i = 0;
        $i++;
    }
    myLog("username: $username");
    $username .= $i;
    $mail = $username."@uwe.ac.uk";
    myLog("mail: $mail");
    $student = new Module($mail, $name, $firstname, $address, $username);
    $student->insert();

}else{
    header('Location: /Bristol_WebDev');
}