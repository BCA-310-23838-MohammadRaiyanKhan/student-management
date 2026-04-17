<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['role']) || $_SESSION['role']!='admin'){
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

$res = mysqli_query($conn,"
    SELECT u.id as user_id, u.name, u.email, u.phone,
           s.roll_no, s.class, s.semester, s.course
    FROM students s
    JOIN users u ON s.user_id = u.id
    WHERE s.student_id='$id'
");
$row = mysqli_fetch_assoc($res);

if(isset($_POST['update'])){
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $phone  = $_POST['phone'];
    $roll   = $_POST['roll'];
    $class  = $_POST['class'];
    $sem    = $_POST['semester'];
    $course = $_POST['course'];

    mysqli_query($conn,"
        UPDATE users 
        SET name='$name', email='$email', phone='$phone'
        WHERE id='{$row['user_id']}'
    ");

    mysqli_query($conn,"
        UPDATE students 
        SET roll_no='$roll', class='$class',
            semester='$sem', course='$course'
        WHERE student_id='$id'
    ");

    header("Location: view_students.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Student</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<h3>Edit Student</h3>

<form method="POST">
<input class="form-control mb-2" name="name" value="<?= $row['name'] ?>" required>
<input class="form-control mb-2" name="email" value="<?= $row['email'] ?>" required>
<input class="form-control mb-2" name="phone" value="<?= $row['phone'] ?>">
<input class="form-control mb-2" name="roll" value="<?= $row['roll_no'] ?>">
<input class="form-control mb-2" name="class" value="<?= $row['class'] ?>">
<input class="form-control mb-2" name="semester" value="<?= $row['semester'] ?>">
<input class="form-control mb-2" name="course" value="<?= $row['course'] ?>">

<button class="btn btn-success" name="update">
    Update Student
</button>
</form>

</div>
<script>
function toggleSidebar(){
    document.getElementById("sidebar").classList.toggle("hide");
    document.getElementById("main").classList.toggle("full");
}
</script>
</body>
</html>
