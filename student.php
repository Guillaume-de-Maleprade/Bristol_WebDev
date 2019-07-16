<?php

require_once('View.php');

$content = require_once('templates/student.html')

$array = ['title'=>'Student Page','content'=>$content];

View::render('templates/base.html', $array);