<?php

require_once('View.php');

if (!empty($_GET)) {
    switch ($_GET['page']) {
        case 'student_page':
       
$content = file_get_contents('templates/student.html');

$array = ['title'=>'Student Page','content'=>$content];

View::render('templates/base.html', $array);
        break;
  }}else{

$content = '<h1>'
            .'This is a homepage!'
            .'</h1>';

$array = ['title'=>'Home Page','content'=>$content];

View::render('templates/base.html', $array);
        }

