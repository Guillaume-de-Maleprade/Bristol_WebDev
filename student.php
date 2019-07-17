<?php
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');
$current = '<span class="sr-only">(current)';
session_start();

if (!empty($_GET) && $_SESSION['role']=='Student') {
    switch ($_GET['page']) {
       
        

        default:
            View::render('base.html', ['content' => "<h1> Admin page </h1>", 'title' => "Admin Page", 'home_active' => 'active']);
            break;
    }
} else {
    View::render('templates/base.html', ['content' => "<h1> Admin page </h1>", 'title' => "Admin Page", 'home_active' => 'active']);
}
