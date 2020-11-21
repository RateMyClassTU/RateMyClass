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
        echo("<code>Database can not connect.(".mysqli_error($con).")</code>");
        header("location:../../home.php");
        exit();
    }

    $data = mysqli_fetch_array($result);
    
    if ($data['Credibility'] == 5) $Stars = "<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i>";
    else if ($data['Credibility'] == 4) $Stars = "<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='far fa-star'></i>";
    else if ($data['Credibility'] == 3) $Stars = "<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i>";
    else if ($data['Credibility'] == 2) $Stars = "<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i>";
    else if ($data['Credibility'] == 1) $Stars = "<i class='fas fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i>";
    else $Stars = "<i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i>";

    $msg = "<table width='100%'>
            <tr><td><b>Email :</b></td><td>".$data['Email']."</td></tr>
            <tr><td><b>First Name :</b></td><td>".$data['FirstName']."</td></tr>
            <tr><td><b>Last Name :</b></td><td>".$data['LastName']."</td></tr>
            </table>
            <hr>
            <table width='40%'>
            <tr><td><b>Posts :</b></td><td>".$data['Posts']."</td></tr>
            <tr><td><b>Upvotes :</b></td><td>".$data['Upvotes']."</td></tr>
            <tr><td><b>Downvotes :</b></td><td>".$data['Downvotes']."</td></tr>
            </table>
            <hr>
            <table width='50%'>
            <tr><td><b>Credibility :</b></td><td>".$Stars."</td></tr>
            </table>";

    echo($msg);
    exit();
?>