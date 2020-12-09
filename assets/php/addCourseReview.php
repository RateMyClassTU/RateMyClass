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

    $query = "INSERT INTO CourseReviews (Course, Comment, Username, Upvotes, Downvotes) VALUES ('$Course', '$Comment', '$Email', 0, 0);";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Unable to complete query".mysqli_error($con));
        header("location:../../course.php");
        exit();
    }

    $query = "SELECT * FROM CourseReviews WHERE Course='$Course' ORDER BY ID DESC;";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed.(".mysqli_error($con));
        header("location:../../course.php");
        exit();
    }
    $msg = "";

    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_array($result)) {
            $msg .= "<div class='table-responsive table-bordered mb-5'>";
            $msg .= "<table class='table table-striped table-bordered'>";
            $msg .= "<tr><td><b>Course: </b>".$data['Course']."</td>";
            $msg .= "<td><b>Posted by: </b>".$data['Username']."</td>";
            $msg .= "<td><b> Upvotes: </b>".$data['Upvotes']."</td>";
            $msg .= "<td><b> Downvotes: </b>".$data['Downvotes']."</td>";
            $msg .= "</tr></table>";
            $msg .= "<div class='col-12' style='height:20vh;'>".$data['Comment']."</div></div>";
        }
    } else {
        $msg = "No results found";
    }

    echo($msg);
    exit();
?>