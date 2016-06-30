$(document).ready(function() {
	$("#register-form").validate({
		rules: {
			username: {
				required: true,
				minlength: 5
			},
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				equalTo: '#password'
			},
			first_name: {
				required: true
			},
			last_name: {
				required: true
			}
		},
		messages: {
			username: {
				required: "Моля въведете потребителско име",
				minlength: "Полето трябва да съдържа поне 5 символа"
			},
			password: {
				required: "Моля въведете парола",
				minlength: "Паролата трябва да е поне 5 символа"
			},
			confirm_password: {
				required: "Моля повторете паролата",
				equalTo: "Паролите не съвпадат"
			},
			first_name: {
				required: "Моля въведете име"
			},
			last_name: {
				required: "Моля въведете фамилия"
			}
		},
		submitHandler: submitForm
	});

	function submitForm() {
		var data = $("#register-form").serialize();

		$.ajax({
			type: 'POST',
			url: '../includes/api/register.php',
			data: data,
			beforeSend: function() {
				$("#error").fadeOut();
			},
			success: function(data) {
				if (data == "registered") {
					window.location.href = "index.php";
				} else {
					$("#error").fadeIn(1000, function() {
						$("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + data + '</div>');
					});
				}
			}
		});
		return false;
	}
});