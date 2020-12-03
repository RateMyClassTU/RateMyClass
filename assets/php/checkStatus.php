<?php
    session_start();
    require_once("config.php");

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if (!$con) {
        echo('Unable to connect to db'.mysqli_error($con));
        header("location:../../home.php");
        exit();
    }

    $Email = $_SESSION["Email"];

    $query = "SELECT * FROM User WHERE Email='$Email';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo('Query failed'.mysqli_error($con));
        header("location:../../home.php");
        exit();
    }

    $data = mysqli_fetch_array($result);

    if ($data['Status'] == 2) {
        $msg = 'admin';
    } else {
        $msg = 'not admin';
        $_SESSION["admin"] = 0;
    }
    echo($msg);
    exit();
?>
