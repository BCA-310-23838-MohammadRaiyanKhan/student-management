<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['role']) || $_SESSION['role']!='admin'){
    header("Location: ../login.php");
    exit();
}

/* DELETE NOTICE */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM notices WHERE id='$id'");
    header("Location: upload_notice.php");
    exit();
}

/* ADD NOTICE */
if(isset($_POST['post'])){
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $desc  = mysqli_real_escape_string($conn,$_POST['desc']);

    mysqli_query(
        $conn,
        "INSERT INTO notices (title, description, created_at)
         VALUES ('$title','$desc',NOW())"
    );

    echo "<div class='alert alert-success'>Notice Posted</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Notices</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container mt-5 table-card">
<h3>Manage Notices</h3>

<!-- ADD NOTICE -->
<form method="POST" class="mb-4">
    <input class="form-control mb-2" name="title" placeholder="Notice Title" required>
    <textarea class="form-control mb-2" name="desc" placeholder="Notice Description" required></textarea>
    <button class="btn btn-primary" name="post">Post Notice</button>
</form>

<hr>

<!-- LIST NOTICE -->
<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Date</th>
    <th>Action</th>
</tr>

<?php
$res = mysqli_query($conn,"SELECT * FROM notices ORDER BY id DESC");
while($row=mysqli_fetch_assoc($res)){
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['title']}</td>
        <td>{$row['created_at']}</td>
        <td>
            <a class='btn btn-sm btn-warning'
               href='edit_notice.php?id={$row['id']}'>Edit</a>

            <a class='btn btn-sm btn-danger'
               href='upload_notice.php?delete={$row['id']}'
               onclick=\"return confirm('Delete this notice?')\">
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
