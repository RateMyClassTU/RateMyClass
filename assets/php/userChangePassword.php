<?php
    session_start();
    require_once("config.php");

    $Email = $_SESSION["Email"];
    $oldPassword = hash('sha256', ($_POST["oldPassword"]));
    $newPassword = hash('sha256', ($_POST["newPassword"]));

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("failed to connect to db".mysqli_error($con));
        exit();
    }

    $query = "SELECT * FROM Users WHERE Email='$Email' AND Password='$oldPassword';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("query failed".mysqli_error($con));
        exit();
    }

    if (mysqli_num_rows($result) != 1) {
        echo("Old password did not match");
        exit();
    }

    $query = "UPDATE Users SET Password='$newPassword' WHERE Email='$Email';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("query failed".mysqli_error($con));
        exit();
    }

    echo("Password changed successfully");
    exit();

?>