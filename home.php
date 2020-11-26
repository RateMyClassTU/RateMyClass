<?php
session_start();
if (!isset($_SESSION["regState"])) $_SESSION["regState"] = 0;
if (!isset($_SESSION["loggedIn"])) $_SESSION["loggedIn"] = 0;
if ($_SESSION["loggedIn"] != 1) header("location:index.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Rate My Class | Home</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="apple-touch-icon" href="assets/img/favicon/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="assets/img/favicon/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="assets/img/favicon/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="assets/img/favicon/site.webmanifest">
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon">
                        <img src="assets/img/favicon/favicon-32x32.png">
                    </div>
                    <div class="sidebar-brand-text mx-3">
                        <span>Rate My Class</span>
                    </div>
                </a>
                <hr class="sidebar-divider mt-2">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="explore.php">
                            <span>Explore</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="accountBtn" class="nav-link" data-toggle="modal" href="#accountModal">
                            <span>My Account</span>
                        </a>
                    </li>
                </ul>
                <div class="text-center d-none d-md-inline">
                    <button class="btn rounded-circle border-0 mt-5" id="sidebarToggle" type="button"></button>
                </div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button">
                            <i class="fas fa-bars"></i>
                        </button>
                        <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input id="search-msg" class="bg-light form-control border-0 small" name="search-msg" type="text" placeholder="Search...">
                                <div class="input-group-append">
                                    <button id="search-go" class="btn btn-primary py-0" data-toggle="modal" href="#searched" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
                                    <i class="fas fa-chevron-circle-down" style="color:#4E74DF"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right p-3 animated-grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto navbar-search w-100">
                                        <div class="input-group">
                                            <input id="searc-mMsg" class="bg-light form-control border-0 small" name="search-msg" type="text" placeholder="Search...">
                                            <div class="input-group-append">
                                                <button id="search-go" class="btn btn-primary py-0" data-toggle="modal" href="#searched" type="button">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <a class="nav-link" aria-expanded="false" href="assets/php/logout.php">
                                        <span class="mr-2 text-gray-600">Logout</span>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="nav-link" aria-expanded="false" href="assets/php/logout.php">
                                        <span class="d-none d-sm-inline mr-2 text-gray-600 small">Logout</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center main-body">
                            <div id="head-container">
                                <h1>Welcome to Rate My Class</h1>
                            </div>
                            <hr>
                            <div id="body-container">
                                <h3>At Rate My Class, we aim to provide a platform for students!</h3>
                                <span>
                                    Our objective is for students to view and post reviews about courses and
                                    professors across different Temple departments.
                                </span>
                                <br>
                                <span>Picking classes has never been easier</span>
                            </div>
                            <div class="row justify-content-center mt-5">
                                <div class="col-4 feature-box">
                                    <a id="courseToggleBtn" data-toggle="modal" href="#courseModal">
                                        <h4>Courses</h4>
                                    </a>
                                    <p>Search for a course by category</p>
                                </div>
                                <div class="col-4 feature-box">
                                    <a id="professorToggleBtn" data-toggle="modal" href="#professorModal">
                                        <h4>Professors</h4>
                                    </a>
                                    <p>Check out what students are saying about professors</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="courseModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Course Selection</h5>
                    <span class="close" data-dismiss="modal">&times;</span>
                </div>
                <div class="modal-body">
                    <label for="collegeSelect">Majors:</label><br>
                    <select id="collegeSelect"></select><br><br>
                    <label for="courseSelect">Courses:</label><br>
                    <select id="courseSelect"></select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" data-dismiss="modal" type="button">Close</button>
                    <button id="goBtn" class="btn btn-danger" type="button" disabled>Go</button>
                </div>
            </div>
        </div>
    </div>
    <div id="professorModal" class="modal fade" role="dialog" style="color: black">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Professor Lookup</h5>
                    <span class="close" data-dismiss="modal">&times;</span>
                </div>
                <div class="modal-body">
                    <span>Search reviews for professors here</span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="accountModal" class="modal fade" role="dialog" style="color: black">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">My Account</h5>
                    <span class="close" data-dismiss="modal">&times;</span>
                </div>
                <div id="accountInfo" class="modal-body"></div>
                <div class="modal-footer">
                    <button class="btn btn-dark" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="searched" class="modal fade" role="dialog" style="color: black">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Results</h5>
                    <span class="close" data-dismiss="modal">&times;</span>
                </div>
                <div id="search-content" class="modal-body"></div>
                <div class="modal-footer">
                    <button class="btn btn-dark" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/buttons.js"></script>
    <script src="assets/js/courses.js"></script>
</body>

</html>