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
    <title>Rate My Class | Courses</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="apple-touch-icon" href="assets/img/favicon/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="assets/img/favicon/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="assets/img/favicon/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="assets/img/favicon/site.webmanifest">
    <!--<link rel=”stylesheet” href=”css/bootstrap-star-rating/star-rating.css” media=”all” rel=”stylesheet” type=”text/css”/>-->
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
                        <a class="nav-link" href="home.php">
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
                    <?php
                        if ($_SESSION["admin"] == 1) {
                    ?>
                    <li class="nav-item">
                        <a id="adminBtn" class="nav-link" href="#">
                            <span>Admin Panel</span>
                        </a>
                    </li>
                    <?php
                        }
                    ?>
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
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="nav-link" aria-expanded="false" href="assets/php/logout.php">
                                        <span class="d-sm-inline mr-2 text-gray-600 small">Logout</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <!-- To Actually search for a professor -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12" style="color: black">

                            <h1>Professor</h1>
                            <div class="input-group">
                                <input id="pSearch" class="bg-white form-control small" name="pSearch" type="text" placeholder="Search for professors...">
                                <button id="clearP" class="btn-dark border-0" type="button">Clear</button>
                            </div>
                            <select id="pSelect" class="form-control mt-2">
                                <option value='0' selected='true' disabled>Begin by starting a search</option>
                            </select>
                            <hr>
                            <!--
                            <h1 class="bg-light form-control border-0">Statistics</h1>
                            
                            <!-- Show stats here --\>
                            <div id="pStats"class="pl-3 mt-3"></div>

                            <div id="pPlots"class="pl-3 mt-3">
                                <span>
                                <img src="assets/img/plots/prof1/prof1TeachingRating.png" width="400" height="300">
                                <img src="assets/img/plots/prof1/prof1GradingDifficulty.png" width="400" height="300">
                                </span>
                            </div>

                            <br><br>
                            -->
                            <div class="input-group">                         
                                <h1 class="bg-light form-control border-0">Results</h1>
                                <button id="addProfessor" data-toggle="modal" class="btn btn-light" style="border:1px solid black; margin-right:10px" href="#addProfessorModal">Add Professor</button>
                                <button id="pUpvote" data-toggle="modal" class="btn btn-primary" style="width:50px; margin-right:10px;" href="#pUpvoteModal" hidden><i class='far fa-thumbs-up'></i></button>
                                <button id="pDownvote" data-toggle="modal" class="btn btn-danger" style="width:50px; margin-right:10px;" href="#pDownvoteModal" hidden><i class='far fa-thumbs-down'></i></button>
                                <button id="pReview" data-toggle="modal" class="btn-success border-0" style="width: 150px; border-radius: 0.75rem; display: none" href="#pModal" type="button">Add Review</button>
                            </div>
                            <div id="pContent" class="pl-3 mt-3"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- To View User Account -->
    <div id="accountModal" class="modal fade" role="dialog" style="color: black">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <span>My Account</span>
                        <button id="settingBtn" class="border-0" style="background-color:#0000; color:grey;"><i class="fas fa-cog"></i></i></button>
                    </h5>
                    <span class="close" data-dismiss="modal">&times;</span>
                </div>
                <div id="accountInfo" class="modal-body"></div>
                <div class="modal-footer">
                    <input type="password" class="form-control" name="oldPassword" placeholder="Old password goes here" hidden>
                    <input type="password" class="form-control" name="newPassword" placeholder="Enter new password here" hidden>
                    <button id="submitChange" class="btn btn-primary" type="button" hidden>Save Changes</button>
                    <button class="btn btn-dark" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>

<!-- this modal is for adding a professor review -->
    <div id="pModal" class="modal fade" role="dialog" style="color: black">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Professor Review</h5>
                    <span class="close" data-dismiss="modal" type="button">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <input id="reviewP" class="form-control" disabled>
                    </div>
                    <br>
                    <input id="reviewCourseCode" class="bg-white form-control small" name="reviewCourseCode" type="text" placeholder="Enter Course Code. Eg. CIS 1001">
                    <br>
                    
                    <input id="reviewCourseName" class="bg-white form-control small" name="reviewCourseName" type="text" placeholder="Enter Course Name. Eg. Intro to Computer Science Studies">
                    <br>

                    <input id="reviewTeaching" class="bg-white form-control small" name="reviewTeaching" type="number" placeholder="Enter teaching rating (1-5) stars">
                    <br>

                    <input id="reviewGrading" class="bg-white form-control small" name="reviewGrading" type="number" placeholder="Enter grading difficulty (1-5) stars">
                    <br>

                    <textarea id="userReview" rows="10" class="form-control" wrap="hard" placeholder="Enter text here..."></textarea>
                </div>
                <div class="modal-footer">
                    <button id="addPReview" class="btn btn-danger" disabled>Add Review</button>
                    <button class="btn btn-dark" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="pUpvoteModal" class="modal fade" role="dialog" style="color:black;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upvote</h5>
                    <span class="close" data-dismiss="modal" type="button">&times;</span>
                </div>
                <div class="modal-body">
                    <label for="puID">Review ID</label>
                    <input class="form-control" id="puID" placeholder="Enter the ID of the review to upvote">
                </div>
                <div class="modal-footer">
                    <button id="pUpvoteBtn" class="btn btn-primary" type="button">Submit</button>
                    <button class="btn btn-dark" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="pDownvoteModal" class="modal fade" role="dialog" style="color:black;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Downvote</h5>
                    <span class="close" data-dismiss="modal" type="button">&times;</span>
                </div>
                <div class="modal-body">
                    <label for="pdID">Review ID</label>
                    <input class="form-control" id="pdID" placeholder="Enter the ID of the review to upvote">
                </div>
                <div class="modal-footer">
                    <button id="pUpvoteBtn" class="btn btn-primary" type="button">Submit</button>
                    <button class="btn btn-dark" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="addProfessorModal" class="modal fade" role="dialog" style="color:black;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Professor</h5>
                    <span class="close" data-dismiss="modal" type="button">&times;</span>
                </div>
            </div>
            <div class="modal-body">
                <label for="professorName">Professor Name</label>
                <input id="professorName" class="form-control" placeholder="Enter the professor's name">
            </div>
            <div class="modal-footer">
                <button id="addProfessorBtn" class="btn btn-primary" type="button">Submit</button>
                <button class="btn btn-dark" data-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/buttons.js"></script>
    <script src="assets/js/professors.js"></script>
    <!--<script src=”js/bootstrap-star-rating/star-rating.js” type=”text/javascript”></script>-->
</body>

</html>