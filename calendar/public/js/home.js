$(document).ready(function() {

	$.ajax({
		url: '../includes/events.php',
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
		url: '../includes/events.php',
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
});