<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/User.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/logger.php');



$stArray = User::readComponentByUserName('ayme2612');

$content = "";
if(!empty($stArray)){
foreach($stArray as $component){
    
    $row = View::getTemplate('student/component_row.html', [
        'component'=>$component["component"],
        'date'=>$component["date"],
        'room'=>$component["room"],
    ]);
    // myLog($row);
    $content .= $row;
}
}
$content = View::getTemplate('student/component_list.html', [ 'content'=> $content ]);


$mark = ['content' => $content, 'student_button' => '<span class="sr-only">(current)', 'title' => "Student List", 'student_active' => 'active'];

View::render('student/base.html', $mark);