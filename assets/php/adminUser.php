<?php
    session_start();
    require_once("config.php");

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Error");
        exit();
    }

    $query = "SELECT U.ID AS ID, U.Email AS Email, U.FirstName AS FirstName, U.LastName AS LastName, count(CR.Username)+count(PR.Username) AS Posts, IFNULL(sum(CR.Upvotes)+sum(PR.Upvotes), '0') AS Upvotes, IFNULL(sum(CR.Downvotes)+sum(PR.Downvotes), '0') AS Downvotes
              FROM Users U
              LEFT OUTER JOIN CourseReviews CR
              ON U.Email=CR.Username
              LEFT OUTER JOIN ProfessorReviews PR
              ON U.Email=PR.Username
              WHERE U.Status=0 || U.Status=1
              GROUP BY U.Email
              ORDER BY U.ID ASC;";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed. ".mysqli_error($con));
        exit();
    }

    $msg = "<div class='table-responsive'>";
    $msg .= "<table class='table table-bordered'>";
    $msg .= "<tr style='color:black; background-color:#f1f1f1;'><td><b>ID</b></td>";
    $msg .= "<td><b>Email</b></td>";
    $msg .= "<td><b>First Name</b></td>";
    $msg .= "<td><b>Last Name</b></td>";
    $msg .= "<td><b>Posts</b></td>";
    $msg .= "<td><b>Upvotes</b></td>";
    $msg .= "<td><b>Downvotes</b></td></tr>";
    while ($data = mysqli_fetch_array($result)) {
        $msg .= "<tr><td>".$data['ID']."</td>";
        $msg .= "<td>".$data['Email']."</td>";
        $msg .= "<td>".$data['FirstName']."</td>";
        $msg .= "<td>".$data['LastName']."</td>";
        $msg .= "<td>".$data['Posts']."</td>";
        $msg .= "<td>".$data['Upvotes']."</td>";
        $msg .= "<td>".$data['Downvotes']."</td></tr>";
    }
    $msg .= "</table></div>";

    echo($msg);
    exit();

?>