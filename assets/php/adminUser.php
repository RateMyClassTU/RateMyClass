<?php
    session_start();
    require_once("config.php");

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Error");
        exit();
    }

    $query = "SELECT * FROM User WHERE Status > 0 && Status < 2;";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed.".mysqli_error($con));
        exit();
    }

    $msg = "<table border=1 class='text-center' style='background-color:white'>";
    $msg .= "<tr><td style='width:100px; background-color:rgb(241,241,241);'><b>ID</b></td><td style='width:300px; background-color:rgb(241,241,241);'><b>Email</b></td>";
    $msg .= "<td style='width:150px; background-color:rgb(241,241,241);'><b>First Name</b></td><td style='width:150px; background-color:rgb(241,241,241);'><b>Last Name</b></td>";
    $msg .= "<td style='width:300px; background-color:rgb(241,241,241);'><b>Actions</b></td></tr>";
    while ($data = mysqli_fetch_array($result)) {
        $msg .= "<tr><td style='width:100px;'>".$data['ID']."</td><td class='text-left pl-2' style='width:300px;'>".$data['Email']."</td>";
        $msg .= "<td style='width:150px;'>".$data['FirstName']."</td><td style='width:150px;'>".$data['LastName']."</td>";
        $msg .= "<td style='width:300px;'><div class='col-12'>";
        $msg .= "<ul class='nav'><li class='nav-item'><a id='".$data['ID']."' class='nav-link manageBtn' href='#'>Manage</a></li>";
        $msg .= "<li id='".$data['ID']."' class='nav-item'><a class='nav-link deleteBtn' href='#'>Delete</a></li></ul>";
        $msg .= "</div></td></tr>";
    }
    $msg .= "</table>";

    echo($msg);
    exit();

?>