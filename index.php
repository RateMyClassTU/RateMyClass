<?php
    session_regenerate_id(true);
    session_start();

    if (!isset($_SESSION["regState"])) $_SESSION["regState"] = 0;
    if (!isset($_SESSION["Message"])) $_SESSION["Message"] = "";
    if (!isset($_SESSION["refresh"])) $_SESSION["refresh"] = 0;

    $_SESSION["refresh"]++;

    if ($_SESSION["refresh"] > 1) {
    	$_SESSION["Message"] = "";
    	$_SESSION["refresh"] = 0;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Rate My Class</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/signin.css">
    <link rel="apple-touch-icon" href="assets/img/favicon/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="assets/img/favicon/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="assets/img/favicon/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="assets/img/favicon/site.webmanifest">
</head>

<body>
    <?php
        if ($_SESSION["regState"] == 0) { // login page
    ?>
    <form class="form-signin" action="assets/php/login.php" method="POST">
        <div class="text-center mb-4">
            <img class="mb-4" src="assets/img/brand/RateMyClassLogo.png" alt="" width="140" height="88">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        </div>
        <div class="form-label-group">
            <input type="email" name="Email" class="form-control" placeholder="Email address" required autofocus>
            <label for="Email" class="sr-only">Email address</label>
            <label for="Email">Email address</label>  
        </div>
        <div class="form-label-group">
            <input type="password" name="Password" class="form-control" placeholder="Password" required>
            <label for="Password" class="sr-only">Password</label>
            <label for="Password">Password</label>
        </div>
        <button class="btn btn-lg btn-danger btn-block mt-3" type="submit">Sign in</button>
        <hr>
        <div class="text-center">
            <a href="assets/php/register.php">Register</a> |
            <a href="assets/php/reset.php">Forget?</a>
        </div>
        <div class="text-center mt-4">
            <?php
                echo($_SESSION["Message"]);
            ?>
        </div>
        <p class="mt-5 text-muted text-center">&copy; 2020 Rate My Class - All Rights Reserved.</p>
    </form>
    <?php
        } else if ($_SESSION["regState"] == 1) { // register page
    ?>
    <form class="form-register" action="assets/php/register2.php" method="GET">
        <div class="text-center mb-4">
            <img class="mb-4" src="assets/img/brand/RateMyClassLogo.png" alt="" width="140" height="88">
            <h1 class="h3 mb-3 font-weight-normal">Create an account</h1>
        </div>
        <div class="form-label-group">
            <input type="text" name="fname" class="form-control" placeholder="First Name" required autofocus>
            <label for="fname" class="sr-only">First Name</label>
            <label for="fname">First Name</label>
        </div>
        <div class="form-label-group">
            <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
            <label for="lname" class="sr-only">Last Name</label>
            <label for="lname">Last Name</label>
        </div>
        <div class="form-label-group">
            <input type="email" name="Email" class="form-control" placeholder="Email address" required>
            <label for="Email" class="sr-only">Email address</label>
            <label for="Email">Email address</label>
        </div>
        <button class="btn btn-lg btn-danger btn-block mt-3" type="submit">Create Account</button>
        <hr>
        <div class="text-center">
            <a href="assets/php/back.php">Already have an account? Click here.</a>
        </div>
        <p class="mt-5 text-muted text-center">&copy; 2020 Rate My Class - All Rights Reserved.</p>
    </form>
    <?php
        } else if ($_SESSION["regState"] == 2) { // password reset
    ?>
    <form class="form-reset" action="assets/php/reset2.php" method="GET">
        <div class="text-center mb-4">
            <img class="mb-4" src="assets/img/brand/RateMyClassLogo.png" alt="" width="140" height="88">
            <h1 class="h3 mb-3 font-weight-normal">Please reset your password</h1>
        </div>
        <div class="form-label-group">
            <input type="email" name="Email" class="form-control" placeholder="Email address" required autofocus>
            <label for="Email" class="sr-only">Email address</label>
            <label for="Email">Email address</label>
        </div>
        <button class="btn btn-lg btn-danger btn-block mt-3" type="submit">Reset password</button>
        <hr>
        <div class="text-center">
            <a href="assets/php/back.php">Return home</a>
        </div>
        <p class="mt-5 text-muted text-center">&copy; 2020 Rate My Class - All Rights Reserved.</p>
    </form>
    <?php
        } else if ($_SESSION["regState"] == 3) { // set password
    ?>
    <form class="form-password" action="assets/php/password.php" method="POST">
        <div class="text-center mb-4">
            <img class="mb-4" src="assets/img/brand/RateMyClassLogo.png" alt="" width="140" height="88">
            <h1 class="h3 mb-3 font-weight-normal">Set Password</h1>
        </div>
        <div class="form-label-group">
            <input type="password" name="Password" class="form-control" placeholder="Password" required autofocus>
            <label for="Password" class="sr-only">Password</label>
            <label for="Password">Password</label>
        </div>
        <div class="form-label-group">
            <input type="password" name="Password2" class="form-control" placeholder="Confirm Password" required>
            <label for="Password2" class="sr-only">Confirm password</label>
            <label for="Password2">Confirm password</label>
        </div>
        <button class="btn btn-lg btn-danger btn-block mt-3" type="submit">Set password</button>
        <hr>
        <div class="text-center">
            <a href="assets/php/back.php">Return home</a>
        </div>
        <p class="mt-5 text-muted text-center">&copy; 2020 Rate My Class - All Rights Reserved.</p>
    </form>
    <?php
        }
    ?>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>