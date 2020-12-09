<?php
    session_start();
    require_once("config.php");

    $ID = $_POST["ID"];
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Unable to connect to db".mysqli_error($con));
        exit();
    }

    $query = "SELECT * FROM CourseReviews WHERE ID='$ID';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed".mysqli_error($con));
        exit();
    }
    
    $query = "UPDATE CourseReviews SET Downvotes=Downvotes+1 WHERE ID='$ID';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed".mysqli_error($con));
        exit();
    }

    echo("Downvote successful");
    exit();
?>