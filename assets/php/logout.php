<?php
    session_start();
    require_once("config.php");

    $Email = $_SESSION["Email"];
    $LOdatetime = date("Y-m-d H:i:s");

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Error connecting to database".mysqli_error($con));
        header("location:../../index.php");
        exit();
    }

    $query = "UPDATE Users SET LOdatetime='$LOdatetime' WHERE Email='$Email';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed".mysqli_error($con));
        header("location:../../index.php");
        exit();
    }

    session_destroy(); // destroy session variables

    unset($_SESSION["regState"]);
    unset($_SESSION["loggedIn"]);
    unset($_SESSION["Message"]);
    unset($_SESSION["Email"]);
    unset($_SESSION["refresh"]);
    unset($_SESSION["admin"]);

    header("location:../../index.php");
    exit();
?>
