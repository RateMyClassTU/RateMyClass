<?php
    session_start();
    require_once("config.php");

    $Email = $_GET["Email"];
    $Acode = $_GET["Acode"];

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE); // connect to db

    if (!$con) { // failed to connect to db
        $_SESSION["Message"] = "<code>Database can not connect.(".mysqli_error($con).")</code>";
        $_SESSION["refresh"] = 0;
        header("location:../../index.php");
        exit();
    }

    $Adatetime = date("Y-m-d H:i:s");

    $query = "SELECT * FROM Users WHERE Email='$Email' AND Acode='$Acode';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        $_SESSION["Message"] = "<code>Query failed.(".mysqli_error($con).")</code>";
        $_SESSION["refresh"] = 0;
        header("location:../../index.php");
        exit();
    }

    if (mysqli_num_rows($result) != 1) {
        $_SESSION["regState"] = 0;
        $_SESSION["Message"] = "<code>Email or authentication code is wrong.</code>";
        $_SESSION["refresh"] = 0;
        header("location:../../index.php");
        exit();
    }

    $query = "UPDATE User SET Adatetime='$Adatetime' WHERE Email='$Email';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        $_SESSION["Message"] = "<code>Query failed.(".mysqli_error($con).")</code>";
        $_SESSION["refresh"] = 0;
        header("location:../../index.php");
        exit();
    }

    $_SESSION["Email"] = $Email;
    $_SESSION["Message"] = "";
    $_SESSION["regState"] = 3;
    $_SESSION["refresh"] = 0;
    header("location:../../index.php");
    exit();
?>