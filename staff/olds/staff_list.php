<?php

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/Staff.php');
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');

if($_SESSION['role']=='Staff') {

    $stArray = Staff::readAll();

    $content = "";

    foreach ($stArray as $staff) {
        $row = View::getTemplate('staff/staff_row.html', [
            'firstname' => $staff->firstname,
            'name' => $staff->name,
            'username' => $staff->username,
            'mail' => $staff->mail
        ]);
        $content .= $row;
    }

    $content = View::getTemplate('staff/staff_list.html', ['content' => $content]);

    $add_link = "<a class=\"btn btn-primary\" href='/Bristol_WebDev/staff.php?page=staff_add'>Add</a>";
    $content .= $add_link;

    $staffs = ['content' => $content, 'staff_button' => '<span class="sr-only">(current)', 'title' => "Staff List", 'staff_active' => 'active'];

    View::render('base.html', $staffs);
}else{
    header('Location: /Bristol_WebDev');
}