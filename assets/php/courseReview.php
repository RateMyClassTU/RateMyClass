<?php
    session_start();
    require_once("config2.php");

    $Message = $_POST["Message"];
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("<code>Unable to connect to database.(".mysqli_error($con).")</code>");
        header("location:../../course.php");
        exit();
    }

    $query = "SELECT * FROM CourseReviews WHERE Course='$Message' ORDER BY ID DESC;";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("<code>Query failed.(".mysqli_error($con).")</code>");
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
            $msg .= "<td><a href='#'><i class='far fa-thumbs-up'></i></a><b> Upvotes: </b>".$data['Upvotes']."</td>";
            $msg .= "<td><a href='#'><i class='far fa-thumbs-down'></i></a><b> Downvotes: </b>".$data['Downvotes']."</td>";
            $msg .= "</tr></table>";
            $msg .= "<div class='col-12' style='height:20vh;'>".$data['Comment']."</div></div>";
        }
    } else {
        $msg = "No results found";
    }
    
    echo($msg);
    exit();
?>