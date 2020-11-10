<?php
    session_start();
    $_SESSION["regState"] = 1;
    $_SESSION["Message"] = "";
    header("location:../../index.php");
    exit();
?>