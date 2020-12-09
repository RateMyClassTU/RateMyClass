<?php
    session_start();
    require_once("config.php");

    $courseName = $_POST["courseName"];
    $courseDesc = $_POST["courseDesc"];

    $Email = $_SESSION["Email"];

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Unable to connect to db.".mysqli_error($con));
        header("location:../../course.php");
        exit();
    }

    $Udatetime = date("Y-m-d H:i:s");

    $query = "SELECT * FROM AddedCourses WHERE Course LIKE '$courseName%';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Unable to query".mysqli_error($con));
        header("location:../../course.php");
        exit();
    }

    if (mysqli_num_rows($result) == 0) { // course doesn't exist
        $query = "INSERT INTO AddedCourses (Course, Description, Username, Udatetime) VALUES ('$courseName', '$courseDesc', '$Email', '$Udatetime');";
        $result = mysqli_query($con, $query);

        if (!$result) {
            echo("query failed".mysqli_error($con));
            header("location:../../course.php");
            exit();
        }

        $msg = "Course added into database";
    } else {
        $msg = "Course already exists";
    }

    echo($msg);
    exit();
?>