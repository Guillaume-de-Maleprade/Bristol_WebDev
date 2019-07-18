<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/logger.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/Staff.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/utils.php');

if (isset($_POST['title'])){
    $title = htmlspecialchars($_POST['title']);
    $staffname = $_SESSION['username'];
    myLog("module $title created by staff $staffname");

    $module = new Module($title, $staffname);
    $module->insert();
    header('Location: '.$_SERVER['DOCUMENT_ROOT'].'Bristol_WebDev/staff/module_list.php');
    die;
}