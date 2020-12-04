var manageUserBtnCntr = 0;
var manageAdminBtnCntr = 0;

$(document).ready(function() {
    
    // Displays all users
    $("#manageUserBtn").click(function() {
        if (manageUserBtnCntr == 0) {
            manageAdminBtnCntr = 0;
            manageUserBtnCntr = 1;
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

    $("#manageAdminBtn").click(function() {
        if (manageAdminBtnCntr == 0) {
            manageUserBtnCntr = 0;
            manageAdminBtnCntr = 1;
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
    })

});