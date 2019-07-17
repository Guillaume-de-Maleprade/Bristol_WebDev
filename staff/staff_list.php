<?php

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/Staff.php');
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');


$stArray = Staff::readAll();

$content = "";

foreach($stArray as $staff){
    myLog("staff list\nusername=$staff->username\nmail=$staff->mail\nname=$staff->name\nfirstname=$staff->firstname");
    $row = View::getTemplate('staff/staff_row.html', [
        'firstname'=>$staff->firstname,
        'name'=>$staff->name,
        'username'=>$staff->username,
        'mail'=>$staff->mail
    ]);
    $content .= $row;
}

$content = View::getTemplate('staff/staff_list.html', [ 'content'=> $content ]);

$add_link = "<a class=\"btn btn-primary\" href='/Bristol_WebDev/staff.php?page=staff_add'>Add</a>";
$content .= $add_link;

$staffs = ['content' => $content, 'staff_button' => '<span class="sr-only">(current)', 'title' => "Staff List", 'staff_active' => 'active'];

View::render('base.html', $staffs);