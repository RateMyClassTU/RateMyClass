<?php
    session_start();
    require_once("config.php");

    $Professor = $_POST["Professor"];
    $ID = $_POST["ID"];
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Unable to connect to db".mysqli_error($con));
        exit();
    }

    $query = "SELECT * FROM ProfessorReviews WHERE ID='$ID';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Unable to query".mysqli_error($con));
        exit();
    }

    if (mysqli_num_rows($result) != 1) {
        echo("Review doesn't exist");
        exit();
    }

    $query = "UPDATE ProfessorReviews SET Upvotes=Upvotes+1 WHERE ID='$ID';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed".mysqli_error($con));
        exit();
    }

    $query = "SELECT * FROM ProfessorReviews WHERE Professor='$Professor' ORDER BY ID DESC;";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed".mysqli_error($con));
        exit();
    }

    $msg = "";

    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_array($result)) {
            $msg .= "<div class='table-responsive table-bordered mb-5'>";
            $msg .= "<table class='table table-striped table-bordered'>";
            $msg .= "<tr><td><b>ID: </b>".$data['ID']."</td>";
            $msg .= "<td><b>Course: </b>".$data['Professor']."</td>";
            $msg .= "<td><b>Upvotes: </b>".$data['Upvotes']."</td>";
            $msg .= "<td><b>Downvotes: </b>".$data['Downvotes']."</td>";
            $msg .= "</tr></table>";
            $msg .= "<div class='col-12' style='height:20vh;'>".$data['Comment']."</div></div>";
        }
    } else {
        $msg = "No results found";
    }

    echo($msg);
    exit();
?>