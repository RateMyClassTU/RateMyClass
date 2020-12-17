let manageUserBtnCntr = 0; // display user accounts
let manageAdminBtnCntr = 0; // display admins
let showReportBtnCntr = 0; // display users with highest downvotes
let viewReportBtnCntr = 0; // display specific reports

$(document).ready(function() {
    
    // Displays all users
    $("#showUserBtn").click(function() {
        if (manageUserBtnCntr == 0) {
            manageAdminBtnCntr = 0;
            manageUserBtnCntr = 1;
            showReportBtnCntr = 0;

            if (viewReportBtnCntr == 1) {
                viewReportBtnCntr = 0;
                $("#viewContainer").attr("hidden", "hidden");
            }

            $.ajax({
                type: "POST",
                url: "assets/php/adminUser.php",
                dataType: "html",
                success: function(data) {
                    $("#adminContent").html(data);                    }
            }).fail(function(error) {
                console.error('Unable to retrieve user information', error);
            });
        } else {
            manageUserBtnCntr = 0;
            $("#adminContent").html("");
        }
    });

    // show admins
    $("#showAdminBtn").click(function() {
        if (manageAdminBtnCntr == 0) {
            manageUserBtnCntr = 0;
            manageAdminBtnCntr = 1;
            showReportBtnCntr = 0;

            if (viewReportBtnCntr == 1) {
                viewReportBtnCntr = 0;
                $("#viewContainer").attr("hidden", "hidden");
            }

            $.ajax({
                type: "POST",
                url: "assets/php/adminAdmin.php",
                dataType: "html",
                success: function(data) {
                    $("#adminContent").html(data);
                }
            }).fail(function(error) {
                console.error('Unable to retrieve user information', error);
            })
        } else {
            manageAdminBtnCntr = 0;
            $("#adminContent").html("");
        }
    });

    // show reported users
    $("#showReportBtn").click(function() {
        if (showReportBtnCntr == 0) {
            manageUserBtnCntr = 0;
            manageAdminBtnCntr = 0;
            showReportBtnCntr = 1;

            if (viewReportBtnCntr == 1) {
                viewReportBtnCntr = 0;
                $("#viewContainer").attr("hidden", "hidden");
            }

            $.ajax({
                type: "POST",
                url: "assets/php/getReports.php",
                dataType: "html",
                success: function(data) {
                    $("#adminContent").html(data);
                }
            }).fail(function(error) {
                console.error('Unable to show reports', error);
            });
        } else {
            showReportBtnCntr = 0;
            $("#adminContent").html("");
        }
    });


    // USER ACTIONS
    $("#userSearch").keyup(function() {
        if ($(this).val() != '') {
            var formData = {
                "User": $(this).val()
            };
            $.ajax({
                type: "POST",
                url: "assets/php/getUsers.php",
                data: formData,
                dataType: "json",
                success: function(data) {
                    var len = data.length;
                    $("#userSelect").empty();

                    if (len > 1) {
                        $("#userSelect").append("<option value='0' selected='true'>Are any of these what you're looking for?</option>");

                        for (var i = 0; i < len; i++) {
                            var user = data[i]['User'];
                            $("#userSelect").append("<option value='"+user+"'>"+user+"</option>");
                        }

                    } else if (len == 1) {
                        var user = data[0]['User'];
                        $("#userSelect").append("<option value='0' selected='true'>Match found</option>");
                        $("#userSelect").append("<option value='"+user+"'>"+user+"</option>");

                    } else {
                        $("#userSelect").append("<option value='0' selected='true'>No matches found. Please try again!</option>");

                    }
                }
            }).fail(function(error) {
                console.error('Unable to process', error);
            })
        }
    });

    $("#executeActionBtn").click(function() {
        var usr = $("#userSelect").val();
        var act = $("#actionSelect").val();
        if (usr == '0' || act == '0') {
            alert("Enter user and action");
        } else if (usr != '0' && act != '0') {
            var formData = {
                "User": usr,
                "Action": act
            };
            $.ajax({
                type: "POST",
                url: "assets/php/userAction.php",
                data: formData,
                dataType: "text",
                success: function(data) {
                    alert(data);
                }
            }).fail(function(error) {
                console.error('Unable to process', error);
            });
        }
    });

    $("#manageUserBtn").click(function() {
        $("#userSearch").val("");
        $("#userSelect").empty();
        $("#userSelect").append("<option value='0' selected='true'>Search and select user</option>");
        $("#actionSelect").val("0");
    });

    // view report button
    $("#viewReport").click(function() {
        if (viewReportBtnCntr == 0) {
            // close and clear other containers if open
            manageUserBtnCntr = 0;
            manageAdminBtnCntr = 0;
            showReportBtnCntr = 0;
            $("#adminContent").html("");

            // show the buttons
            viewReportBtnCntr = 1;
            $("#viewContainer").removeAttr("hidden");

            // clear previous search
            $("#UserId").val("");
            $("#ReviewId").val("");
        } else {
            viewReportBtnCntr = 0; // hide
            $("#viewContainer").attr("hidden", "hidden");
            $("#adminContent").html("");
        }
    });

    // search a user (to find their reviews)
    $("#UserIdSearch").click(function() {
        if ($("#UserId").val() == "") {
            alert("Please enter a user id number");
            return;
        }

        var formData = {
            "ID": $("#UserId").val()
        };

        $.ajax({
            type: "POST",
            url: "assets/php/showReport.php",
            async: false,
            data: formData,
            dataType: "text",
            success: function(data) {
                $("#adminContent").html(data);
            }
        }).fail(function(error) {
            console.error("Unable to load reports", error);
        });
    });

    $("#ReviewIdBtn").click(function() {
        if ($("#ReviewId").val() == "") {
            alert("Please enter a review number");
            return;
        }

        var formData = {
            "ID": $("#ReviewId").val()
        };

        $.ajax({
            type: "POST",
            url: "assets/php/resolveReport.php",
            async: false,
            data: formData,
            dataType: "text",
            success: function(data) {
                alert(data);
                $("#ReviewId").val("");
            }
        }).fail(function(error) {
            console.error("Unable to resolve report", error);
        });
    });

    $("#DeactivateId").click(function() {
        var formData = {
            "ID": $("#UserId").val()
        };

        $.ajax({
            type: "POST",
            url: "assets/php/deactivate.php",
            async: false,
            data: formData,
            dataType: "text",
            success: function(data) {
                alert(data);
            }
        }).fail(function(error) {
            console.error("Could not deactivate", error);
        })
    })

});