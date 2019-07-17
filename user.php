<?php
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');
$current = '<span class="sr-only">(current)';
// Add students in database

// Add user in database

if (!empty($_GET)){//} && $_SESSION['role']=='Staff') {
    switch ($_GET['page']) {
        case 'user_list':
            /*$content = file_get_contents("templates/user_list.html");
            $user = ['content' => $content, 'user_button' => $current, 'title' => "Staff List", 'user_active' => 'active'];
            View::render('templates/base.html', $user);*/
            header('Location: staff/user_list.php');
            break;

        case 'user_add':
            $content = file_get_contents($_SERVER['DOCUMENT_ROOT']."/Bristol_WebDev/templates/staff/user_add.html");
            $user = ['content' => $content, 'user_button' => $current, 'title' => "User Add", 'add_active' => 'active'];
            View::render('base.html', $user);
            break;
            
        default:
            View::render('base.html', ['content' => "<h1> Admin page </h1>", 'title' => "Admin Page", 'home_active' => 'active']);
            break;
    }
}else{
    header('Location: /Bristol_WebDev');
}
