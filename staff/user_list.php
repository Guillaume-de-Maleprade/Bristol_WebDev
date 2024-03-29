<?php

require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/User.php');
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');

$stArray = [];
$role = "";
if(isset($_GET['role'])){
    $role = User::getIndexFromRole(htmlspecialchars($_GET['role']));
    $stArray = User::readAll($role);
}else{
    $studArray = User::readAll(1);
    $staffArray = User::readAll(2);
    $stArray = array_merge($staffArray,$studArray);
}



$content = "";

foreach($stArray as $user){
    $role = User::getRoleFromIndex($user->role);
    $username = $user->username;
    if($role=="Student"){
        $username = "<a href='/Bristol_WebDev/staff/student_manage.php?student=$username'>$username</a>";
    }
    $row = View::getTemplate('staff/user_row.html', [
        'firstname'=>$user->firstname,
        'name'=>$user->name,
        'username'=>$username,
        'mail'=>$user->mail,
        'address'=>$user->address,
        'role'=>$role
    ]);
    $content .= $row;
}

$content = View::getTemplate('staff/user_list.html', [ 'content'=> $content ]);

$add_link = "<a class=\"btn btn-primary\" href='/Bristol_WebDev/staff.php?page=user_add'>Add user</a>";
$content .= $add_link;

$users = ['content' => $content, 'user_button' => '<span class="sr-only">(current)', 'title' => "User List", 'user_active' => 'active'];

View::render('base.html', $users);