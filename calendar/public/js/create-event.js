$(document).ready(function() {
	var createButton = $('#btn-create');

	createButton.on('click', function() {
		createEvent();
	});

	function createEvent() {
		var event = {
			title: $('#title').val(),
			description: $('#description').val(),
			type: $('#type').val(),
			date: $('#date').val(),
			place: $('#place').val()
		};

		$.ajax({
			url: '../includes/api/events.php',
			type: 'POST',
			data: JSON.stringify(event),
			dataType: 'json',
			success: function(response) {
				console.log(response);
			}
		});
	}
});