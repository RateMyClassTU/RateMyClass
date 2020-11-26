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
        if ($(this).val() != '') {
            var formData = {
                "Message": $("input[name=searchMsg").val()
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
})