<?php

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');

$content = '<h1>'
            .'This is a homepage!'
            .'</h1>';

$array = ['title'=>'Home Page','content'=>$content];

View::render('base.html', $array);