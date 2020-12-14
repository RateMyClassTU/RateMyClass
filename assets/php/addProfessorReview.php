<?php
    session_start();
    require_once("config.php");

    $Professor = $_POST["Professor"];
    $Comment = $_POST["Comment"];
    $Email = $_SESSION["Email"];

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Unable to connect to database".mysqli_error($con));
        header("location:../../professor.php");
        exit();
    }

    //initial post of professor review
    $query = "INSERT INTO ProfessorReviews (Professor, Comment, Username, Upvotes, Downvotes) VALUES ('$Professor', '$Comment', '$Email', 0, 0);";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Unable to complete query".mysqli_error($con));
        header("location:../../professor.php");
        exit();
    }

    $query = "SELECT * FROM ProfessorReviews WHERE Professor='$Professor' ORDER BY ID DESC;";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed.(".mysqli_error($con));
        header("location:../../professor.php");
        exit();
    }
    $msg = "";

    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_array($result)) {
            $msg .= "<div class='table-responsive table-bordered mb-5'>";
            $msg .= "<table class='table table-striped table-bordered'>";
            $msg .= "<tr><td><b>Professor: </b>".$data['Professor']."</td>";
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