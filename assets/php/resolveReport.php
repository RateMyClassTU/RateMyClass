<?php
    session_start();
    require_once("config.php");

    $ID = $_POST["ID"];
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Can't connect to database - ".mysqli_error($con));
        exit();
    }

    $query = "UPDATE Reports SET Resolved=1 WHERE ID='$ID';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed - ".mysqli_error($con));
        exit();
    }

    echo("Successfully resolved report");
    exit();
?>