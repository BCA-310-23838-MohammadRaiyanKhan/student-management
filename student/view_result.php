<?php
session_start();
include "../config/db.php";

$student_id = $_SESSION['student_id'];

$results = mysqli_query($conn,"
    SELECT * FROM results
    WHERE student_id='$student_id'
");

$total = 0;
$count = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Results</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg,#1e3c72,#2a5298);
            min-height:100vh;
            padding:40px;
        }

        .result-card{
            background:white;
            border-radius:20px;
            padding:30px;
            box-shadow:0 20px 40px rgba(0,0,0,0.3);
            animation: fadeIn 0.6s ease;
        }

        .table th{
            background:#2563eb;
            color:white;
        }

        .badge-A { background:#16a34a; }
        .badge-B { background:#2563eb; }
        .badge-C { background:#f59e0b; }
        .badge-Fail { background:#dc2626; }

        @keyframes fadeIn{
            from{opacity:0; transform:translateY(20px);}
            to{opacity:1; transform:translateY(0);}
        }
    </style>
</head>

<body>

<div class="container">
    <div class="result-card">

        <h3 class="mb-4 text-center">
            <i class="bi bi-award-fill"></i> My Results
        </h3>

        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Marks</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>

            <?php while($row = mysqli_fetch_assoc($results)) { 
                $total += $row['marks'];
                $count++;
            ?>
                <tr>
                    <td><?= $row['subject'] ?></td>
                    <td><?= $row['marks'] ?></td>
                    <td>
                        <span class="badge badge-<?= $row['grade'] ?>">
                            <?= $row['grade'] ?>
                        </span>
                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

        <?php 
        if($count > 0){
            $average = round($total/$count,2);
        ?>
            <hr>

            <h5 class="text-center mt-4">
                Overall Percentage: <?= $average ?>%
            </h5>

            <div class="progress mt-3" style="height:25px;">
                <div class="progress-bar bg-success"
                     style="width: <?= $average ?>%;">
                     <?= $average ?>%
                </div>
            </div>

        <?php } ?>

    </div>
</div>

</body>
</html>