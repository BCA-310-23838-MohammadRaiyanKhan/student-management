<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['role']) || $_SESSION['role']!='student'){
    header("Location: ../login.php");
    exit();
}

$studentId = $_SESSION['student_id'];
$res = mysqli_query(
    $conn,
    "SELECT * FROM admit_cards WHERE student_id = '$studentId'"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admit Card</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container mt-5 table-card">
<h3>Your Admit Card</h3>

<?php
if(mysqli_num_rows($res)==0){
    echo "<p>No admit card uploaded yet.</p>";
}

while($row=mysqli_fetch_assoc($res)){
    echo "<a class='btn btn-primary'
          href='../uploads/{$row['file_path']}'
          target='_blank'>Download Admit Card</a>";
}
?>
</div>

</body>
</html>
