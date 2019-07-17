<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/Mark.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/logger.php');



$stArray = Mark::readMarkByUserName('ayme2612');

$content = "";

foreach($stArray as $mark){
    $marks='';
    foreach($mark->assetsmark as $mark1){
        $marks.=implode(" : ",$mark1) . "<br>";
    }
    $row = View::getTemplate('student/mark_row.html', [
        'module'=>$mark->module,
        'assetsmark'=>$marks,
    ]);
    // myLog($row);
    $content .= $row;
}

$content = View::getTemplate('student/mark_list.html', [ 'content'=> $content ]);


$mark = ['content' => $content, 'student_button' => '<span class="sr-only">(current)', 'title' => "Student List", 'student_active' => 'active'];

View::render('base.html', $mark);