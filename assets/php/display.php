<?php
    session_start();
    require_once("config.php");

    $Email = $_SESSION["Email"];
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    
    if (!$con) {
        echo("<code>Database can not connect.(".mysqli_error($con).")</code>");
        header("location:../../home.php");
        exit();
    }

    $query = "SELECT U.Email AS Email, U.FirstName AS FirstName, U.LastName AS LastName, count(CR.Username) AS Posts, IFNULL(sum(CR.Upvotes), '0') AS Upvotes, IFNULL(sum(CR.Downvotes), '0') AS Downvotes
              FROM Users U
              LEFT OUTER JOIN CourseReviews CR
              ON U.Email=CR.Username
              WHERE U.Email='$Email';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("<code>Database can not connect.(".mysqli_error($con).")</code>");
        header("location:../../home.php");
        exit();
    }

    $data = mysqli_fetch_array($result);
    $totalVotes = $data['Upvotes'] + $data['Downvotes'];
    $credibility = $data['Upvotes'] / $totalVotes;

    # half star # <i class='fas fa-star-half-alt'></i>
    # empty star # <i class='far fa-star'></i>
    # full star # <i class='fas fa-star'></i>

    if ($credibility == 1) { // 5
        $Stars = "<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i>";
    } else if ($credibility < 1 && $credibility >= 0.9) { // 4.5
        $Stars = "<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star-half-alt'></i>";
    } else if ($credibility < 0.9 && $credibility >= 0.8) { // 4
        $Stars = "<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='far fa-star'></i>";
    } else if ($credibility < 0.8 && $credibility >= 0.7) { // 3.5
        $Stars = "<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star-half-alt'></i><i class='far fa-star'></i>";
    } else if ($credibility < 0.7 && $credibility >= 0.6) { // 3
        $Stars = "<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i>";
    } else if ($credibility < 0.6 && $credibility >= 0.5) { // 2.5
        $Stars = "<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star-half-alt'></i><i class='far fa-star'></i><i class='far fa-star'></i>";
    } else if ($credibility < 0.5 && $credibility >= 0.4) { // 2
        $Stars = "<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i>";
    } else if ($credibility < 0.4 && $credibility >= 0.3) { // 1.5
        $Stars = "<i class='fas fa-star'></i><i class='fas fa-star-half-alt'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i>";
    } else if ($credibility < 0.3 && $credibility >= 0.2) { // 1
        $Stars = "<i class='fas fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i>";
    } else if ($credibility < 0.2 && $credibility >= 0.1) { // 0.5
        $Stars = "<i class='fas fa-star-half-alt'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i>";
    } else {
        $Stars = "<i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i>";
    }

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