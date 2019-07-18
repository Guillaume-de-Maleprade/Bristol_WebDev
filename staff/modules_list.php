<?php

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/Module.php');
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');


$stArray = Module::getModulesByStaff($_SESSION['username']);
$content = "";

foreach ($stArray as $module){
    $row = View::getTemplate('staff/module_row.html', ['title'=>$module->title, 'id'=>$module->id]);
    $content .= $row;
}

$content = View::getTemplate('staff/module_list.html', ['content'=> $content]);

$add_link = "<a class=\"btn btn-primary\" href='/Bristol_WebDev/staff.php?page=module_add'>Add</a>";
$content .= $add_link;

$modules = ['content' => $content, 'module_button' => '<span class="sr-only">(current)', 'title' => "Module List", 'staff_active' => 'active'];

View::render('base.html', $modules);