<?php

function myLog($text){
    file_put_contents('logs.txt', $text . PHP_EOL, FILE_APPEND | LOCK_EX);
}