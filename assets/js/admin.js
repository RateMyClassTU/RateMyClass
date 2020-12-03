$(document).ready(function() {
    // check if the user is an admin
    $("#adminBtn").click(function() {
        $.ajax({
            type: "POST",
            url: "assets/php/checkStatus.php",
            dataType: "text"
        }).done(function(data) {
            if (data == 'admin') {
                window.location.href='admin.php';
            } else {
                window.location.href='home.php';
                alert('not admin');
            }
        }).fail(function(error) {
            console.error('Unable to process', error);
        });
    });
});