<?php

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/Component.php');
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');


$stArray = Component::getComponentsForModule($_GET['id']);
$content = "";

foreach ($stArray as $component){
    $row = View::getTemplate('staff/component_row.html', ['name'=>$component->name, 'percentage'=>$component->percentage]);
    $content .= $row;
}

$content = View::getTemplate('staff/component_list.html', ['content'=> $content]);

$add_link = "<a class=\"btn btn-primary\" href='/Bristol_WebDev/staff.php?page=component_add'>Add</a>";
$content .= $add_link;

$modules = ['content' => $content, 'component_button' => '<span class="sr-only">(current)', 'title' => "Component List", 'staff_active' => 'active'];

View::render('base.html', $modules);