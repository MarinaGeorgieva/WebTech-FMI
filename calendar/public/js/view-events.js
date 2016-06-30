$(document).ready(function() {
	var category = qs('category');

	$.getJSON(
		'../includes/api/events.php?', {
			category: category
		},
		function(data) {
			var eventsData = data.events,
				i,
				len = eventsData.length;

			for (i = 0; i < len; i++) {
				var title = eventsData[i].title;
				var date = eventsData[i].date;
				var description = eventsData[i].description;
				var place = eventsData[i].place;

				var eventsList = $('div.container > div.list-group');

				eventsList.append('<div class="panel panel-default" id="' + (i + 1 + '') + '"' + '></div>');
				var eventPanel = $('div.list-group > div#' + (i + 1 + ''));

				var eventHtml = '<div class="panel-heading">' + title +
					'</div><div class="panel-body"><p><span>' + date + '</span> <span>' + place +
					'</span></p><p>' + description + '</p></div></div>';
				eventPanel.append(eventHtml);
			}
		});

	function qs(key) {
		key = key.replace(/[*+?^$.\[\]{}()|\\\/]/g, "\\$&"); // escape RegEx meta chars
		var match = location.search.match(new RegExp("[?&]" + key + "=([^&]+)(&|$)"));
		return match && decodeURIComponent(match[1].replace(/\+/g, " "));
	}
});


// <div class="container">
// 		<div class="list-group">  			
//     		<div class="panel panel-default">
//   				<div class="panel-heading">Panel heading</div>
//   				<div class="panel-body">
//   					<p><span>22.06.2016</span> <span>@ FMI 101</span></p>
//   					<p>Event description text text text text text text text text</p>
//   				</div>
// 			</div>
// 		</div>
// 	</div>