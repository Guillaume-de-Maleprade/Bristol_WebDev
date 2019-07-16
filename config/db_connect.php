<?php
$db = NULL;
<<<<<<< HEAD:config/db_connect.php
=======

>>>>>>> Guillaume_save:admin/db_connect.php
$json = file_get_contents($_SERVER['DOCUMENT_ROOT']."/Bristol_WebDev/config/db.json");
$config = json_decode($json, true);
try {
    $dbname = $config['dbname'];
    $host = $config['host'];
    $dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";
    $db = new PDO($dsn, $config["username"], $config["password"]);
<<<<<<< HEAD:config/db_connect.php
    echo "Connection success!";
=======

    //echo "Connection success!";
>>>>>>> Guillaume_save:admin/db_connect.php
} catch (PDOException $e) {
    die("Connection failed " . $e->getMessage());
}