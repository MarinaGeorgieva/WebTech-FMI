$(document).ready(function() {

	// page is now ready, initialize the calendar...

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
				events: [{
					title: 'event1',
					start: '2016-06-05T16:00:00'
				}, {
					title: 'event2',
					start: '2016-06-13T9:30:00'
				}, {
					title: 'event3',
					start: '2016-06-13T11:00:00'
				}, {
					title: 'event4',
					start: '2016-06-13T14:15:00'
				}, {
					title: 'event5',
					start: '2016-06-10',
					end: '2016-06-12'
				}, {
					title: 'event6',
					start: '2016-06-09T12:30:00',
					allDay: false // will make the time show
				}],
				// color: 'blue',
				// textColor: 'white'
			}

			// any other event sources...
		]
	})

});