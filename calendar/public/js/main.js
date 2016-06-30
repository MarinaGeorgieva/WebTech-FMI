$(document).ready(function() {

    $("#login-form").validate({
        rules: {
            password: {
                required: true
            },
            username: {
                required: true
            },
        },
        messages: {
            password: {
                required: "Моля въведете парола!"
            },
            username: {
                required: "Моля въведете потребителско име!"
            }
        },
        submitHandler: submitForm
    });

    function submitForm() {
        var data = $("#login-form").serialize();

        $.ajax({
            type: 'POST',
            url: '../includes/api/login.php',
            data: data,
            beforeSend: function() {
                $("#error").fadeOut();
            },
            success: function(response) {
                if (response == "ok") {
                    window.location.href = "home.php";
                } else {
                    $("#error").fadeIn(1000, function() {
                        $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + '</div>');
                    });
                }
            }
        });

        return false;
    }
    /* login submit */
});