<?php
    session_start();
    require_once("config.php");

    $ID = $_POST["ID"];
    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        echo("Unable to connect to database - ".mysqli_error($con));
        exit();
    }

    $query = "SELECT * FROM Reports WHERE UID='$ID' AND Resolved=0 ORDER BY Rdatetime DESC;";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("Query failed - ".mysqli_error($con));
        exit();
    }

    if (mysqli_num_rows($result) == 0) {
        echo("No results found");
        exit();
    }

    $msg = ""; // initialize msg variable

    while ($data = mysqli_fetch_array($result)) {
        $msg .= "<div class='table-responsive table-bordered mb-5'>
                 <table class='table table-striped table-bordered'>
                 <tr><td><b>ID: </b>".$data["ID"]."</td>
                 <td><b>Report date: </b>".$data["Rdatetime"]."</td>
                 </tr></table>
                 <div class='col-12' style='height:15vh;'>".$data["Comment"]."</div></div>";
    }

    echo($msg);
    exit();
?>