$(document).ready(function() {
    $("#courseCategory").change(function() {
        var $dropdown = $("#courseCategory");
        $.getJSON("assets/json/categories.json", function(data) {
            var key = $dropdown.val();
            var vals = [];

            switch(key) {
                case "college1":
                    vals = data.college1.split(",");
                    break;
                case "college2":
                    vals = data.college2.split(",");
                    break;
                case "college3":
                    vals = data.college3.split(",");
                    break;
                case "college4":
                    vals = data.college4.split(",");
                    break;
                case "college5":
                    vals = data.college5.split(",");
                    break;
                case "college6":
                    vals = data.college6.split(",");
                    break;
                case "college7":
                    vals = data.college7.split(",");
                    break;
                case "college8":
                    vals = data.college8.split(",");
                    break;
                case "college9":
                    vals = data.college9.split(",");
                    break;
                case "college10":
                    vals = data.college10.split(",");
                    break;
                case "college11":
                    vals = data.college11.split(",");
                    break;
            }

            var $dropdown2 = $("#majorSelect");
            $dropdown2.empty();
            $dropdown2.append("<option selected='true' disabled>Choose a major</option>");
            $.each(vals, function(index, value) {
                $dropdown2.append("<option>" + value + "</option>");
            });

            $("#goBtn").prop("disabled", true);

            $("#majorSelect").change(function() {
                $("#goBtn").prop("disabled", false);
            })
        })
    })

    $(".close").click(function() {
        $("#courseCategory").val("none");
        $("#majorSelect").empty();
        $("#majorSelect").append("<option selected='true' disabled></option>");
        $("#goBtn").prop("disabled", true);
    })
})