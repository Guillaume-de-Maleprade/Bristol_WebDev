<?php

function myLog($text){
    file_put_contents('logs.txt', $text);
}