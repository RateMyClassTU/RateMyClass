$(document).ready(function () {

    // clear the search bar
    $("#clearP").click(function () {
        $("#pSearch").val("");
        $("#pSelect").empty();
        $("#pSelect").append("<option value='0' selected='true' disabled>Begin by starting a search</option>");
        $("#pContent").html("");
        $("#pReview").hide();
        $("#pUpvote").attr("hidden", "hidden");
        $("#pDownvote").attr("hidden", "hidden");
    })

    // search a professor
    $("#pSearch").keyup(function () {
        if ($(this).val() != "") {
            var formData = {
                "Message": $("input[name=pSearch").val()
            };
            $.ajax({
                type: "POST",
                url: "assets/php/getProfessor.php",
                data: formData,
                dataType: "json",
                success: function (data) {
                    var len = data.length;
                    $("#pSelect").empty();
                    if (len > 1) {
                        $("#pSelect").append("<option value='0' selected='true' disabled>Are any of these what you're looking for?</option>");
                        for (var i = 0; i < len; i++) {
                            var professor = data[i]['Professor']; //from table column
                            $("#pSelect").append("<option value='" + professor + "'>" + professor + "</option>");
                        }
                    } else if (len == 1) {
                        var professor = data[0]['Professor'];
                        $("#pSelect").append("<option value='0' selected='true' disabled>Match found</option>");
                        $("#pSelect").append("<option value='" + professor + "'>" + professor + "</option>");
                    } else {
                        $("#pSelect").append("<option value='0' selected='true' disabled>No matches found. Please try again!</option>");
                    }
                }
            }).fail(function (error) {
                console.log('Unable to load professor data', error);
            });
        } else {
            // search is cleared
            $("#pSelect").empty();
            $("#pSelect").append("<option value='0' selected='true' disabled>Begin by searching up a professor</option>");
        }
    });

    //Fetch professor review comments into professor.php
    $("#pSelect").change(function () {
        var formData = {
            "Message": $(this).val()
        };

        $.ajax({
            type: "POST",
            url: "assets/php/professorReview.php",
            data: formData,
            dataType: "html",
            success: function (data) {
                $("#pContent").html(data);
                $("#pReview").show();
                $("#pStatBtn").show();
                $("#pUpvote").removeAttr("hidden");
                $("#pDownvote").removeAttr("hidden");
            }
        }).fail(function (error) {
            console.error('Unable to load results', error);
        });

        $.ajax({
            type: "POST",
            url: "assets/php/pStatCalc.php",
            data: formData,
            dataType: "html",
            success: function (data) {
                $("#pStats").html(data);
            }
        }).fail(function (error) {
            console.error('Unable to load results', error);
        });


    });

    //Puts the name of professor to review into the "add a review" modal
    $("#pReview").click(function () {
        var Professor = $("#pSelect").val();
        $("#reviewP").val(Professor);
    });


    $("#userReview").keyup(function () {
        if ($("#userReview").val() != '') {
            $("#addPReview").removeAttr("disabled");
        } else {
            $("#addPReview").attr("disabled", "disabled");
        }
    });

    //Store new professor review from modal into the database
    $("#addPReview").click(function () { //this button is within the modal
        var formData = { //from professor.php
            "Professor": $("#pSelect").val(), //profesor name all ids in the modal
            "Comment": $("#userReview").val(), //comment
            "courseCode": $("#reviewCourseCode").val(), //course code
            "courseName": $("#reviewCourseName").val(), //course name
            "teaching": $("#reviewTeaching").val(), //teaching rating
            "grading": $("#reviewGrading").val() //grading difficulty
        };
        $.ajax({
            type: "POST",
            url: "assets/php/addProfessorReview.php", //send to
            data: formData, //send
            dataType: "text",
            success: function (data) {
                $("#pModal").modal("toggle");
                $("#pContent").html(data); //recieve

            }
        }).fail(function (error) {
            console.error('Unable to add review into database', error);
        });
    });

    // upvote and downvote modal refresh
    $("#pUpvote").click(function () {
        $("#puID").val("");
    });

    $("#pDownvote").click(function() {
        $("#pdID").val("");
    });

    // upvote button
    $("#pUpvoteBtn").click(function() {
        // check if left empty
        if ($("#puID").val() == "") {
            alert("Enter the review id and try again");
            return;
        }

        var formData = {
            "Professor": $("#pSelect").val(),
            "ID": $("#puID").val()
        };

        $.ajax({
            type: "POST",
            url: "assets/php/professorUpvote.php",
            data: formData,
            dataType: "text",
            success: function(data) {
                $("#pUpvoteModal").modal("toggle");
                $("#pContent").html(data);
            }
        }).fail(function(error) {
            console.error("Unable to process", error);
        });
    });

    $("#pDownvoteBtn").click(function() {
        // check if left empty
        if ($("#pdID").val() == "") {
            alert("Enter the review id and try again");
            return;
        }

        var formData = {
            "Professor": $("#pSelect").val(),
            "ID": $("#pdID").val()
        };

        $.ajax({
            type: "POST",
            url: "assets/php/professorDownvote.php",
            data: formData,
            dataType: "text",
            success: function(data) {
                $("#pDownvote").modal("toggle");
                $("#pContent").html(data);
            }
        }).fail(function(error) {
            console.error("Unable to process", error);
        })
    })

    // downvote button

    $("#addProfessorBtn").click(function() {
        var formData = {
            "professor": $("#professorName").val()
        };
        $.ajax({
            type: "POST",
            url: "assets/php/addProfessor.php",
            data: formData,
            dataType: "text",
            success: function(data) {
                alert(data);
                $("#addProfessorModal").modal("toggle");
            }
        }).fail(function(error) {
            console.error("Unable to process", error);
        });
    });
    
    //Statistics page sending professor name, on success go to the statistics.php page
    // $("#pSelect").change(function () {
    //     var formData = {
    //         "professor": $(this).val()
    //     };
    //     $.ajax({
    //         type: "POST",
    //         url: "assets/php/pStatCalc.php",
    //         data: formData,
    //         dataType: "html",
    //         success: function (data) {
    //             alert(data);
    //         }
    //     }).fail(function (error) {
    //         console.error('Unable to load results', error);
    //     });
    // });

    //Get the professor reviews for stats table


});

