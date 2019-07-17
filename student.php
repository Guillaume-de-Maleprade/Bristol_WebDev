<?php
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');
$current = '<span class="sr-only">(current)';


if (!empty($_GET)) {
    switch ($_GET['page']) {
       
        

        default:
            View::render('base.html', ['content' => "<h1> Admin page </h1>", 'title' => "Admin Page", 'home_active' => 'active']);
            break;
    }
} else {
    View::render('templates/base.html', ['content' => "<h1> Admin page </h1>", 'title' => "Admin Page", 'home_active' => 'active']);
}
