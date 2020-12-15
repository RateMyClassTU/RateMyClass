<?php
    session_start();
    require_once("config.php");
    
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Unable to connect".mysqli_error($con));
        exit();
    }

    $query = "SELECT U.ID AS ID, U.Email AS Email, U.FirstName AS FirstName, U.LastName AS LastName, IFNULL(count(R.UID), '0') AS Reports
              FROM Users U
              LEFT OUTER JOIN Reports R
              ON U.ID=R.UID
              GROUP BY ID
              ORDER BY Reports DESC;";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed".mysqli_error($con));
        exit();
    }

    $msg = "<div class='table-responsive'>";
    $msg .= "<table class='table table-bordered'>";
    $msg .= "<tr style='color:black; background-color:#f1f1f1;'>";
    $msg .= "<td><b>ID</b></td>";
    $msg .= "<td><b>Email</b></td>";
    $msg .= "<td><b>First Name</b></td>";
    $msg .= "<td><b>Last Name</b></td>";
    $msg .= "<td><b>Reports</b></td>";

    while ($data = mysqli_fetch_array($result)) {
        $msg .= "<tr><td>".$data['ID']."</td>";
        $msg .= "<td>".$data['Email']."</td>";
        $msg .= "<td>".$data['FirstName']."</td>";
        $msg .= "<td>".$data['LastName']."</td>";
        $msg .= "<td>".$data['Reports']."</td>";
    }

    $msg .= "</table></div>";

    echo($msg);
    exit();
?>