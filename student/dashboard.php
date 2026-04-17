<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../config/db.php";

if(!isset($_SESSION['role']) || $_SESSION['role']!='student'){
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];

$res = mysqli_query($conn,
    "SELECT name FROM users WHERE id='$userId'"
);
$row = mysqli_fetch_assoc($res);
$studentName = $row['name'];
?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'student'){
    header("Location: ../login.php");
    exit();
}
include "../config/db.php";
$studentId = $_SESSION['user_id'];

$sub = [];
$per = [];

$q = mysqli_query($conn, "SELECT subject, percentage FROM attendance WHERE student_id='$studentId'");
while($r = mysqli_fetch_assoc($q)){
    $sub[] = $r['subject'];
    $per[] = $r['percentage'];
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Student Dashboard</title>
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Custom CSS -->
<link rel="stylesheet" href="../assets/css/style.css">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="sidebar">
    <h4>Student Panel</h4>
    <a href="monthly_attendance.php">
    <i class="bi bi-graph-up"></i> Attendance %</a>
    <a href="view_attendance.php"><i class="bi bi-calendar-check"></i> Attendance</a>
    <a href="profile.php"><i class="bi bi-person"></i> My Profile</a>
    <a href="view_notice.php"><i class="bi bi-megaphone"></i> Notices</a>
    <a href="view_result.php"><i class="bi bi-journal-text"></i> Results</a>
    <a href="view_admitcard.php"><i class="bi bi-card-list"></i> Admit Card</a>
    <a href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<div class="main-content">
    <button onclick="toggleDarkMode()" class="btn btn-sm btn-dark mb-3">
        🌙 Toggle Dark Mode
    </button>

    <h2>Welcome Student 👋</h2>

  <div class="dashboard-card bg-blue"
     onclick="window.location.href='view_attendance.php'">
    📊 Attendance
</div>

<div class="dashboard-card bg-green"
     onclick="window.location.href='view_notice.php'">
    📢 Notices
</div>

<div class="dashboard-card bg-purple"
     onclick="window.location.href='view_result.php'">
    📝 Results
</div>

<div class="dashboard-card bg-orange"
     onclick="window.location.href='view_admitcard.php'">
    🎫 Admit Card
</div>

    <h4 class="mt-5">Your Attendance</h4>
    <canvas id="studentAttendanceChart" height="100"></canvas>
</div>

<script>
new Chart(document.getElementById('studentAttendanceChart'), {
    type: 'line',
    data: {
        labels: ['Math', 'DBMS', 'Java', 'OS', 'CN'],
        datasets: [{
            label: 'Attendance %',
            data: [90, 82, 88, 75, 92],
            borderColor: '#6dd5ed',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        animation: {
            duration: 2000,
            easing: 'easeInOutQuart'
        },
        scales: {
            y: { beginAtZero: true, max: 100 }
        }
    }
});
</script>
<h4 class="mt-4">Your Attendance</h4>
<canvas id="studentChart"></canvas>

<script>
new Chart(document.getElementById('studentChart'), {
    type: 'line',
    data: {
        labels: <?= json_encode($sub) ?>,
        datasets: [{
            label: 'Attendance %',
            data: <?= json_encode($per) ?>,
            borderColor: '#60a5fa',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true, max: 100 }
        }
    }
});
</script>


<script src="../assets/js/main.js"></script>
</body>
</html>
