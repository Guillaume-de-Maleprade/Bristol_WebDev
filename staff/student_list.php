<?php

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/Student.php');
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');


$stArray = Student::readAll();

$content = "";

foreach($stArray as $student){
    $row = "<tr>"
            ."<td>$student->firstname</td>"
            ."<td>$student->name</td>"
            ."<td>$student->username</td>"
            ."<td>$student->mail</td>"
            ."<td>$student->address</td>"
        ."</tr>";
    $content .= $row;
}

$content = "<table class=\"table table-striped\">"
            ."<thead>"
                ."<tr>"
                    ."<th scope=\"col\">First Name</th>"
                    ."<th scope=\"col\">Name</th>"
                    ."<th scope=\"col\">Username</th>"
                    ."<th scope=\"col\">Mail</th>"
                    ."<th scope=\"col\">Address</th>"
                ."</tr>"
            ."</thead>"
            ."<tbody>"
                .$content
            ."</tbody>"
        ."</table>";

$add_link = "<a class=\"btn btn-primary\" href='/Bristol_WebDev/admin/?page=student_add'>Add</a>";
$content .= $add_link;

$students = ['content' => $content, 'student_button' => '<span class="sr-only">(current)', 'title' => "Student List", 'student_active' => 'active'];

View::render('templates/base.html', $students);