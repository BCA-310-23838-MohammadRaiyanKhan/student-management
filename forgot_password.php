<?php
include "config/db.php";

$msg = "";

if(isset($_POST['check'])){

    $email = $_POST['email'];

    $res = mysqli_query($conn,
        "SELECT * FROM users WHERE email='$email'"
    );

    if(mysqli_num_rows($res)==1){
        header("Location: reset_password.php?email=$email");
        exit();
    } else {
        $msg = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card p-4 col-md-4 mx-auto">
        <h4 class="text-center mb-3">Forgot Password</h4>

        <?php if($msg){ ?>
            <div class="alert alert-danger"><?= $msg ?></div>
        <?php } ?>

        <form method="POST">
            <input type="email" name="email" class="form-control mb-3"
                   placeholder="Enter your email" required>

            <button class="btn btn-primary w-100" name="check">
                Continue
            </button>
        </form>
    </div>
</div>

</body>
</html>