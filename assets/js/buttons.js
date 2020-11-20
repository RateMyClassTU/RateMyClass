$(document).ready(function() {
    $("#accountBtn").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "assets/php/display.php",
            dataType: "html",
            async: "false",
            success: function(data) {
                $("#accountInfo").html(data);
            }
        })
    })
})