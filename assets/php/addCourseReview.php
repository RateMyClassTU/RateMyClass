<?php
    session_start();
    require_once("config.php");

    $Course = $_POST["Course"];
    $Comment = $_POST["Comment"];
    $Email = $_SESSION["Email"];

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Unable to connect to database".mysqli_error($con));
        header("location:../../course.php");
        exit();
    }

    $query = "INSERT INTO CourseReviews (Course, Comment, Username, Upvotes, Downvotes) VALUES ('$Course', '$Comment', '$Username', 0, 0);";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Unable to complete query".mysqli_error($con));
        header("location:../../course.php");
        exit();
    }

    exit();
?>