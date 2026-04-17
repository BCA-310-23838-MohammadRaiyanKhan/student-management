<?php
session_start();
include "config/db.php";

$error = "";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Correct query with role
    $q = "SELECT * FROM users 
      WHERE email='$email' 
      AND password='$password'";

    $res = mysqli_query($conn,$q);
    if(mysqli_num_rows($res)==1){
        
        $row = mysqli_fetch_assoc($res);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];

        if($row['role']=='admin'){
            header("Location: admin/dashboard.php");
            exit();
        }

        if($row['role']=='student'){

            $sidQuery = mysqli_query(
                $conn,
                "SELECT student_id FROM students WHERE user_id = '".$row['id']."'"
            );

            if(mysqli_num_rows($sidQuery)==1){
                $sidRow = mysqli_fetch_assoc($sidQuery);
                $_SESSION['student_id'] = $sidRow['student_id'];
            }

            header("Location: student/dashboard.php");
            exit();
        }

    } else {
        $error = "Invalid Email or Password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="modern-login-body">
    
<!-- ================= HEADER ================= -->
<nav class="login-header navbar navbar-expand-lg navbar-dark">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold text-white" href="#">
            🎓 CIMAGE Portal
        </a>

        <!-- Toggle for Mobile -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse justify-content-end"
             id="navbarNav">

            <ul class="navbar-nav align-items-center">

                <li class="nav-item">
                    <a class="nav-link text-white"
                       href="about.php">
                       About Us
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white"
                       href="help.php">
                       Help
                    </a>
                </li>

                <li class="nav-item ms-3">
                    <a class="btn btn-light signup-btn"
                       href="signup.php">
                       Sign Up
                    </a>
                </li>

            </ul>

        </div>
    </div>
</nav>
<!-- ================= LOGIN SECTION ================= -->
<div class="login-wrapper">

    <div class="login-box">

        <!-- LEFT SIDE -->
        <div class="login-left">
            <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png">
        </div>

        <!-- RIGHT SIDE -->
        <div class="login-right">

            <h3> Login</h3>
            <p class="text-muted mb-4">Enter your details to login</p>

            <form method="POST">
                <!-- <div class="mb-3 text-center"> -->
    <!-- <label class="me-3">
        <input type="radio" name="role" value="student" checked> Student
    </label>
    <label>
        <input type="radio" name="role" value="admin"> Admin
    </label>
</div> -->
                <input type="email"
                       name="email"
                       class="form-control modern-input mb-3"
                       placeholder="Enter your email"
                       required>

                <div class="position-relative mb-3">
    <input type="password" id="password"
           class="form-control"
           name="password"
           placeholder="Enter your password" required>
           
           <div class="text-end mb-3">
    <a href="forgot_password.php" class="text-decoration-none">
        Forgot Password?
    </a>
</div>

    <i class="bi bi-eye position-absolute"
       style="right:15px; top:12px; cursor:pointer;"
       onclick="togglePassword()"></i>
</div>

                <button class="btn modern-btn w-100"
                        name="login">
                        Login In
                </button>
            </form>

        </div>

    </div>

</div>


<!-- ================= FOOTER ================= -->
<footer class="login-footer text-center">
    © 2026 Student Management System | Developed by Mohammad Ayan
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
