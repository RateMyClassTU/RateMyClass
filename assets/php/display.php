<?php
    session_start();
    require_once("config.php");

    $Email = $_SESSION["Email"];
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    
    if (!$con) {
        echo("error");
        header("location:../../home.php");
        exit();
    }

    $query = "SELECT * FROM User WHERE Email='$Email';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("error");
        header("location:../../home.php");
        exit();
    }

    $msg = "<table width='100%'>";

    while ($data = mysqli_fetch_array($result)) {
        $msg .= "<tr><td><b>Email :</b></td><td>".$data['Email']."</td></tr>";
        $msg .= "<tr><td><b>First Name :</b></td><td>".$data['FirstName']."</td></tr>";
        $msg .= "<tr><td><b>Last Name :</b></td><td>".$data['LastName']."</td></tr>";
    }

    $msg .= "</table>";

    echo($msg);
    exit();
?>