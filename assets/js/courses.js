$(document).ready(function() {

    // clear the search bar
    $("#clearCourse").click(function() {
        $("#courseSearch").val("");
        $("#courseSelect").empty();
        $("#courseSelect").append("<option value='0' selected='true' disabled>Begin by starting a search</option>");
        $("#courseContent").html("");
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
                alert("Successfully added review");
                
            }
        }).fail(function(error) {
            console.error('Unable to add reivew into database', error);
        });
    });
});

