/*
 * Initialize the Calendar View
 */
$(document).ready(function(){

	// edit link in the flash message
	$('.tx-calendardisplay-list-wrapper-edit').click(CalendarDisplay.editEvent);
	
	/**
	 * Initialize object that contains configuration
	 */
	var config = {
		/*
		 * Url configuration
		 */
		newUrl : '/?type=12636&tx_calendardisplay_pi1[refererAction]=calendar', // &no_cache=1 (debug purposes)
		editUrl : '/?type=12639&tx_calendardisplay_pi1[refererAction]=calendar', // &no_cache=1 (debug purposes)

		/*
		 * jQuery Plugin fullCalendar
		 */
		Calendar : {
			options: CalendarDisplay.getCalendarOptions()
		}

	};

	// merge configuation
	CalendarDisplay = $.extend(CalendarDisplay, config);

	// launch the calendar
	var calendar = $('#calendar').fullCalendar(CalendarDisplay.Calendar.options);
});
