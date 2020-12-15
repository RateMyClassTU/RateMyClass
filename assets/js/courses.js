$(document).ready(function() {

    // clear the search bar
    $("#clearCourse").click(function() {
        $("#courseSearch").val("");
        $("#courseSelect").empty();
        $("#courseSelect").append("<option value='0' selected='true' disabled>Begin by starting a search</option>");
        $("#courseContent").html("");
        $("#courseReview").hide();
        $("#courseUpvote").attr("hidden", "hidden");
        $("#courseDownvote").attr("hidden", "hidden");     
    })

    // search a course
    $("#courseSearch").keyup(function() {
        if ($(this).val() != "") {
            var formData = {
                "Message": $("input[name=courseSearch").val()
            };
            $.ajax({
                type: "POST",
                url: "assets/php/getCourse.php",
                data: formData,
                dataType: "json",
                success: function(data) {
                    var len = data.length;
                    $("#courseSelect").empty();
                    if (len > 1) {
                        $("#courseSelect").append("<option value='0' selected='true' disabled>Are any of these what you're looking for?</option>");
                        for (var i = 0; i < len; i++) {
                            var course = data[i]['Course'];
                            $("#courseSelect").append("<option value='"+course+"'>"+course+"</option>");
                        }
                    } else if (len == 1) {
                        var course = data[0]['Course'];
                        $("#courseSelect").append("<option value='0' selected='true' disabled>Match found</option>");
                        $("#courseSelect").append("<option value='"+course+"'>"+course+"</option>");
                    } else {
                        $("#courseSelect").append("<option value='0' selected='true' disabled>No matches found. Please try again!</option>");
                    }
                }
            }).fail(function(error) {
                console.log('Unable to load course data', error);
            });
        } else {
            // search is cleared
            $("#courseSelect").empty();
            $("#courseSelect").append("<option value='0' selected='true' disabled>Begin by searching up a course</option>");
        }
    });

    $("#courseSelect").change(function() {
        var formData = {
            "Message": $(this).val()
        };
        $.ajax({
            type: "POST",
            url: "assets/php/courseReview.php",
            data: formData,
            dataType: "html",
            success: function(data) {
                $("#courseContent").html(data);
                $("#courseReview").show();
                $("#courseUpvote").removeAttr("hidden");
                $("#courseDownvote").removeAttr("hidden");
            }
        }).fail(function(error) {
            console.error('Unable to load results', error);
        });
    });

    $("#courseReview").click(function() {
        var Course = $("#courseSelect").val();
        $("#reviewCourse").val(Course);
    });

    $("#userReview").keyup(function() {
        if ($("#userReview").val() != '') {
            $("#addCourseReview").removeAttr("disabled");
        } else {
            $("#addCourseReview").attr("disabled", "disabled");
        }
    });

    $("#addCourseReview").click(function() {
        var formData = {
            "Course": $("#courseSelect").val(),
            "Comment": $("#userReview").val()
        };
        $.ajax({
            type: "POST",
            url: "assets/php/addCourseReview.php",
            data: formData,
            dataType: "text",
            success: function(data) {
                $("#courseModal").modal("toggle");
                $("#courseContent").html(data);
            }
        }).fail(function(error) {
            console.error('Unable to add reivew into database', error);
        });
    });

    $("#addCourseBtn").click(function() { // modal button
        $("input[name=addCourseName]").val("");
        $("input[name=addCourseDesc]").val("");
    })

    $("#addCourse").click(function() { // add course
        if ($("input[name=addCourseName]").val() == "") {
            alert("Enter a course name and try again");
            return;
        }

        var formData = {
            "courseName": $("input[name=addCourseName]").val(),
            "courseDesc": $("input[name=addCourseDesc]").val()
        };

        $.ajax({
            type: "POST",
            url: "assets/php/addCourse.php",
            data: formData,
            dataType: "text",
            success: function(data) {
                alert(data);
            }
        }).fail(function(error) {
            console.error('Unable to process', error);
        });
    });

    // upvote and downvote modal refresh
    $("#courseUpvote").click(function() {
        $("input[name=upReviewID]").val("");
    })

    $("#courseDownvote").click(function() {
        $("input[name=downReviewID]").val("");
    })

    // upvote button
    $("#courseUpvoteBtn").click(function() {
        if ($("input[name=upReviewID]").val() == "") {
            alert("Enter the review id");
            return;
        }

        var formData = {
            "Course": $("#courseSelect").val(),
            "ID": $("input[name=upReviewID]").val()
        };

        $.ajax({
            type: "POST",
            url: "assets/php/courseUpvote.php",
            data: formData,
            dataType: "text",
            success: function(data) {
                $("#courseUpvoteModal").modal("toggle");
                $("#courseContent").html(data);
            }
        }).fail(function(error) {
            console.error('Unable to process', error);
        });

    });

    $("#courseDownvoteBtn").click(function() {
        if ($("input[name=downReviewID]").val() == "") {
            alert("Enter the review id");
            return;
        }

        var formData = {
            "Course": $("#courseSelect").val(),
            "ID": $("input[name=downReviewID]").val()
        };

        $.ajax({
            type: "POST",
            url: "assets/php/courseDownvote.php",
            data: formData,
            dataType: "text",
            success: function(data) {
                $("#courseDownvoteModal").modal("toggle");
                $("#courseContent").html(data);
            }
        }).fail(function(error) {
            console.error('Unable to process', error);
        });
    });

    // REPORT BUTTONS

    $("#reportBtn").click(function() { // clear the modal
        $("#courseID").val("");
        $("#reportComment").val("");
    });

    $("#reportSubmit").click(function() {
        if ($("#courseID").val() == "") {
            alert("Enter a review id and try again");
            return;
        }

        var formData = {
            "ID": $("#courseID").val(),
            "Comment": $("#reportComment").val()
        };

        $.ajax({
            type: "POST",
            url: "assets/php/courseReport.php",
            data: formData,
            dataType: "text",
            success: function(data) {
                alert(data);
                $("#reportModal").modal("toggle");
            }
        }).fail(function(error) {
            console.error("Unable to process request", error);
        });
    });
});

