$(document).ready(function() {

    $("#clearBtn").click(function() {
        $("#searchMsg").val("");
        $("#searchContent").html("");
    });

    $("#accountBtn").click(function(e) {
        e.preventDefault();

        $("#submitChange").attr("hidden", "hidden");
        // $("input[name=newEmail]").attr("hidden", "hidden");
        $("input[name=oldPassword]").attr("hidden", "hidden");
        $("input[name=newPassword]").attr("hidden", "hidden");
        // $("input[name=newEmail]").val("");
        $("input[name=oldPassword]").val("");
        $("input[name=newPassword]").val("");

        $.ajax({
            type: "POST",
            url: "assets/php/display.php",
            dataType: "html",
            sync: "true",
            success: function(data) {
                $("#accountInfo").html(data);
            }
        }).fail(function(error) {
            console.error('Unable to load account details', error);
        });
    });

    $("#searchMsg").keyup(function(e) {
        e.preventDefault();
        if ($(this).val() != "") {
            var formData = {
                "Message": $("input[name=searchMsg]").val()
            };
            $.ajax({
                type: "POST",
                url: "assets/php/search.php",
                data: formData,
                dataType: "html",
                success: function(data) {
                    $("#searchContent").html(data);
                }
            }).fail(function(error) {
                console.error('Unable to load database', error);
            });
        } else if ($(this).val() == "") {
            $("#searchContent").html("");
        }
    });

    $("#adminBtn").click(function() {
        $.ajax({
            type: "POST",
            url: "assets/php/checkStatus.php",
            dataType: "text",
            success: function(data) {
                if (data == 'admin') window.location.href='admin.php';
            }
        }).fail(function(error) {
            console.error('Unable to verify admin status', error);
        });
    });

    // edit account information
    $("#settingBtn").click(function() {
        $("#submitChange").removeAttr("hidden");
        $("input[name=newEmail]").removeAttr("hidden");
        $("input[name=oldPassword]").removeAttr("hidden");
        $("input[name=newPassword]").removeAttr("hidden");
    });


    $("#submitChange").click(function() {
        if ($("input[name=oldPassword]").val() == "" || $("input[name=newPassword]").val() == "") {
            alert("Please fill out the missing fields");
            return;
        }

        var formData = {
            "oldPassword": $("input[name=oldPassword]").val(),
            "newPassword": $("input[name=newPassword").val()
        };

        $.ajax({
            type: "POST",
            url: "assets/php/userChangePassword.php",
            data: formData,
            dataType: "text",
            success: function(data) {
                alert(data);
                $("#accountModal").modal("toggle");
            }
        }).fail(function(error) {
            console.error("Unable to process", error);
        });

    });
    
    /*
    $("#submitChange").click(function() {
        // change password only
        if ($("input[name=newEmail]").val() == "" && $("input[name=oldPassword]").val() != "" && $("input[name=newPassword]").val() != "") {
            var formData = {
                "oldPassword": $("input[name=oldPassword]").val(),
                "newPassword": $("input[name=newPassword").val()
            };
            $.ajax({
                type: "POST",
                url: "assets/php/userChangePassword.php",
                data: formData,
                dataType: "text",
                success: function(data) {
                    alert(data);
                }
            }).fail(function(error) {
                console.log(error);
            });
        }

        // change email only
        if ($("input[name=newEmail]").val() != "" && $("input[name=oldPassword]").val() == "" && $("input[name=newPassword]").val() == "") {
            var formData = {
                "newEmail": $("input[name=newEmail]").val()
            };
            $.ajax({
                type: "POST",
                url: "assets/php/userChangeEmail.php",
                data: formData,
                dataType: "text",
                success: function(data) {
                    alert(data);
                }
            }).fail(function(error) {
                console.log(error);
            });
        }

        // change both email / password
        if ($("input[name=newEmail]").val() != "" && $("input[name=oldPassword]").val() != "" && $("input[name=newPassword]").val() != "") {
            var formData = {
                "newEmail": $("input[name=newEmail]").val(),
                "oldPassword": $("input[name=oldPassword]").val(),
                "newPassword": $("input[name=newPassword]").val()
            };
            $.ajax({
                type: "POST",
                url: "assets/php/userChangeInfo.php",
                data: formData,
                dataType: "text",
                success: function(data) {
                    alert(data);
                }
            }).fail(function(error) {
                console.log(error);
            });
        }
    });
    */

});
