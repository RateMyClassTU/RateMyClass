$(document).ready(function() {

    // remove all information from modal
    $("#courseToggleBtn").click(function() {
        $("#courseSearch").val("");
        $("#courseSelect").empty();
        $("#courseSelect").append("<option value='0' selected='true' disabled>Begin by searching up a course</option>");
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
            })
        } else {
            // search is cleared
            $("#courseSelect").empty();
            $("#courseSelect").append("<option value='0' selected='true' disabled>Begin by searching up a course</option>");
        }
    })
})
