$(document).ready(function() {

    $("#clearBtn").click(function() {
        $("#searchMsg").val("");
        $("#searchContent").html("");
    });

    $("#accountBtn").click(function(e) {
        e.preventDefault();
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
});