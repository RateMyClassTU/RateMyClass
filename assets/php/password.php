<?php
    session_start();
    require_once("config.php");

    $Email = $_SESSION["Email"];
    $Password = hash('sha256', ($_POST["Password"]));
    $Password2 = hash('sha256', ($_POST["Password2"]));

    if (strcmp($Password, $Password2) != 0) {
        $_SESSION["Message"] = "<code>The password you've entered didn't match. Try again.</code>";
        $_SESSION["refresh"] = 0;
        header("location:../../index.php");
        exit();
    }

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        $_SESSION["Message"] = "<code>Database can not connect.(".mysqli_error($con).")</code>";
        $_SESSION["refresh"] = 0;
        header("location:../../index.php");
        exit();
    }

    $Acode = rand();

    $query = "UPDATE Users SET Password='$Password', Acode='$Acode', Status='1' WHERE Email='$Email';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        $_SESSION["Message"] = "<code>Could not set password.(".mysqli_error($con).")</code>";
        $_SESSION["refresh"] = 0;
        header("location:../../index.php");
        exit();
    }

    $_SESSION["regState"] = 0;
    $_SESSION["Message"] = "<code>Password has been set! Please login</code>";
    $_SESSION["refresh"] = 0;
    header("location:../../index.php");
    exit();
?>