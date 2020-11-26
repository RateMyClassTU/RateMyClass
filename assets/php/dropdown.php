<?php
    session_start();
    require_once("config2.php");

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("<code>Database can not connect.(".mysqli_error($con).")</code>");
        header("location:../../home.php");
        exit();
    }

    $query = "SELECT Department FROM BulletinUndergrad GROUP BY Department ORDER BY Department ASC;";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("<code>Query failed.(".mysqli_error($con).")</code>");
        header("location:../../home.php");
        exit();
    }

    $department = array();

    while ($data = mysqli_fetch_array($result)) {
        $department[] = array("Department" => $data["Department"]);
    }

    echo json_encode($department);

?>