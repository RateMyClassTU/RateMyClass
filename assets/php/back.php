<?php
    session_start();
    $_SESSION["regState"] = 0;
    $_SESSION["Message"] = "";
    header("location:../../index.php");
?>