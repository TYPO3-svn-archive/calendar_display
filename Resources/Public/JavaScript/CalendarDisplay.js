/*
 * Common Listner
 */
$(document).ready(function(){

	// Load dialog box
	$('#tx-calendardisplay-link-new').click(function() {

		$.blockUI(CalendarDisplay.WaitingUI.options);

		CalendarDisplay.Dialog.load(
			CalendarDisplay.newUrl,
			{},
			function (responseText, textStatus, XMLHttpRequest) {

				// release UI
				$.unblockUI();

				// define title dialog box
				CalendarDisplay.Dialog.dialog('option', 'title', CalendarDisplay.Lang.dialogTitleNew);

				// open dialog box
				CalendarDisplay.Dialog.dialog('open');
			}
		);

		// prevent the default action, e.g., following a link
		return false;
	});
	
});

/*
 * Common function for Calendar Display
 */
$(document).ready(function(){

	/**
	 * Filter the list of event
	 */
	CalendarDisplay.filterEvents = function() {
		$.ajax({
			url: '/index.php',
			data: {
				'type': 12638,
				'tx_calendardisplay_pi1[keyword]': $('#tx-calendardisplay-list-filter-keyword').val(),
				'tx_calendardisplay_pi1[category]': $('#tx-calendardisplay-list-filter-category').val(),
				'tx_calendardisplay_pi1[dateBegin]': $('#tx-calendardisplay-list-filter-timeBegin').val()
			},
			beforeSend: function() {enableLoading(true)},
			success: function(data) {
				enableLoading(false);
				$('.tx-calendardisplay-available-item-event-list tbody').html(data);
			}
		});
	}


	/**
	 * Filter the list of items
	 */
	CalendarDisplay.filterResources = function() {
		// makes sure it is possible to filter the resource
		var timeBegin = $('#tx-calendardisplay-form-event-timeBegin').val();
		var timeEnd = $('#tx-calendardisplay-form-event-timeEnd').val();
		if (timeBegin != '' && timeEnd != '' && timeBegin != timeEnd  || true) {
			$.ajax({
				url: '/index.php',
				data: {
					// Controller: "Event"
					// Action: "filterItems"
					'type': 12637,
					'tx_calendardisplay_pi1[event]': $('#tx-calendardisplay-event-id').val(),
					'tx_calendardisplay_pi1[keyword]': $('.tx-calendardisplay-filter-keyword').val(),
					'tx_calendardisplay_pi1[category]': $('.tx-calendardisplay-filter-category').val(),
					'tx_calendardisplay_pi1[dateBegin]': $('#tx-calendardisplay-form-event-timeBegin').val(),
					'tx_calendardisplay_pi1[dateEnd]': $('#tx-calendardisplay-form-event-timeEnd').val()
				},
				beforeSend: function() {enableLoading(true)},
				success: function(data) {
					enableLoading(false);
					$('#tx-calendardisplay-dialog-column-second-prepend').removeClass('tx-calendardisplay-hidden');
					$('.tx-calendardisplay-list-wrapper').html(data);
				}
			});

		}
	}

	/**
	 * Return Dialog object
	 */
	CalendarDisplay.initializeDialog = function() {
		// Dialog box
		var dialog = $('<div></div>').dialog({
			autoOpen: false,
			modal: true,
			width: 800,
			buttons: [
				{
					text: CalendarDisplay.Lang.dialogCloseButton,
					click: function() {
						$(this).dialog("close");
					}
				}, {
					text: CalendarDisplay.Lang.dialogSaveButton,
					click: function() {
						$('#tx-calendardisplay-form-event').submit();
					}
				}
			]
		});

		return dialog;
	}

	/**
	 * Return WaitingUI options
	 */
	CalendarDisplay.getWaitingUIOptions = function() {
		// Calendar default options
		var defaultOptions = {
			message: null
		}
		return $.extend(defaultOptions, CalendarDisplay._waitingUI);
	}

	/**
	 * Return Time picker options
	 */
	CalendarDisplay.getTimePickerOptions = function() {
		// Calendar default options
		var defaultOptions = {
			hourMin: 8,
			hourMax: 18,
			stepHour: 1,
			stepMinute: 10
		}

		// merge language options if any
		var languageOptions = {};
		if (typeof($.timepicker.getLanguageOptions) == 'function') {
			languageOptions = $.timepicker.getLanguageOptions();
		}

		return $.extend(defaultOptions, languageOptions, CalendarDisplay._timePicker);
	}

	/**
	 * Return calendar options
	 */
	CalendarDisplay.getCalendarOptions = function() {

		// Calendar
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		// @temp
		console.log(d);
		console.log(m);
		console.log(y);

		// Calendar default options
		var defaultOptions = {
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			theme: false,
			defaultView: 'agendaWeek',
			allDaySlot: false,
			firstHour: 8,
			editable: false,
			selectable: false,
			selectHelper: true,
			eventClick: function(calEvent, jsEvent, view) {
				if (calEvent.id) {
					// GUI
					$.blockUI(CalendarDisplay.WaitingUI.options);
					CalendarDisplay.Dialog.load(
						CalendarDisplay.editUrl + '&tx_calendardisplay_pi1[event]=' + calEvent.id,
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
				// change the border color just for fun
				$(this).css('border-color', 'red');
			},

			eventSources: [{
				events: CalendarDisplay._events
			}]

		};

		// merge language options if any
		var languageOptions = {};
		if (typeof($.fullCalendar.getLanguageOptions) == 'function') {
			languageOptions = $.fullCalendar.getLanguageOptions();
		}

		return $.extend(defaultOptions, languageOptions, CalendarDisplay._calendar);
	}

});

/*
 * Common function for Calendar Display
 */
$(document).ready(function(){

	/**
	 * Initialize object that contains configuration
	 */
	var config = {

		/*
		 * jQuery Plugin
		 */
		WaitingUI : {
			options: CalendarDisplay.getWaitingUIOptions()
		},


		/*
		 * jQuery UI Timepicker widget
		 */
		TimePicker : {
			options: CalendarDisplay.getTimePickerOptions()
		},

		/*
		 * jQuery UI Dialog widget
		 */
		Dialog: CalendarDisplay.initializeDialog(),

		/*
		 * Store some State variables
		 */
		State : {}
	};

	// merge configuation
	CalendarDisplay = $.extend(CalendarDisplay, config);
});

// @temp see how we can encapsulate this function
function enableLoading(enable){
	if (enable) {
		$('.tx-calendardisplay-loading').show();
	} else {
		$('.tx-calendardisplay-loading').hide();
	}
}