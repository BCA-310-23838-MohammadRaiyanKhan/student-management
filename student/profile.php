<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['role']) || $_SESSION['role']!='student'){
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];

    if (isset($_FILES['photo'])){

    $fileName = $_FILES['photo']['name'];
    $tmpName  = $_FILES['photo']['tmp_name'];

    // 🔹 UNIQUE NAME BANAAO
    $newName = time() . "_" . $fileName;

    // 🔹 OLD IMAGE FETCH
    $oldQuery = mysqli_query($conn,
        "SELECT profile_pic FROM users WHERE id='$userId'"
    );
    $oldRow = mysqli_fetch_assoc($oldQuery);

    // 🔹 DELETE OLD IMAGE
    if(!empty($oldRow['profile_pic']) &&
       file_exists("../uploads/".$oldRow['profile_pic'])){
        unlink("../uploads/".$oldRow['profile_pic']);
    }

    // 🔹 MOVE NEW IMAGE
    move_uploaded_file($tmpName, "../uploads/".$newName);

    // 🔹 UPDATE DATABASE
    mysqli_query($conn,
        "UPDATE users SET profile_pic='$newName' WHERE id='$userId'"
    );

}
$res = mysqli_query($conn,
  "SELECT u.name, u.email, u.phone, u.profile_pic,
          s.roll_no, s.class, s.semester, s.course
   FROM users u
   JOIN students s ON u.id = s.user_id
   WHERE u.id = '$userId'"
);

$row = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="glass-profile container mt-5">
<h3>My Profile</h3>
<div class="text-center mb-4">

<?php if(!empty($row['profile_pic'])){ ?>
    <img src="../uploads/<?= $row['profile_pic'] ?>"
         width="150" height="150"
         style="border-radius:50%; object-fit:cover;">
<?php } else { ?>
    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
         width="150">
<?php } ?>

<form method="POST" enctype="multipart/form-data">

    <!-- Hidden File Input -->
    <input type="file"
           name="photo"
           id="fileInput"
           style="display:none;"
           onchange="this.form.submit()" required>

    <!-- Custom Upload Button -->
    <button type="submit"
        class="btn btn-primary"
        onclick="document.getElementById('fileInput').click();">

    <i class="bi bi-upload"></i> Upload Picture

</button>

</form>
</div>
<table class="table">
<tr><th>Name</th><td><?= $row['name'] ?></td></tr>
<tr><th>Email</th><td><?= $row['email'] ?></td></tr>
<tr><th>Roll No</th><td><?= $row['roll_no'] ?></td></tr>
<tr><th>Class</th><td><?= $row['class'] ?></td></tr>
<tr><th>Semester</th><td><?= $row['semester'] ?></td></tr>
<tr><th>Phone</th><td><?= $row['phone'] ?></td></tr>
<tr><th>Course</th><td><?= $row['course'] ?></td></tr>
</table>

</div>
</body>
</html>
