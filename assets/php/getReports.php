<?php
    session_start();
    require_once("config.php");
    
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Unable to connect".mysqli_error($con));
        exit();
    }

    $query = "SELECT * FROM Users ORDER BY Reported DESC;";
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
        $msg .= "<td>".$data['Reported']."</td>";
    }

    $msg .= "</table></div>";

    echo($msg);
    exit();
?>