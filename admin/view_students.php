<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['role']) || $_SESSION['role']!='admin'){
    header("Location: ../login.php");
    exit();
}
/* DELETE STUDENT */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    // delete from students first
    mysqli_query($conn,"DELETE FROM students WHERE student_id='$id'");
    // delete from users
    mysqli_query($conn,"
        DELETE FROM users 
        WHERE id NOT IN (SELECT user_id FROM students)
    ");

    header("Location: view_students.php");
    exit();
}

$res = mysqli_query($conn,"
    SELECT 
        s.student_id,
        u.id as user_id,
        u.name,
        u.email,
        u.phone,
        s.roll_no,
        s.class,
        s.semester,
        s.course
    FROM students s
    JOIN users u ON s.user_id = u.id
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Students</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<input type="text" id="searchInput" 
       class="form-control mb-3" 
       placeholder="Search student...">
       
<div class="container mt-5">
<h3>Student Details</h3>

<table class="table table-bordered table-striped">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Roll</th>
    <th>Class</th>
    <th>Semester</th>
    <th>Course</th>
    <th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($res)){ ?>
<tr>
    <td><?= $row['student_id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['phone'] ?></td>
    <td><?= $row['roll_no'] ?></td>
    <td><?= $row['class'] ?></td>
    <td><?= $row['semester'] ?></td>
    <td><?= $row['course'] ?></td>
    <td>
        <a class="btn btn-sm btn-warning"
           href="edit_student.php?id=<?= $row['student_id'] ?>">
           Edit
        </a>

        <a class="btn btn-sm btn-danger"
           href="view_students.php?delete=<?= $row['student_id'] ?>"
           onclick="return confirm('Delete this student?')">
           Delete
        </a>
    </td>
</tr>
<?php } ?>

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
