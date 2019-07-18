<?php
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');
$current = '<span class="sr-only">(current)';


if (!empty($_GET)) {
    switch ($_GET['page']) {
       
        case 'mark_list':
            header('Location: student/mark_list.php');
            break;

            case 'component_list':
            header('Location: student/component_list.php');
            break;

            case 'module_list':
            header('Location: student/module_list.php');
            break;

        default:
            View::render('student/base.html', ['content' => "<h1> Admin page </h1>", 'title' => "Admin Page", 'home_active' => 'active']);
            break;
    }
} else {
    View::render('student/base.html', ['content' => "<h1> Admin page </h1>", 'title' => "Admin Page", 'home_active' => 'active']);
}
