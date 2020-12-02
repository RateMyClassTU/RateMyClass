<?php
    session_start();
    require_once("config.php");

    $Message = $_POST["Message"];
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("<code>Unable to connect to database.(".mysqli_error($con).")</code>");
        header("location:../../course.php");
        exit();
    }

    $query = "SELECT * FROM CourseReviews WHERE Course='$Message';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("<code>Query failed.(".mysqli_error($con).")</code>");
        header("location:../../course.php");
        exit();
    }
    $msg = ""; // initialize msg

    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_array($result)) {
            $msg .= "<div class='reviewContainer'>";
            $msg .= "<span>Course: ".$data['Course']."</span>";
            $msg .= "<span class='ml-5'>Posted by: ".$data['Username']."</span>";
            $msg .= "<p class='mb-3'>".$data['Comment']."<p>";
            $msg .= "<span>Upvotes: ".$data['Upvotes']."</span>";
            $msg .= "<span class='ml-5'>Downvotes: ".$data['Downvotes']."</span>";
            $msg .= "</div>";
        }
        echo($msg);
    } else {
        $msg = "No results found";
        echo($msg);
    }
    exit();
?>