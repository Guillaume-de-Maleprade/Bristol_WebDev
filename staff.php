<<<<<<< HEAD:admin/index.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Coucou
</body>
</html>
=======
<?php
require($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/View.php');
$current = '<span class="sr-only">(current)';
// Add students in database

// Add staff in database

if (!empty($_GET)) {
    switch ($_GET['page']) {
        case 'staff_list':
            /*$content = file_get_contents("templates/staff_list.html");
            $staff = ['content' => $content, 'staff_button' => $current, 'title' => "Staff List", 'staff_active' => 'active'];
            View::render('templates/base.html', $staff);*/
            header('Location: staff/staff_list.php');
            break;

        case 'staff_add':
            $content = file_get_contents("templates/staff_add.html");
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
            $content = file_get_contents("templates/staff_add.html");
            $student = ['content' => $content, 'student_button' => $current, 'title' => "Student Add", 'student_active' => 'active'];
            View::render('templates/base.html', $student);
            break;

        default:
            View::render('base.html', ['content' => "<h1> Admin page </h1>", 'title' => "Admin Page", 'home_active' => 'active']);
            break;
    }
} else {
    View::render('templates/base.html', ['content' => "<h1> Admin page </h1>", 'title' => "Admin Page", 'home_active' => 'active']);
}
>>>>>>> Guillaume_save:staff.php
