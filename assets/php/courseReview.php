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
    $msg = "";

    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_array($result)) {
            $msg .= "<table border=1>";
            $msg .= "<tr><td style='width:450px;'><b>Course - </b>".$data['Course']."</td>";
            $msg .= "<td style='width:350px;'><b>Posted by - </b>".$data['Username']."</td>";
            $msg .= "<td style='width:200px;'><b>Upvotes - </b>".$data['Upvotes']."</td>";
            $msg .= "<td style='width:200px;'><b>Downvotes - </b>".$data['Downvotes']."</td>";
            $msg .= "</tr></table>";
            $msg .= "<div class='col-12 mb-3 pt-3 pl-3' style='border:1px solid black; height:20vh;'>".$data['Comment']."</div>";
        }
    } else {
        $msg = "No results found";
    }
    
    echo($msg);
    exit();
?>