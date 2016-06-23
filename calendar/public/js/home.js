$(document).ready(function() {

	var allEvents = [];

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
				var title = data[i].title;
				var date = data[i].date;
				var event = {
					title: title,
					start: date
				};
				allEvents.push(event);
				// $('#all').append('<div class="row"><strong>date: </strong>' + date + '<strong> title: </strong>' + title + '</div>');
			}

			console.log(allEvents);

			$('#calendar').fullCalendar({
				// put your options and callbacks here
				header: {
					left: 'prev',
					center: 'title',
					right: 'today next'
				},
				eventSources: [

					// your event source
					{
						events: allEvents,
						// events: [{
						// 	title: 'event1',
						// 	start: '2016-06-05T16:00:00'
						// }, {
						// 	title: 'event2',
						// 	start: '2016-06-13T9:30:00'
						// }, {
						// 	title: 'event3',
						// 	start: '2016-06-13T11:00:00'
						// }, {
						// 	title: 'event4',
						// 	start: '2016-06-13T14:15:00'
						// }, {
						// 	title: 'event5',
						// 	start: '2016-06-10',
						// 	end: '2016-06-12'
						// }, {
						// 	title: 'event6',
						// 	start: '2016-06-09T12:30:00',
						// 	allDay: false // will make the time show
						// }],
						// color: 'blue',
						// textColor: 'white'
					}
				]
			});
		}
	});

	// $.ajax({
	// 	url: '../includes/api/events.php',
	// 	type: 'GET',
	// 	data: {
	// 		id: 1
	// 	},
	// 	dataType: 'json',
	// 	success: function(data) {
	// 		// console.log(data);

	// 		var title = data.title;
	// 		var date = data.date;
	// 		// $('#withId').append('<div class="row"><strong>date: </strong>' + date + '<strong> title: </strong>' + title + '</div>');
	// 	}
	// });

	// $.ajax({
	// 	url: '../includes/api/events.php',
	// 	type: 'POST',
	// 	data: JSON.stringify(post),
	// 	dataType: 'json',
	// 	success: function(response) {
	// 		console.log(response);
	// 		$('#post').append('<div class="row"><strong> ' + response + '</strong></div>');
	// 	}
	// });


});