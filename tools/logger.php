<?php

function myLog($text){
    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/logs/logs.txt', $text . PHP_EOL, FILE_APPEND | LOCK_EX);
}