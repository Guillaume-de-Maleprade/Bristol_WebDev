<?php
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');
$current = '<span class="sr-only">(current)';
// Add students in database

// Add staff in database

if (!empty($_GET) && $_SESSION['role']== 'Component') {
    switch ($_GET['page']) {
        case 'staff_list':
            /*$content = file_get_contents("templates/staff_list.html");
            $staff = ['content' => $content, 'staff_button' => $current, 'title' => "Staff List", 'staff_active' => 'active'];
            View::render('templates/base.html', $staff);*/
            header('Location: staff/staff_list.php');
            break;

        case 'staff_add':
            $content = file_get_contents($_SERVER['DOCUMENT_ROOT']."/Bristol_WebDev/templates/staff/user_add.html");
            $staff = ['content' => $content, 'staff_button' => $current, 'title' => "Staff Add", 'staff_active' => 'active'];
            View::render('base.html', $staff);
            break;

        case 'student_list':
            /*$content = file_get_contents("templates/staff_list.html");
            $student = ['content' => $content, 'student_button' => $current, 'title' => "Student List", 'student_active' => 'active'];
            View::render('templates/base.html', $student);*/
            header('Location: staff/student_list.php');
            break;

        case 'student_add':
            $content = file_get_contents($_SERVER['DOCUMENT_ROOT']."/Bristol_WebDev/templates/staff/user_add.html");
            $student = ['content' => $content, 'student_button' => $current, 'title' => "Student Add", 'student_active' => 'active'];
            View::render('base.html', $student);
            break;

        case 'module_add':
            $content = file_get_contents($_SERVER['DOCUMENT_ROOT']."/Bristol_WebDev/templates/staff/module_add.html");
            $module = ['content' => $content, 'module_button' => $current, 'title' => "Module Add", 'staff_active' => 'active'];
            View::render('base.html', $module);
            break;

        case 'component_list':
            $id = $_GET['id'];
            header('Location: staff/component_list.php?id='.$id);
            break;

        case 'component_add':
            $id = $_GET['id'];
            $content = file_get_contents($_SERVER['DOCUMENT_ROOT']."/Bristol_WebDev/templates/staff/staff_add.html");
            $component = ['content'=>$content, 'component_button'=>$current, 'title'=>"Add Component", 'staff_active'=>'active'];
            View::render('base.html', $component);
            break;

        default:
            View::render('base.html', ['content' => "<h1> Admin page </h1>", 'title' => "Admin Page", 'home_active' => 'active']);
            break;
    }
}else{
    header('Location: /Bristol_WebDev');
}
