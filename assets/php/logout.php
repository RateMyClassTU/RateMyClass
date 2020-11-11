<?php
    session_start();
    session_destroy(); // destroy session variables

    unset($_SESSION["regState"]);
    unset($_SESSION["Message"]);
    unset($_SESSION["Email"]);
    unset($_SESSION["refresh"]);

    header("location:../../index.php");
    exit();
?>