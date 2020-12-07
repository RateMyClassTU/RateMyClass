<?php
    session_start();
    require_once("config.php");

    $User = $_POST["User"];
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Failed to connect db".mysqli_error($con));
        exit();
    }

    $query = "SELECT * FROM Users WHERE Email LIKE '%$User%';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed".mysqli_error($con));
        exit();
    }

    $user = array();

    while ($data = mysqli_fetch_array($result)) {
        $user[] = array("User" => $data["Email"]);
    }
    
    echo json_encode($user);
    
?>