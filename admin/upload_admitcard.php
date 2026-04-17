<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['role']) || $_SESSION['role']!='admin'){
    header("Location: ../login.php");
    exit();
}

/* DELETE ADMIT CARD */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $q = mysqli_query($conn,"SELECT file_path FROM admit_cards WHERE id='$id'");
    $row = mysqli_fetch_assoc($q);

    if(file_exists("../uploads/".$row['file_path'])){
        unlink("../uploads/".$row['file_path']);
    }

    mysqli_query($conn,"DELETE FROM admit_cards WHERE id='$id'");
    header("Location: upload_admitcard.php");
}

/* UPLOAD ADMIT CARD */
if(isset($_POST['upload'])){
    $student = $_POST['student'];

    $fileName = time()."_".str_replace(" ","_",$_FILES['file']['name']);
    $path = "../uploads/".$fileName;

    if(move_uploaded_file($_FILES['file']['tmp_name'],$path)){
        mysqli_query($conn,
            "INSERT INTO admit_cards VALUES(NULL,'$student','$fileName')"
        );
        echo "<div class='alert alert-success'>Admit Card Uploaded</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Upload Admit Card</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container mt-4 table-card">
<h4>Upload / Manage Admit Cards</h4>

<form method="POST" enctype="multipart/form-data" class="mb-4">
    <select name="student" class="form-control mb-2" required>
    <option value="">Select Student</option>
    <?php
    $s = mysqli_query($conn,
        "SELECT s.student_id, u.name 
         FROM students s 
         JOIN users u ON s.user_id = u.id"
    );

    while($r = mysqli_fetch_assoc($s)){
        echo "<option value='{$r['student_id']}'>{$r['name']}</option>";
    }
    ?>
</select>


    <input type="file" name="file" class="form-control mb-2" required>
    <button name="upload" class="btn btn-primary">Upload</button>
</form>

<hr>

<h5>Uploaded Admit Cards</h5>

<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Student ID</th>
    <th>File</th>
    <th>Action</th>
</tr>

<?php
$res=mysqli_query($conn,"SELECT a.*, u.name 
FROM admit_cards a
JOIN students s ON a.student_id = s.student_id
JOIN users u ON s.user_id = u.id");
while($row=mysqli_fetch_assoc($res)){
   echo "<tr>
    <td>".$row['id']."</td>
    <td>".$row['name']."</td>
    <td>".$row['file_path']."</td>
    <td>
        <a class='btn btn-success btn-sm' 
           href='../uploads/".$row['file_path']."' 
           target='_blank'>View</a>

        <a class='btn btn-danger btn-sm'
           href='upload_admitcard.php?delete=".$row['id']."'
           onclick='return confirm(\"Delete this admit card?\")'>
           Delete
        </a>
    </td>
</tr>";

}
?>
</table>
</div>

<script>
function toggleSidebar(){
    document.getElementById("sidebar").classList.toggle("hide");
    document.getElementById("main").classList.toggle("full");
}
</script>
</body>
</html>
