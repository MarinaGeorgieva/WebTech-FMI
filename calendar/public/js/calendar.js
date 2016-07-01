$(document).ready(function() {

	var username = $('#username-hidden').val();

	var allEvents = [];

	$.ajax({
		url: '../includes/api/events.php',
		type: 'GET',
		data: {
			user: username
		},
		dataType: 'json',
		success: function(data) {
			var eventsData = data.events;

			if (eventsData === undefined) {
				$('#calendar').fullCalendar({
					header: {
						left: '',
						center: 'prev title next',
						right: 'today'
					}
				});
			} else {
				var i, len = eventsData.length;

				for (i = 0; i < len; i++) {
					var id = eventsData[i].id;
					var title = eventsData[i].title;
					var date = eventsData[i].date;
					var description = eventsData[i].description;
					var category = eventsData[i].category;
					var place = eventsData[i].place;
					var event = {
						id: id,
						title: title,
						start: date,
						description: description,
						place: place,
						color: getColorByCategory(category),
						textColor: 'black'
					};
					allEvents.push(event);
				}

				$('#calendar').fullCalendar({
					header: {
						left: '',
						center: 'prev title next',
						right: 'today'
					},
					eventSources: [{
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
						// }]
					}],
					eventClick: function(event, jsEvent, view) {
						$('#modalTitle').html(event.title);
						$('#eventId').html(event.id);
						$('.modal-header').css("background-color", event.color);

						var eventDay = moment(event.start).format('DD/MM/YYYY');
						var eventTime = moment(event.start).format('H:mm a');
						var modalBodyHtml = '<div class="container"><div class="row"><span class="glyphicon glyphicon-calendar" aria-hidden="true">' +
							'</span> ' + eventDay + ' &nbsp;<span class="glyphicon glyphicon-time" aria-hidden="true">' +
							'</span> ' + eventTime + '</div>';
						if (event.place != null) {
							modalBodyHtml += '<div class="row"><span class="glyphicon glyphicon-map-marker" aria-hidden="true">' +
								'</span> ' + event.place + '</div>';
						}
						modalBodyHtml += '<div class="row"><p>' + event.description + '</p></div></div>';

						$('#modalBody').html(modalBodyHtml);
						$('#fullCalModal').modal();
					}
				});
			}
		}
	});

	$('#btn-unsubscribe').on('click', function() {
		unsubscribe();
		window.location.reload();
	});

	function unsubscribe() {
		var eventId = $('#eventId').html();
		var data = {
			event_id: eventId,
			username: username
		};

		$.ajax({
			url: '../includes/api/unsubscribe.php',
			type: 'PUT',
			data: JSON.stringify(data),
			dataType: 'json',
			success: function(response) {
				console.log(response);
			}
		});
	}

	function getColorByCategory(category) {
		var color = '';
		switch (category) {
			case 'lecture':
				color = '#3F88E8';
				break;
			case 'homework':
				color = '#FFE100';
				break;
			case 'exercise':
				color = '#13D45A';
				break;
			case 'test':
				color = '#C500E8';
				break;
			case 'project':
				color = '#FC2D2D';
				break;
			case 'external':
				color = 'orange';
				break;
			default:
				color = 'lightblue';
				break;
		}

		return color;
	}

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