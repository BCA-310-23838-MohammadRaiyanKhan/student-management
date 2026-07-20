<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
</html><?php
include "config/db.php";

$msg = "";

if(isset($_POST['signup'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // check email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){
        $msg = "Email already exists ❌";
    } else {

        // insert user as student
        mysqli_query($conn,
            "INSERT INTO users (name,email,password,role)
             VALUES('$name','$email','$password','student')"
        );

        header("Location: info.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Signup</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<div class="card p-4 col-md-4 mx-auto">

<h3 class="text-center">Signup</h3>

<?php if($msg){ ?>
<div class="alert alert-danger"><?= $msg ?></div>
<?php } ?>

<form method="POST">

<input type="text" name="name" class="form-control mb-3" placeholder="Name" required>

<input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<button class="btn btn-success w-100" name="signup">Sign Up</button>

</form>

</div>
</div>

</body>
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
</html><?php
include "config/db.php";

$msg = "";

if(isset($_POST['signup'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // check email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){
        $msg = "Email already exists ❌";
    } else {

        // insert user as student
        mysqli_query($conn,
            "INSERT INTO users (name,email,password,role)
             VALUES('$name','$email','$password','student')"
        );

        header("Location: info.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Signup</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<div class="card p-4 col-md-4 mx-auto">

<h3 class="text-center">Signup</h3>

<?php if($msg){ ?>
<div class="alert alert-danger"><?= $msg ?></div>
<?php } ?>

<form method="POST">

<input type="text" name="name" class="form-control mb-3" placeholder="Name" required>

<input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<button class="btn btn-success w-100" name="signup">Sign Up</button>

</form>

</div>
</div>

</body>
</html>