<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../login.php");
    exit();
}
?>

<?php
include "../config/db.php";
$subjects = [];
$percentages = [];

$q = mysqli_query($conn,
    "SELECT subject, AVG(percentage) as avg_att 
     FROM attendance 
     GROUP BY subject"
);


while($row = mysqli_fetch_assoc($q)){
    $subjects[] = $row['subject'];
    $percentages[] = $row['avg_att'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Custom CSS -->
<link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4>Teacher Panel</h4>
    <a href="view_students.php"><i class="bi bi-people"></i> Student Details</a>
    <a href="mark_attendance.php"><i class="bi bi-check2-square"></i> Live Attendance</a>
    <a href="add_student.php"><i class="bi bi-person-plus"></i> Add Student</a>
    <a href="upload_attendance.php"><i class="bi bi-bar-chart"></i> Attendance</a>
    <a href="upload_notice.php"><i class="bi bi-megaphone"></i> Notice</a>
    <a href="upload_result.php"><i class="bi bi-journal-text"></i> Result</a>
    <a href="upload_admitcard.php"><i class="bi bi-card-list"></i> Admit Card</a>
    <a href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <h2 class="mb-4">Welcome, Teacher 👋</h2>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="dashboard-card bg-blue" onclick="location.href='add_student.php'">
                <div class="icon"><i class="bi bi-person-plus"></i></div>
                <h5>Add Student</h5>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card bg-green" onclick="location.href='upload_attendance.php'">
                <div class="icon"><i class="bi bi-bar-chart"></i></div>
                <h5>Upload Attendance</h5>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card bg-orange" onclick="location.href='upload_notice.php'">
                <div class="icon"><i class="bi bi-megaphone"></i></div>
                <h5>Upload Notice</h5>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card bg-purple" onclick="location.href='upload_result.php'">
                <div class="icon"><i class="bi bi-journal-text"></i></div>
                <h5>Upload Result</h5>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card card-admit" onclick="location.href='upload_admitcard.php'">
                <div class="icon"><i class="bi bi-card-list"></i></div>
                <h5>Upload Admit Card</h5>
            </div>
        </div>
    </div>
</div>
<!-- Dark Mode Button -->
<button onclick="toggleDarkMode()" class="btn btn-sm btn-dark mb-3">
    🌙 Toggle Dark Mode
</button>

<h4 class="mt-4">Attendance Overview</h4>
<canvas id="attendanceChart" height="100"></canvas>

<script>
const ctx = document.getElementById('attendanceChart');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Math', 'DBMS', 'Java', 'OS', 'CN'],
        datasets: [{
            label: 'Average Attendance %',
            data: [85, 78, 90, 70, 88],
            backgroundColor: '#38ef7d'
        }]
    },
    options: {
        animation: {
            duration: 1500,
            easing: 'easeOutBounce'
        },
        scales: {
            y: { beginAtZero: true, max: 100 }
        }
    }
});
</script>
<h4 class="mt-4">Attendance Overview</h4>
<canvas id="attendanceChart"></canvas>

<script>
const ctx = document.getElementById('attendanceChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($subjects) ?>,
        datasets: [{
            label: 'Average Attendance (%)',
            data: <?= json_encode($percentages) ?>,
            backgroundColor: '#4ade80'
        }]
    },
    options: {
        responsive: true,
        animation: {
            duration: 1500
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 100
            }
        }
    }
});
</script>
<script src="../assets/js/main.js"></script>
<script>
function toggleSidebar(){
    document.getElementById("sidebar").classList.toggle("hide");
    document.getElementById("main").classList.toggle("full");
}
</script>
</body>
</html>
