$(document).ready(function() {

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
        })
    })

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
                dataType: "text",
                success: function(data) {
                    $("#searchContent").html(data);
                }
            })
        } else if ($(this).val() == "") {
            $("#searchContent").html("");
        }
    })

    $("#search-go").click(function(e) {
        e.preventDefault();
        if ($("#search-msg").val() != "") {
            var formData = {
                "Message": $("input[name=search-msg]").val()
            };
            $.ajax({
                type: "POST",
                url: "assets/php/searchGo.php",
                data: formData,
                dataType: "text",
                success: function(data) {
                    $("#search-content").html(data);
                }
            })
        }
    })

    $("#search-go2").click(function(e) {
        e.preventDefault();
        if ($("#search-msg2").val() != "") {
            var formData = {
                "Message": $("input[name=search-msg2]").val()
            };
            $.ajax({
                type: "POST",
                url: "assets/php/searchGo.php",
                data: formData,
                dataType: "text",
                success: function(data) {
                    $("#search-content2").html(data);
                }
            })
        }
    })
})