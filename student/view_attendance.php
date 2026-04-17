<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['role']) || $_SESSION['role']!='student'){
    header("Location: ../login.php");
    exit();
}

$studentId = $_SESSION['student_id'];
$res = mysqli_query($conn,
    "SELECT * FROM attendance_live 
     WHERE student_id='$studentId'
     ORDER BY attendance_date DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Attendance</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container mt-5 table-card">
<h3>My Attendance</h3>

<table class="table table-bordered">
<tr>
    <th>Date</th>
    <th>Subject</th>
    <th>Status</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($res)){
    $badge = $row['status']=='Present' ? 'success' : 'danger';

    echo "<tr>
        <td>{$row['attendance_date']}</td>
        <td>{$row['subject']}</td>
        <td><span class='badge bg-$badge'>
            {$row['status']}
        </span></td>
    </tr>";
}
?>
</table>

</div>

</body>
</html>
