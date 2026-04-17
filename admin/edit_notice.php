<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['role']) || $_SESSION['role']!='admin'){
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

$res = mysqli_query($conn,"SELECT * FROM notices WHERE id='$id'");
$row = mysqli_fetch_assoc($res);

if(isset($_POST['update'])){
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $desc  = mysqli_real_escape_string($conn,$_POST['desc']);

    mysqli_query(
        $conn,
        "UPDATE notices 
         SET title='$title', description='$desc' 
         WHERE id='$id'"
    );

    header("Location: upload_notice.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Notice</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container mt-5 table-card">
<h3>Edit Notice</h3>

<form method="POST">
    <input class="form-control mb-2"
           name="title"
           value="<?= $row['title'] ?>" required>

    <textarea class="form-control mb-2"
              name="desc" required><?= $row['description'] ?></textarea>

    <button class="btn btn-success" name="update">Update Notice</button>
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
