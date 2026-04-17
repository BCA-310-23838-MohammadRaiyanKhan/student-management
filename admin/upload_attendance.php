<?php
include "../config/db.php";
if(isset($_POST['submit'])){
    mysqli_query($conn,
"INSERT INTO attendance VALUES(
 NULL,
 '".$_POST['student']."',
 '".$_POST['subject']."',
 '".$_POST['percent']."'
)");
} 
$students = mysqli_query($conn, "
    SELECT students.student_id, users.name 
    FROM students 
    INNER JOIN users 
    ON students.user_id = users.id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Attendance</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Your CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-lg border-0 rounded-4 p-4 modern-card">

                <h3 class="text-center mb-4 text-primary fw-bold">
                    <i class="bi bi-bar-chart-line-fill"></i>
                    Upload Attendance
                </h3>

                <?php if(isset($_POST['submit'])): ?>
                    <div class="alert alert-success">
                        Attendance Uploaded Successfully!
                    </div>
                <?php endif; ?>

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Select Student
                        </label>
                        <select name="student"
                                class="form-select form-select-lg"
                                required>
                            <option value="">Choose Student</option>

                            <?php while($row = mysqli_fetch_assoc($students)) { ?>
                                <option value="<?= $row['student_id']; ?>">
                                    <?= $row['name']; ?> 
                                    (ID: <?= $row['student_id']; ?>)
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Subject
                        </label>
                        <input type="text"
                               name="subject"
                               class="form-control form-control-lg"
                               placeholder="Enter Subject"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Attendance %
                        </label>
                        <input type="number"
                               min="0" max="100"
                               name="percent"
                               class="form-control form-control-lg"
                               placeholder="Enter Percentage"
                               required>
                    </div>

                    <button class="btn btn-success btn-lg w-100 fw-bold"
                            name="submit">
                        <i class="bi bi-upload"></i>
                        Upload Attendance
                    </button>

                </form>

            </div>

        </div>
    </div>

</div>
<script>
function toggleSidebar(){
    document.getElementById("sidebar").classList.toggle("hide");
    document.getElementById("main").classList.toggle("full");
}
</script>
            </body>
            </html>