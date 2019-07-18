<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/User.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/logger.php');



$stArray = User::readMarkByUserName('ayme2612');

$content = "";
if(!empty($stArray)){
    
   
foreach($stArray as $mark){
    $markf="";
    foreach($mark["assetsmark"] as $marks){
    $markf.=implode(" : ",$marks) . "%<br>";
    
    }
    
    $row = View::getTemplate('student/mark_row.html', [
        'module'=>$mark["module"],
        'assetsmark'=>$markf,
    ]);
    $content .= $row;
}
}
$content = View::getTemplate('student/mark_list.html', [ 'content'=> $content ]);


$mark = ['content' => $content, 'student_button' => '<span class="sr-only">(current)', 'title' => "Student List", 'student_active' => 'active'];

View::render('student/base.html', $mark);