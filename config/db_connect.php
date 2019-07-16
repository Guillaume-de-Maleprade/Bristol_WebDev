<?php
$db = NULL;
$json = file_get_contents($_SERVER['DOCUMENT_ROOT']."/Bristol_WebDev/config/db.json");
$config = json_decode($json, true);
try {
    $dbname = $config['dbname'];
    $host = $config['host'];
    $dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";
    $db = new PDO($dsn, $config["username"], $config["password"]);
    echo "Connection success!";
} catch (PDOException $e) {
    die("Connection failed " . $e->getMessage());
}