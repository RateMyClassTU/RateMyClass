<?php
    session_start();

    if (!isset($_SESSION["regState"])) $_SESSION["regState"] = 0;
    if (!isset($_SESSION["loggedIn"])) $_SESSION["loggedIn"] = 0;
    if (!isset($_SESSION["admin"])) $_SESSION["admin"] = 0;

    if ($_SESSION["loggedIn"] != 1) header("location:index.php");
    if ($_SESSION["admin"] != 1) header("location:home.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Rate My Class</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Amazon%20Ember.css">
    <link rel="stylesheet" href="assets/css/Amazon%20Ember%20Bold.css">
    <link rel="stylesheet" href="assets/css/Amazon%20Ember%20Light.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body id="page-top" style="font-family: 'Amazon Ember';">
    <nav class="navbar navbar-dark navbar-expand-md sticky-top bg-dark">
        <div class="container-fluid"><a class="navbar-brand js-scroll-trigger" href="#page-top">Rate My Class</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav d-flex flex-grow-1 justify-content-end">
                    <li class="nav-item"><a class="nav-link" href="home.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" id="adminBtn" href="admin.php">Admin Panel</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1 id="consoleHeader" style="font-size: 42px;font-family: 'Amazon Ember Light';">Console</h1>
    </div>
    <div class="container mt-3">
        <div class="card">
            <h1 id="serviceHeader" style="font-family: 'Amazon Ember Bold';font-size: 24px;">Services</h1>
            <div class="card-body" style="font-size: 14px;">
                <div id="serviceTab" class="row">
                    <div class="d-flex flex-grow-1 justify-content-center col-6" style="font-size: 15px;font-family: 'Amazon Ember Light';">
                        <a id="manageUserBtn" href="#">Manage Users</a>
                    </div>
                    <div class="d-flex flex-grow-1 justify-content-center col-6" style="font-size: 15px;font-family: 'Amazon Ember Light';">
                        <a id="manageAdminBtn" href="#">Manage Admins</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="col-12">
            <div id="adminContent"></div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/admin.js"></script>
</body>

</html>