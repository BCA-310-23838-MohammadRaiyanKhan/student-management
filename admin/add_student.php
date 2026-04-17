<?php
include "../config/db.php";

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $roll = $_POST['roll'];
    $class = $_POST['class'];
    $semester = $_POST['semester'];
    $course = $_POST['course'];

    // Insert into users
    mysqli_query($conn,"
        INSERT INTO users (name,email,password,role,phone)
        VALUES ('$name','$email','$password','student','$phone')
    ");

    $user_id = mysqli_insert_id($conn);

    // Insert into students table
    mysqli_query($conn,"
        INSERT INTO students (user_id,roll_no,class,semester,course)
        VALUES ('$user_id','$roll','$class','$semester','$course')
    ");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg,#1e3c72,#2a5298);
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .student-card{
            background:white;
            padding:35px;
            border-radius:20px;
            width:550px;
            box-shadow:0 20px 40px rgba(0,0,0,0.3);
            animation: fadeIn 0.6s ease;
        }

        .student-card h3{
            text-align:center;
            font-weight:bold;
            margin-bottom:25px;
        }

        .form-control{
            height:45px;
            border-radius:10px;
        }

        .btn-custom{
            background:linear-gradient(45deg,#2563eb,#60a5fa);
            color:white;
            font-weight:bold;
            border:none;
            height:45px;
            border-radius:10px;
            transition:0.3s;
        }

        .btn-custom:hover{
            transform:scale(1.05);
            box-shadow:0 10px 20px rgba(0,0,0,0.3);
        }

        @keyframes fadeIn{
            from{opacity:0; transform:translateY(20px);}
            to{opacity:1; transform:translateY(0);}
        }
    </style>
</head>

<body>

<div class="student-card">

    <h3><i class="bi bi-person-plus"></i> Add Student</h3>

    <form method="POST">

        <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>

        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

        <input type="text" name="phone" class="form-control mb-3" placeholder="Phone">

        <input type="text" name="roll" class="form-control mb-3" placeholder="Roll No" required>

        <input type="text" name="class" class="form-control mb-3" placeholder="Class" required>

        <input type="number" name="semester" class="form-control mb-3" placeholder="Semester" required>

        <input type="text" name="course" class="form-control mb-3" placeholder="Course" required>

        <button class="btn btn-custom w-100" name="submit">
            <i class="bi bi-check-circle"></i> Add Student
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