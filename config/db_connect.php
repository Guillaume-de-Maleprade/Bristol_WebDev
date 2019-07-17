<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/logger.php');

$db = NULL;
$json = file_get_contents($_SERVER['DOCUMENT_ROOT']."/Bristol_WebDev/config/db.json");
$config = json_decode($json, true);
try {
    $dbname = $config['dbname'];
    $host = $config['host'];
    $dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";
    $db = new PDO($dsn, $config["username"], $config["password"]);
    myLog("connection to database successful");
    //echo "Connection success!";
} catch (PDOException $e) {
    myLog("connection to database failed");
    die("Connection failed " . $e->getMessage());
}