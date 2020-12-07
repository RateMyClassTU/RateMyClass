var manageUserBtnCntr = 0; // display user accounts
var manageAdminBtnCntr = 0; // display admins
var showReportBtnCntr = 0; // display users with highest downvotes

$(document).ready(function() {
    
    // Displays all users
    $("#showUserBtn").click(function() {
        if (manageUserBtnCntr == 0) {
            manageAdminBtnCntr = 0;
            manageUserBtnCntr = 1;
            showReportBtnCntr = 0;
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
    });

});