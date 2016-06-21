$(document).ready(function() {

	// var post = {
	// 	title: 'Event 3',
	// 	description: 'test post',
	// 	date: new Date(2016, 06, 20),
	// 	type: 'homework'
	// };

	$.ajax({
		url: '../includes/api/events.php',
		type: 'GET',
		data: '',
		dataType: 'json',
		success: function(data) {
			var i,
				len = data.length;
			for (i = 0; i < len; i++) {
				var date = data[i].date;
				var title = data[i].title;
				$('#all').append('<div class="row"><strong>date: </strong>' + date + '<strong> title: </strong>' + title + '</div>');
			}
		}
	});

	$.ajax({
		url: '../includes/api/events.php',
		type: 'GET',
		data: {
			id: 1
		},
		dataType: 'json',
		success: function(data) {
			console.log(data);

			var date = data.date;
			var title = data.title;
			$('#withId').append('<div class="row"><strong>date: </strong>' + date + '<strong> title: </strong>' + title + '</div>');
		}
	});

	// $.ajax({
	// 	url: '../includes/api/events.php',
	// 	type: 'POST',
	// 	data: JSON.stringify(post),
	// 	dataType: 'json',
	// 	success: function(response) {
	// 		console.log(response);
	// 		$('#post').append('<div class="row"><strong> ' + response + '</strong></div>');
	// 	}
	// })
});