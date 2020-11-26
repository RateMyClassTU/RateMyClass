$(document).ready(function() {

    $("#courseToggleBtn").click(function() {
        $("#courseSelect").empty();
        $.ajax({
            type: "POST",
            url: "assets/php/dropdown.php",
            dataType: "json",
            success: function(data) {
                var len = data.length;
                $("#collegeSelect").empty();
                $("#collegeSelect").append("<option value='0' selected='true' disabled>Select a college</option>");
                for (var i = 0; i < len; i++) {
                    var department = data[i]['Department'];
                    $("#collegeSelect").append("<option value='"+department+"'>"+department+"</option>");
                }
            }
        })
    })

    $("#collegeSelect").change(function() {
        var formData = {
            "Department": $("#collegeSelect").val()
        };
        $.ajax({
            type: "POST",
            url: "assets/php/getCourse.php",
            data: formData,
            dataType: "json",
            success: function(data) {
                var len = data.length;
                $("#courseSelect").empty();
                $("#courseSelect").append("<option value='0' selected='true' disabled>Select a course</option>");
                for (var i = 0; i < len; i++) {
                    var course = data[i]['Course'];
                    $("#courseSelect").append("<option value='"+course+"'>"+course+"</optrion>");
                }
            }
        })
    })
})
