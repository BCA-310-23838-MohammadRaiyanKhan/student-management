<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['role']) || $_SESSION['role']!='admin'){
    header("Location: ../login.php");
    exit();
}

/* SAVE ATTENDANCE */
if(isset($_POST['save'])){
    $subject = $_POST['subject'];
    $date = date('Y-m-d');

    foreach($_POST['attendance'] as $student_id => $status){
        mysqli_query($conn,
            "INSERT INTO attendance_live 
            (student_id, subject, status, attendance_date)
            VALUES ('$student_id','$subject','$status','$date')"
        );
    }

    echo "<div class='alert alert-success'>Attendance Saved Successfully</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Mark Attendance</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container mt-5 table-card">
<h3>Mark Attendance (Live)</h3>

<form method="POST">
    <input class="form-control mb-3"
           name="subject"
           placeholder="Subject Name" required>

    <table class="table table-bordered">
        <tr>
            <th>Student Name</th>
            <th>Present</th>
            <th>Absent</th>
        </tr>

        <?php
        $res = mysqli_query($conn,
            "SELECT s.student_id, u.name
             FROM students s
             JOIN users u ON s.user_id = u.id"
        );

        while($row=mysqli_fetch_assoc($res)){
            echo "<tr>
                <td>{$row['name']}</td>
                <td>
                    <input type='radio'
                           name='attendance[{$row['student_id']}]'
                           value='Present' checked>
                </td>
                <td>
                    <input type='radio'
                           name='attendance[{$row['student_id']}]'
                           value='Absent'>
                </td>
            </tr>";
        }
        ?>
    </table>

    <button class="btn btn-primary" name="save">
        Save Attendance
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
