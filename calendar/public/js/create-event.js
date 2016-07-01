$(document).ready(function() {
	var createButton = $('#btn-create');

	createButton.on('click', function() {
		// createEvent();
	});

	$("#create-event-form").validate({
		rules: {
			title: {
				required: true,
				minlength: 3
			},
			description: {
				required: true,
				minlength: 10
			},
			date: {
				required: true
			}
		},
		messages: {
			title: {
				required: "Моля въведете заглавие",
				minlength: "Полето трябва да съдържа поне 3 символа"
			},
			description: {
				required: "Моля въведете описание",
				minlength: "Полето трябва да съдържа поне 10 символа"
			},
			date: {
				required: "Моля въведете име"
			}
		},
		submitHandler: createEvent
	});

	function createEvent() {
		var event = {
			title: $('#title').val(),
			description: $('#description').val(),
			category: $('#category').val(),
			date: $('#date').val(),
			place: $('#place').val()
		};

		console.log(event);

		$.ajax({
			type: 'POST',
			url: '../includes/api/events.php',
			data: JSON.stringify(event),
			dataType: 'json',
			success: function(response) {
				if (response == "ok") {
					console.log("success");
					window.location.href = "calendar.php";
				} else {
					console.log(response);
				}
			}
		});

		return false;
	}

	// function createEvent() {
	// 	var event = {
	// 		title: $('#title').val(),
	// 		description: $('#description').val(),
	// 		category: $('#category').val(),
	// 		date: $('#date').val(),
	// 		place: $('#place').val()
	// 	};

	// 	$.ajax({
	// 		url: '../includes/api/events.php',
	// 		type: 'POST',
	// 		data: JSON.stringify(event),
	// 		dataType: 'json',
	// 		success: function(response) {
	// 			console.log(response);
	// 		}
	// 	});
	// }
});