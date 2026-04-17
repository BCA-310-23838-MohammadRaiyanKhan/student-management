<?php
include "../config/db.php";

if(isset($_POST['submit'])){
    mysqli_query($conn,"
        INSERT INTO results (student_id, subject, marks, grade)
        VALUES (
            '".$_POST['student']."',
            '".$_POST['subject']."',
            '".$_POST['marks']."',
            '".$_POST['grade']."'
        )
    ");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Result</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg,#1e3c72,#2a5298);
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .result-card{
            background:white;
            padding:35px;
            border-radius:20px;
            width:500px;
            box-shadow:0 20px 40px rgba(0,0,0,0.3);
            animation: fadeIn 0.6s ease;
        }

        .result-card h3{
            text-align:center;
            font-weight:bold;
            margin-bottom:25px;
        }

        .form-control{
            height:45px;
            border-radius:10px;
        }

        .btn-custom{
            background:linear-gradient(45deg,#7c3aed,#a855f7);
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

<div class="result-card">

    <h3><i class="bi bi-journal-check"></i> Upload Result</h3>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Student ID</label>
            <input type="text" name="student" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Marks</label>
            <input type="number" name="marks" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Grade</label>
            <input type="text" name="grade" class="form-control" required>
        </div>

        <button class="btn btn-custom w-100" name="submit">
            <i class="bi bi-upload"></i> Submit Result
        </button>

    </form>

</div>
<script>
document.querySelector('input[name="marks"]').addEventListener('input', function(){
    let marks = this.value;
    let gradeField = document.querySelector('input[name="grade"]');

    if(marks >= 90) gradeField.value = "A+";
    else if(marks >= 75) gradeField.value = "A";
    else if(marks >= 60) gradeField.value = "B";
    else if(marks >= 40) gradeField.value = "C";
    else gradeField.value = "Fail";
});
</script>

<script>
function toggleSidebar(){
    document.getElementById("sidebar").classList.toggle("hide");
    document.getElementById("main").classList.toggle("full");
}
</script>
</body>
</html>