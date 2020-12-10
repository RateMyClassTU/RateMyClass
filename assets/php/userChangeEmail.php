<?php
    session_start();
    require_once("config.php");

    $oldEmail = $_SESSION["Email"];
    $newEmail = $_POST["newEmail"];
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("failed to connect to db".mysqli_error($con));
        exit();
    }

    $query = "SELECT * FROM Users WHERE Email='$oldEmail';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("query 2 failed".mysqli_error($con));
        exit();
    }

    if (mysqli_num_rows($result) != 1) {
        echo("No match found.");
        exit();
    }

    $query = "UPDATE Users SET Email='$newEmail' WHERE Email='$oldEmail';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("query 3 failed".mysqli_error($con));
        exit();
    }

    // update course and professor reviews
    $query = "UPDATE CourseReviews SET Username='$newEmail' WHERE Username='$oldEmail';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("query 4 failed".mysqli_error($con));
        exit();
    }

    $query = "UPDATE ProfessorReviews SET Username='$newEmail' WHERE Username='$oldEmail';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("query 5 failed".mysqli_error($con));
        exit();
    }

    $_SESSION["Email"] = $newEmail;

    echo("Successfully changed email");
    exit();

?>