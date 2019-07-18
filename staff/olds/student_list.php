<?php

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/Student.php');
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');


$stArray = Module::readAll();

$content = "";

foreach($stArray as $student){
    $row = View::getTemplate('staff/student_row.html', [
        'firstname'=>$student->firstname,
        'name'=>$student->name,
        'username'=>$student->username,
        'mail'=>$student->mail,
        'address'=>$student->address
    ]);
    $content .= $row;
}

$content = View::getTemplate('staff/student_list.html', [ 'content'=> $content ]);

$add_link = "<a class=\"btn btn-primary\" href='/Bristol_WebDev/staff.php?page=student_add'>Add</a>";
$content .= $add_link;

$students = ['content' => $content, 'student_button' => '<span class="sr-only">(current)', 'title' => "Student List", 'student_active' => 'active'];

View::render('base.html', $students);