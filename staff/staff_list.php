<?php

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/Staff.php');
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');


$stArray = Staff::readAll();

$content = "";

foreach($stArray as $staff){
    $row = "<tr>"
            ."<td>$staff->firstname</td>"
            ."<td>$staff->name</td>"
            ."<td>$staff->username</td>"
            ."<td>$staff->mail</td>"
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
                ."</tr>"
            ."</thead>"
            ."<tbody>"
                .$content
            ."</tbody>"
        ."</table>";

$add_link = "<a class=\"btn btn-primary\" href='/Bristol_WebDev/admin/?page=staff_add'>Add</a>";
$content .= $add_link;

$staffs = ['content' => $content, 'student_button' => '<span class="sr-only">(current)', 'title' => "Staff List", 'staff_active' => 'active'];

View::render('templates/base.html', $staffs);