<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!='admin'){
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>

/* ===== BACKGROUND ===== */
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    color:white;
}

/* ===== SIDEBAR ===== */
.sidebar{
    width:250px;
    height:100vh;
    position:fixed;
    background:rgba(0,0,0,0.6);
    backdrop-filter: blur(10px);
    padding:20px;
    transition:0.4s;
}

.sidebar.hide{
    transform:translateX(-100%);
}

.sidebar h4{
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    padding:12px;
    color:white;
    text-decoration:none;
    border-radius:10px;
    margin-bottom:10px;
    transition:0.3s;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.2);
    transform:translateX(5px);
}

/* ===== MAIN CONTENT ===== */
.main{
    margin-left:270px;
    padding:40px;
    transition:0.4s;
}

.main.full{
    margin-left:20px;
}

/* ===== DASHBOARD CARDS ===== */
.card-modern{
    background:rgba(255,255,255,0.1);
    backdrop-filter: blur(15px);
    border-radius:20px;
    padding:30px;
    text-align:center;
    transition:0.3s;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

.card-modern:hover{
    transform:translateY(-10px);
    box-shadow:0 20px 40px rgba(0,0,0,0.5);
}

/* ===== TOGGLE BUTTON ===== */
.toggle-btn{
    position:fixed;
    top:20px;
    left:20px;
    font-size:22px;
    background:#2563eb;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:8px;
    cursor:pointer;
    z-index:1000;
}

</style>
</head>

<body>

<button class="toggle-btn" onclick="toggleSidebar()">
    <i class="bi bi-list"></i>
</button>

<div class="sidebar" id="sidebar">
    <h4>🎓 Admin Panel</h4>

    <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="view_students.php"><i class="bi bi-people"></i> Students</a>
    <a href="upload_attendance.php"><i class="bi bi-calendar-check"></i> Attendance</a>
    <a href="upload_result.php"><i class="bi bi-award"></i> Results</a>
    <a href="upload_notice.php"><i class="bi bi-megaphone"></i> Notices</a>
    <a href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<div class="main" id="main">