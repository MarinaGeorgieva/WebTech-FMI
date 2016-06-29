$(document).ready(function() {

	var allEvents = [];

	$.ajax({
		url: '../includes/api/events.php',
		type: 'GET',
		data: '',
		dataType: 'json',
		success: function(data) {
			var eventsData = data.events,
				i,
				len = eventsData.length;

			for (i = 0; i < len; i++) {
				var title = eventsData[i].title;
				var date = eventsData[i].date;
				var description = eventsData[i].description;
				var event = {
					title: title,
					start: date,
					description: description
				};
				allEvents.push(event);
				// $('#all').append('<div class="row"><strong>date: </strong>' + date + '<strong> title: </strong>' + title + '</div>');
			}

			$('#calendar').fullCalendar({
				// put your options and callbacks here
				header: {
					left: '',
					center: 'prev title next',
					right: 'today'
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
				],
				eventClick: function(event, jsEvent, view) {
					$('#modalTitle').html(event.title);
					$('#modalBody').html(event.description);
					// $('#eventUrl').attr('href', event.url);
					$('#fullCalModal').modal();
				},
				// If the current user is admin
				// editable: true,
				// eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc) {

				// 	alert(event.title + " was dropped on " + event.start.format());

				// 	if (!confirm("Are you sure about this change?")) {
				// 		revertFunc();
				// 	}
				// }
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
});