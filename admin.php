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
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body id="page-top" style="font-family: 'Amazon Ember';">
    <nav class="navbar navbar-dark navbar-expand-md sticky-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Rate My Class</a>
            <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav d-flex flex-grow-1 justify-content-end align-items-end">
                    <li class="nav-item"><a class="nav-link" href="home.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" id="adminBtn" href="admin.php">Admin Panel</a></li>
                    <li class="nav-item"><a class="nav-link" href="assets/php/logout.php">Logout</a></li>
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
                    <div class="d-flex flex-grow-1 justify-content-center col-6" style="font-size: 16px;font-family: 'Amazon Ember Light';">
                        <ul class="serviceGroup">
                            <li class="serviceLink">
                                <a id="showUserBtn" href="#">Show Users</a>
                            </li>
                            <li class="serviceLink">
                                <a id="showReportBtn" href="#">Check Reported Users</a>
                            </li>
                            <li class="serviceLink">
                                <a id="viewReport" href="#">View Reports</a>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex flex-grow-1 justify-content-center col-6" style="font-size: 16px;font-family: 'Amazon Ember Light';">
                        <ul class="serviceGroup">
                            <li class="serviceLink">
                                <a id="showAdminBtn" href="#">Show Admins</a>
                            </li>
                            <li class="serviceLink">
                                <a id="manageUserBtn" data-toggle="modal" href="#manageUser">Manage User</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div id="viewContainer" class="row mb-3" hidden>
            <div class="input-group col-3">
                <input id="UserId" class="form-control" placeholder="Enter user id">
                <button id="UserIdSearch" class="btn btn-light" style="border: 1px solid grey; border-radius: 0 0.25rem 0.25rem 0;">Search</button>
            </div>
            <div class="input-group col-3">
                <input id="ReviewId" class="form-control" placeholder="Review Id">
                <button id="ReviewIdBtn" class="btn btn-dark border-0" style="border-radius:0 0.25rem 0.25rem 0;">Resolve</button>
            </div>
            <div class="input-group col-3">
                <button id="DeactivateIdBtn" class="btn btn-danger border-0 ml-5">Deactivate</button>
            </div>

        </div>
        
        <div id="adminContent"></div>
    </div>
    <div id="manageUser" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Management</h5>
                    <span class="close" data-dismiss="modal">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <input id="userSearch" class="bg-white form-control small" type="text" placeholder="Email">
                        <button id="clearBtn" class="btn-dark border-0" type="button" style="width:75px;">Clear</button>
                    </div>
                    <div class="input-group">
                        <select id="userSelect" class="form-control">
                            <option value="0" selected="true">Search and select user</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <select id="actionSelect" class="form-control">
                            <option value="0" selected="true">Select action</option>
                            <option value="promoteUser">Promote</option>
                            <option value="demoteUser">Demote</option>
                            <option value="deleteUser">Delete</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="executeActionBtn" class="btn btn-danger" type="button">Execute</button>
                    <button class="btn btn-dark" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/admin.js"></script>
</body>

</html>