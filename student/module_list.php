<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/User.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/logger.php');



$stArray = User::readMarkByUserName('ayme2612');

$content = "";
if(!empty($stArray)){
    $avg=0;
    
foreach($stArray as $mark){

    foreach($mark["assetsmark"] as $marks){
        $avg+=$marks["mark"]*$marks["percent"]/100;
        }

    
    $row = View::getTemplate('student/module_row.html', [
        'module'=>$mark["module"],
        'avg'=>$avg,
    ]);
    // myLog($row);
    $content .= $row;
}
}
$content = View::getTemplate('student/module_list.html', [ 'content'=> $content ]);


$mark = ['content' => $content, 'student_button' => '<span class="sr-only">(current)', 'title' => "Student List", 'student_active' => 'active'];

View::render('student/base.html', $mark);