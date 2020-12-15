<?php
    session_start();
    require_once("config.php");

    $Review = $_POST["ID"];
    $Comment = $_POST["Comment"];
    $Email = $_SESSION["Email"];

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Can't connect to database".mysqli_error($con));
        exit();
    }

    // find reported id
    $query = "SELECT U.ID AS RUID FROM Users U
              LEFT OUTER JOIN CourseReviews CR
              ON CR.Username=U.Email
              WHERE CR.ID='$Review';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed".mysqli_error($con));
        exit();
    }

    if (mysqli_num_rows($result) != 1) {
        echo("no match found, try again");
        exit();
    }

    $data = mysqli_fetch_array($result);
    $RUID = $data["RUID"]; // store the reported users id

    // find my id
    $query = "SELECT ID FROM Users WHERE Email='$Email';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("error".mysqli_error($con));
        exit();
    }

    if (mysqli_num_rows($result) != 1) {
        echo("Please re-log");
        exit();
    }

    $data = mysqli_fetch_array($result);
    $UID = $data["ID"];
    
    $Rdatetime = date("Y-m-d H:i:s");

    $query = "INSERT INTO Reports (UID, RUID, Comment, Rdatetime) VALUES ('$UID', '$RUID', '$Comment', '$Rdatetime');";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed".mysqli_error($con));
        exit();
    }

    echo("Thanks for your feedback");
    exit();
?>