'use strict';

adsApp.factory('alertsService', function () {
		
	function showAlerts(type, message) {
		//alerts: info, warning, success, danger
        window.scrollTo(0, 0);
        $('#alerts').append($('<div class="alert alert-' + type + '">' + message + '</div>'));
        $('#alerts').children().fadeIn().delay(3500).fadeOut('slow', function () {
            $(this).remove();
        });
	}

	return {
		showAlerts: showAlerts
	}
});