<?php

$json = file_get_contents("db.json");
$config = json_decode($json, true);


try {
    $bdd = new PDO($config["dsn"], $config["username"], $config["password"]);
    echo "Connection success!";
} catch (PDOException $e) {
    die("Connection failed " . $e->getMessage());
}
