<?php
    session_start();
    require_once("config.php");

    $Message = $_POST["Message"];
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("<code>Database can not connect.(".mysqli_error($con).")</code>");
        header("location:../../home.php");
        exit();
    }

    //get professors from AddedProfessors table
    $query = "SELECT Professor
              FROM AddedProfessors
              WHERE Professor
              LIKE '$Message%';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("<code>Query failed.(".mysqli_error($con).")</code>");
        header("location:../../home.php");
        exit();
    }

    $professor = array();

    //send array in a json format
    while ($data = mysqli_fetch_array($result)) {
        $professor[] = array("Professor" => $data["Professor"]);
    }

    echo json_encode($professor);

?>