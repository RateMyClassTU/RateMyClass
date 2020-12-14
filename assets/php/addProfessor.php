<?php
    session_start();
    require_once("config.php");

    $professor = $_POST["professor"];
    $Email = $_SESSION["Email"];

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Unable to connect to db".mysqli_error($con));
        exit();
    }

    $Udatetime = date("Y-m-d H:i:s");

    $query = "SELECT * FROM AddedProfessors WHERE Professor LIKE '$professor%';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Unable to query".mysqli_error($con));
        exit();
    }

    if (mysqli_num_rows($result) != 0) {
        echo("Professor alread exists");
        exit();
    }

    $query = "INSERT INTO AddedProfessors (Professor, Username, Udatetime) VALUES ('$professor', '$Email', '$Udatetime');";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("query failed".mysqli_error($con));
        exit();
    }

    echo("Professor added into database");
    exit();
?>