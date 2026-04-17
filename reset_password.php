<?php
include "config/db.php";

$email = $_GET['email'];
$msg = "";

if(isset($_POST['reset'])){

    $pass = $_POST['password'];

    mysqli_query($conn,
        "UPDATE users SET password='$pass' WHERE email='$email'"
    );

    $msg = "Password Updated Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card p-4 col-md-4 mx-auto">
        <h4 class="text-center mb-3">Reset Password</h4>

        <?php if($msg){ ?>
            <div class="alert alert-success"><?= $msg ?></div>
        <?php } ?>

        <form method="POST">
            <input type="password" name="password"
                   class="form-control mb-3"
                   placeholder="Enter new password" required>

            <button class="btn btn-success w-100" name="reset">
                Reset Password
            </button>
        </form>
    </div>
</div>

</body>
</html>