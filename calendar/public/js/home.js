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
				$('#output').append('<div class="row"><strong>date: </strong>' + date + '<strong> title: </strong>' + title + '</div>');
			}
		}
	});
});