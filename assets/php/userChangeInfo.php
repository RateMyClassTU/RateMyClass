<?php
    session_start();
    require_once("config.php");

    $oldEmail = $_SESSION["Email"];
    $newEmail = $_POST["newEmail"];
    $oldPassword = hash('sha256', ($_POST["oldPassword"]));
    $newPassword = hash('sha256', ($_POST["newPassword"]));

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Unable to connect to database. ".mysqli_error($con));
        exit();
    }

    // check if email and old password match
    $query = "SELECT * FROM Users WHERE Email='$oldEmail' AND Password='$oldPassword';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed".mysqli_error($con));
        exit();
    }

    if (mysqli_num_rows($result) != 1) {
        echo("Matching error in database");
        exit();
    }

    // check if new email already exists in db
    $query = "SELECT * FROM Users WHERE Email='$newEmail';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed".mysqli_error($con));
        exit();
    }

    if (mysqli_num_rows($result) > 0) {
        echo("Email already exists");
        exit();
    }

    // set new email and password
    $query = "UPDATE Users SET Email='$newEmail', Password='$newPassword' WHERE Email='$oldEmail';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed".mysqli_error($con));
        exit();
    }

    // update course and professor email
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
    echo("Email and password changed");
    exit();
?>