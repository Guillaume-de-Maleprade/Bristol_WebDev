<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/User.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/Module.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/Component.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');

session_start();

if(isset($_GET['student']) && $_SESSION['role'] == 'Staff'){
    $username = htmlspecialchars($_GET['student']);
    //echo $username;

    //if(isset($_GET['module'])){

   // }else{
        $modules = Module::readByStudentUserName($username);
        $rows = "";
        if(!empty($modules)){
            foreach ($modules as $module) {
                $components = Component::readByModuleName($module['title'][0]);
                foreach ($components as $component) {
                    $componentRow = View::getTemplate("staff/mark_component_row.html", ['component' => $component->name, 'mark' => $component->mark]);
                    $rows .= $componentRow;
                }
            }
            $moduleForm = View::getTemplate('staff/mark_component_form.html', ['rows'=>$rows]);
            View::render('base.html', ['title'=>'Marking component', 'content'=>$moduleForm]);
        }else {
            header('Location: /Bristol_WebDev/staff/user_list.php?role=Student');
        }
    //}

}else{
    header('Location: /Bristol_WebDev/staff/user_list.php?role=Student');
}