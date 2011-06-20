/*
 * Common Listner
 */
$(document).ready(function(){

	// Listener on "new event" link -> load the dialog box
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
	 * Load the Interface for editting
	 */
	CalendarDisplay.editEvent = function() {
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
	}

	/**
	 * Filter the list of event
	 */
	CalendarDisplay.filterEvents = function() {
		
		var searchWord = $('#tx-calendardisplay-list-filter-keyword').val();
		// still a bug of field type=search ? if value is NULL, value is replaced by the placeholder
		if (searchWord == $('#tx-calendardisplay-list-filter-keyword').attr('placeholder')) {
			searchWord = '';
		}

		$.ajax({
			url: '/index.php',
			data: {
				'type': 12638,
				'tx_calendardisplay_pi1[controller]': 'Event',
				'tx_calendardisplay_pi1[action]': 'filter',
				'tx_calendardisplay_pi1[keyword]': searchWord,
				'tx_calendardisplay_pi1[category]': $('#tx-calendardisplay-list-filter-category').val(),
				'tx_calendardisplay_pi1[dateBegin]': $('#tx-calendardisplay-list-filter-timeBegin').val()
			},
			beforeSend: function() {
				$('#tx-calendardisplay-event-box').addClass('tx-calendardisplay-waiting');
			},
			success: function(data) {
				// replaces the content
				$('.tx-calendardisplay-list tbody').html(data);

				// adds listener
				$('.tx-calendardisplay-list-wrapper-edit').click(CalendarDisplay.editEvent);

				// removes the loading message
				$('#tx-calendardisplay-event-box').removeClass('tx-calendardisplay-waiting');
			}
		});
	}


	/**
	 * Filter the list of items
	 */
	CalendarDisplay.filterResources = function() {
		var searchWord = $('.tx-calendardisplay-filter-keyword').val();
		// still a bug of field type=search ? if value is NULL, value is replaced by the placeholder
		if (searchWord == $('.tx-calendardisplay-filter-keyword').attr('placeholder')) {
			searchWord = '';
		}

		// makes sure it is possible to filter the resource
		var timeBegin = $('#tx-calendardisplay-form-event-timeBegin').val();
		var timeEnd = $('#tx-calendardisplay-form-event-timeEnd').val();
		if (timeBegin != '' && timeEnd != '' && timeBegin != timeEnd) {
			$.ajax({
				url: '/index.php',
				data: {
					// Controller: "Event"
					// Action: "filterItems"
					'type': 12637,
					'tx_calendardisplay_pi1[event]': $('#tx-calendardisplay-event-id').val(),
					'tx_calendardisplay_pi1[keyword]': searchWord,
					'tx_calendardisplay_pi1[category]': $('.tx-calendardisplay-filter-category').val(),
					'tx_calendardisplay_pi1[dateBegin]': $('#tx-calendardisplay-form-event-timeBegin').val(),
					'tx_calendardisplay_pi1[dateEnd]': $('#tx-calendardisplay-form-event-timeEnd').val()
				},
				beforeSend: function() {
					$('#tx-calendardisplay-dialog-column-second').addClass('tx-calendardisplay-waiting');
				},
				success: function(data) {
					$('#tx-calendardisplay-dialog-column-second').removeClass('tx-calendardisplay-waiting');
					$('#tx-calendardisplay-dialog-column-second-prepend').removeClass('tx-calendardisplay-hidden');
					$('.tx-calendardisplay-dialog-list-wrapper').html(data);
					// reposition the widget
					CalendarDisplay.Dialog.dialog('option', 'position', CalendarDisplay.Dialog.dialog('option', 'position'));

					// hide prepend content is an error is detected
					if (data.search('typo3-message message-error') > -1) {
						$('#tx-calendardisplay-dialog-column-second-prepend').addClass('tx-calendardisplay-hidden');
					}

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


/*
 * Global function - closure
 */
var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();