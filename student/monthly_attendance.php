<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['role']) || $_SESSION['role']!='student'){
    header("Location: ../login.php");
    exit();
}

$studentId = $_SESSION['student_id'];
$month = date('m');
$year  = date('Y');

/* Total classes */
$total = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT COUNT(*) as total
     FROM attendance_live
     WHERE student_id='$studentId'
       AND MONTH(attendance_date)='$month'
       AND YEAR(attendance_date)='$year'"
))['total'];

/* Present count */
$present = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT COUNT(*) as present
     FROM attendance_live
     WHERE student_id='$studentId'
       AND status='Present'
       AND MONTH(attendance_date)='$month'
       AND YEAR(attendance_date)='$year'"
))['present'];

$percentage = ($total > 0) ? round(($present / $total) * 100, 2) : 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Monthly Attendance</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container mt-5 table-card">
<h3>My Attendance (<?= date('F Y') ?>)</h3>

<table class="table">
<tr><th>Total Classes</th><td><?= $total ?></td></tr>
<tr><th>Present</th><td><?= $present ?></td></tr>
<tr><th>Attendance %</th>
    <td>
        <strong><?= $percentage ?>%</strong>
        <?php if($percentage < 75) echo "<span class='text-danger'>(Low)</span>"; ?>
    </td>
</tr>
</table>

</div>

</body>
</html>
