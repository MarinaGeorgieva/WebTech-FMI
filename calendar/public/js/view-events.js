$(document).ready(function() {
	var category = qs('category');

	var username = $('#username-hidden').val();

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

				eventsList.append('<div class="panel panel-default" id="' + eventsData[i].id + '"' + '></div>');
				var eventPanel = $('div.list-group > div#' + eventsData[i].id);

				var eventHtml = '<div class="panel-heading">' + title +
					'</div><div class="panel-body"><p><span class="date-place">' + date + '</span>';

				if (place != null) {
					eventHtml += '<span>' + place + '</span></p>';
				}

				eventHtml += '<p>' + description + '</p>' +
					'<button type="button" class="btn btn-primary btn-subscribe">Добави в календара</button>' +
					'<button type="button" class="btn btn-default btn-unsubscribe">Премахни от календара</button></div>';
				eventPanel.append(eventHtml);
			}

			$('.btn-subscribe').on('click', function(e) {
				var target = e.currentTarget;
				var parent = $(target).parent();
				var grandParent = $(parent).parent();
				var currentId = $(grandParent).attr('id');
				subscribe(currentId);
			});

			$('.btn-unsubscribe').on('click', function(e) {
				var target = e.currentTarget;
				var parent = $(target).parent();
				var grandParent = $(parent).parent();
				var currentId = $(grandParent).attr('id');
				unsubscribe(currentId);
			});
		});

	$('#categoryName').html(getCategoryBgName(category))

	function getCategoryBgName(category) {
		var categoryBg = '';
		switch (category) {
			case 'lecture':
				categoryBg = 'Лекции';
				break;
			case 'homework':
				categoryBg = 'Домашни';
				break;
			case 'exercise':
				categoryBg = '#Упражнения';
				break;
			case 'test':
				categoryBg = 'Контролни';
				break;
			case 'project':
				categoryBg = 'Проекти';
				break;
			case 'external':
				categoryBg = 'Външни събития';
				break;
		}

		return categoryBg;
	}

	function subscribe(eventId) {
		var data = {
			event_id: eventId,
			username: username
		};

		$.ajax({
			url: '../includes/api/subscribe.php',
			type: 'PUT',
			data: JSON.stringify(data),
			dataType: 'json',
			success: function(response) {
				alert(response);
				console.log(response);
			}
		});
	}

	function unsubscribe(eventId) {
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
				alert(response);
				console.log(response);
			}
		});
	}

	function qs(key) {
		key = key.replace(/[*+?^$.\[\]{}()|\\\/]/g, "\\$&"); // escape RegEx meta chars
		var match = location.search.match(new RegExp("[?&]" + key + "=([^&]+)(&|$)"));
		return match && decodeURIComponent(match[1].replace(/\+/g, " "));
	}
});