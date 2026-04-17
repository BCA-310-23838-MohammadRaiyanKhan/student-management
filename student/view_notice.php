<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['role'])){
    header("Location: ../login.php");
    exit();
}

$res = mysqli_query($conn, "SELECT * FROM notices ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Notices</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container mt-5">
    <h3>Latest Notices</h3>

    <?php
    if(mysqli_num_rows($res) == 0){
        echo "<p>No notices available.</p>";
    }

    while($row = mysqli_fetch_assoc($res)){
        echo "
        <div class='table-card mb-3'>
            <h5>{$row['title']}</h5>
            <p>{$row['description']}</p>
            <small class='text-muted'>Posted on: {$row['created_at']}</small>
        </div>
        ";
    }
    ?>
</div>

</body>
</html>
