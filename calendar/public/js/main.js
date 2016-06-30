$(document).ready(function() {

    $("#login-form").validate({
        rules: {
            password: {
                required: true,
                minlength: 5
            },
            username: {
                required: true,
                minlength: 5
            },
        },
        messages: {
            password: {
                required: "Моля въведете парола!",
                minlength: "Паролата трябва да съдържа поне 5 символа!"
            },
            username: {
                required: "Моля въведете потребителско име!",
                minlength: "Потребителското име трябва да съдържа поне 5 символа!"
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