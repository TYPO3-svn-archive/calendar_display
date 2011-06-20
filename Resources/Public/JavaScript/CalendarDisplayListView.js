/*
 * Special Listner for List View
 */

$(document).ready(function(){

	// Edit icon
	$('.tx-calendardisplay-list-wrapper-edit').click(CalendarDisplay.editEvent);

	// Listner on filter controller
	$('#tx-calendardisplay-list-filter-category').change(CalendarDisplay.filterEvents);
	$('#tx-calendardisplay-list-filter-timeBegin').change(CalendarDisplay.filterEvents);
	$('#tx-calendardisplay-list-filter-keyword').keyup(function(event) {

		// Key up is a bit more complicated as it needs to be delayed
		if ((event.keyCode > 48 && event.keyCode < 57) ||
				(event.keyCode >= 65 && event.keyCode <= 90) ||
				event.keyCode == 8 ||
				event.keyCode == 48) {
			delay(function() {
				CalendarDisplay.filterEvents();
			},1000);
		}
		else if (event.keyCode == 13) {
			// user hit enter
			delay(function() {
				CalendarDisplay.filterEvents();
			},0);
		}
		
	});

	// add datetime picker to date-start
	$('#tx-calendardisplay-list-filter-timeBegin').datepicker(CalendarDisplay.TimePicker.options);
});

/*
 * Initialize the List View
 */
$(document).ready(function(){

	// Initialize CalendarDisplay object

	/**
	 * Initialize object that contains configuration
	 */
	var config = {

		/*
		 * Url configuration
		 */
		newUrl : '/?type=12636&tx_calendardisplay_pi1[refererAction]=list', // &no_cache=1 (debug purposes)
		editUrl : '/?type=12639tx_calendardisplay_pi1[refererAction]=list', // &no_cache=1 (debug purposes)

	};

	// merge configuation
	CalendarDisplay = $.extend(CalendarDisplay, config);

});