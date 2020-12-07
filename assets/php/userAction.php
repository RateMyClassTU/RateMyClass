<?php
    session_start();
    require_once("config.php");

    $User = $_POST["User"];
    $Action = $_POST["Action"];

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Unable to connect to database".mysqli_error($con));
        exit();
    }

    $msg = "";

    if ($Action == 'promoteUser') {
        $query = "UPDATE Users SET Status='2' WHERE Email='$User';";
        $result = mysqli_query($con, $query);
        $msg .= "Promoted $User to admin";

    } else if ($Action == 'demoteUser') {
        $query = "UPDATE Users SET Status='1' WHERE Email='$User';";
        $result = mysqli_query($con, $query);
        $msg .= "Demoted $User to regular member";
        
    } else if ($Action == 'deleteUser') {
        $query = "DELETE FROM Users WHERE Email='$User';";
        $result = mysqli_query($con, $query);
        $msg .= "Deleted user $User";
    }

    echo($msg);
    exit();
?>