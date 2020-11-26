<?php
    session_start();
    require_once("config2.php");

    $Department = $_POST["Department"];
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("<code>Database can not connect.(".mysqli_error($con).")</code>");
        header("location:../../home.php");
        exit();
    }

    $query = "SELECT Course FROM BulletinUndergrad WHERE Department='$Department';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("<code>Query failed.(".mysqli_error($con).")</code>");
        header("location:../../home.php");
        exit();
    }

    $course = array();

    while ($data = mysqli_fetch_array($result)) {
        $course[] = array("Course" => $data["Course"]);
    }

    echo json_encode($course);

?>