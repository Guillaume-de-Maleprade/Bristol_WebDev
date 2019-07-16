<?php

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/Student.php');
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');


$stArray = Student::readAll();

$content = "";

foreach($stArray as $student){
    $row = View::getTemplate('student_row.html', [ $student->firstname, $student->name, $student->username, $student->mail, $student->address]);
    $content .= $row;
}

$content = View::getTemplate('student_list.html', [ 'content'=> $content ]);

$add_link = "<a class=\"btn btn-primary\" href='/Bristol_WebDev/staff.php?page=student_add'>Add</a>";
$content .= $add_link;

$students = ['content' => $content, 'student_button' => '<span class="sr-only">(current)', 'title' => "Student List", 'student_active' => 'active'];

View::render('base.html', $students);