/*
 * Special Listner for List View
 */
$(document).ready(function(){

	// Edit icon
	$('.tx-calendardisplay-list-wrapper-edit').click(function() {
		var preClass = 'tx-calendardisplay-edit-event';
		var eventId = ($(this).attr('id')).substring(preClass.length);
		if (eventId) {
			$.blockUI(CalendarDisplay.WaitingUI.options);

			CalendarDisplay.Dialog.load(
				CalendarDisplay.editUrl + '&tx_calendardisplay_pi1[event]=' + eventId,
				{},
				function (responseText, textStatus, XMLHttpRequest) {

					// release UI
					$.unblockUI();

					// define title dialog box
					CalendarDisplay.Dialog.dialog('option', 'title', CalendarDisplay.Lang.dialogTitleUpdate);

					// open dialog box
					CalendarDisplay.Dialog.dialog('open');
				}
			);
		}

		// prevent the default action, e.g., following a link
		return false;
	});

	// hide the loading image
	//enableLoading(false);

	$('#tx-calendardisplay-list-filter-category').change(CalendarDisplay.filterEvents);
	$('#tx-calendardisplay-list-filter-keyword').keyup(CalendarDisplay.filterEvents);
	$('#tx-calendardisplay-list-filter-timeBegin').change(CalendarDisplay.filterEvents);

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