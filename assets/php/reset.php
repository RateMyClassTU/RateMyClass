<?php
    session_start();
    $_SESSION["regState"] = 2;
    $_SESSION["Message"] = "";
    header("location:../../index.php");
?>