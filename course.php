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
                    <li class="nav-item">
                        <a id="reportBtn" class="nav-link" data-toggle="modal" href="#reportModal">
                            </span>Report Review</span>
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12" style="color: black">
                            <h1>Course</h1>
                            <div class="input-group">
                                <input id="courseSearch" class="bg-white form-control small" name="courseSearch" type="text" placeholder="Search for courses...">
                                <button id="clearCourse" class="btn-dark border-0" type="button">Clear</button>
                            </div>
                            <select id="courseSelect" class="form-control mt-2">
                                <option value='0' selected='true' disabled>Begin by starting a search</option>
                            </select>
                            <hr>
                            <div class="input-group">
                                <h1 class="bg-light form-control border-0">Results</h1>
                                <button id="addCourseBtn" class="btn btn-light" style="border:1px solid black; margin-right:10px;" data-toggle="modal" href="#addCourseModal">Add Courses</button>
                                <button id="courseUpvote" data-toggle="modal" class="btn btn-primary" style="width:50px; margin-right:10px;" href="#courseUpvoteModal" hidden><i class='far fa-thumbs-up'></i></button>
                                <button id="courseDownvote" data-toggle="modal" class="btn btn-danger" style="width:50px; margin-right:10px;" href="#courseDownvoteModal" hidden><i class='far fa-thumbs-down'></i></button>
                                <button id="courseReview" data-toggle="modal" class="btn-success border-0" style="width: 150px; border-radius: 0.75rem; display: none" href="#courseModal" type="button">Add Review</button>
                            </div>
                            <div id="courseContent" class="pl-3 mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <div id="addCourseModal" class="modal fade" role="dialog" style="color:black;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Course</h5>
                    <span class="close" data-dismiss="modal">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="container mb-3">
                        <label for="addCourseName">Course</label>
                        <input class="form-control" name="addCourseName" placeholder="Enter the name of the course">
                    </div>
                    <div class="container mt-3">
                        <label for="addCourseDesc">Course Description</label>
                        <input class="form-control" name="addCourseDesc" placeholder="Add a course description">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="addCourse" class="btn btn-primary" type="button">Submit</button>
                    <button class="btn btn-dark" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="courseModal" class="modal fade" role="dialog" style="color: black">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Course Review</h5>
                    <span class="close" data-dismiss="modal" type="button">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <input id="reviewCourse" class="form-control" disabled>
                    </div>
                    <textarea id="userReview" rows="10" class="form-control" wrap="hard" placeholder="Enter text here..."></textarea>
                </div>
                <div class="modal-footer">
                    <button id="addCourseReview" class="btn btn-danger" disabled>Add Review</button>
                    <button class="btn btn-dark" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="courseUpvoteModal" class="modal fade" role="dialog" style="color:black;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upvote</h5>
                    <span class="close" data-dismiss="modal" type="button">&times;</span>
                </div>
                <div class="modal-body">
                    <label for="upReviewID">Review ID</label>
                    <input class="form-control" name="upReviewID" placeholder="Enter the ID of the review to upvote">
                </div>
                <div class="modal-footer">
                    <button id="courseUpvoteBtn" class="btn btn-primary" type="button">Submit</button>
                    <button class="btn btn-dark" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="courseDownvoteModal" class="modal fade" role="dialog" style="color:black;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Downvote</h5>
                    <span class="close" data-dismiss="modal" type="button">&times;</span>
                </div>
                <div class="modal-body">
                    <label for="downReviewID">Review ID</label>
                    <input class="form-control" name="downReviewID" placeholder="Enter the ID of the review to downvote">
                </div>
                <div class="modal-footer">
                    <button id="courseDownvoteBtn" class="btn btn-primary" type="button">Submit</button>
                    <button class="btn btn-dark" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="reportModal" class="modal fade" role="dialog" style="color:black;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report a review</h5>
                    <span class="close" data-dismiss="modal" type="button">&times;</span>
                </div>
                <div class="modal-body">
                    <label for="courseID">Review ID</label>
                    <input id="courseID" class="form-control" placeholder="Enter the review id">
                    <br>
                    <label for="reportComment">Comment</label>
                    <textarea id="reportCommment" rows="10" class="form-control" wrap="hard" placeholder="Enter additional comments here"></textarea>
                </div>
                <div class="modal-footer">
                    <button id="reportSubmit" class="btn btn-danger" type="button">Submit</button>
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