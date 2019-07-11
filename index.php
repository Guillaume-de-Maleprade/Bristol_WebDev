<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/Bristol_WebDev/' :
        require __DIR__ . '/views/index.php';
        break;
    case '/Bristol_WebDev' :
        require __DIR__ . '/views/index.php';
        break;
    case '/Bristol_WebDev/about' :
        require __DIR__ . '/views/about.php';
        break;
    default:
        require __DIR__ . '/views/404.php';
        break;
}