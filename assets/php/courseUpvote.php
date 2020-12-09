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

    if (mysqli_num_rows($result) != 1) {
        echo("No match or duplicate entry");
        exit();
    }
    
    $query = "UPDATE CourseReviews SET Upvotes=Upvotes+1 WHERE ID='$ID';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed".mysqli_error($con));
        exit();
    }

    echo("Upvote successful");
    exit();
?>