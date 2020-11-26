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

    $query = "SELECT * FROM BulletinUndergrad WHERE Description LIKE '%$Message%'
              UNION 
              SELECT * FROM BulletinGrad WHERE Description LIKE '%$Message%'
              UNION 
              SELECT * FROM BulletinUndergrad WHERE Course LIKE '$Message%'
              UNION 
              SELECT * FROM BulletinGrad WHERE Course LIKE '$Message%';";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo("<code>Query failed.(".mysqli_error($con).")</code>");
        header("location:../../home.php");
        exit();
    }

    if (mysqli_num_rows($result) > 0) {
        $msg = "<h1>Results</h1>";
        $msg .= "<table style='margin-top: 10px;'>";
        if (mysqli_num_rows($result) > 20) {
            for($i = 0; $i < 20; $i++) {
                $data = mysqli_fetch_array($result);
                $msg .= "<tr><td>".$data['Course']."</td></tr>";
            }
            $msg .= "</table>";
            echo($msg);
        } else {
            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                $data = mysqli_fetch_array($result);
                $msg .= "<tr><td>".$data['Course']."</td></tr>";
            }
            $msg .= "</table>";
            echo($msg);
        }
    } else {
        $msg = "No results found";
        echo($msg);
    }

    exit();
?>