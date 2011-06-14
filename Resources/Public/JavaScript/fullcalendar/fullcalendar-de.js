/**
 * @preserve
 * FullCalendar v1.5.1
 * http://arshaw.com/fullcalendar/
 *
 * Language options
 *
 * Copyright (c) 2011 Adam Shaw
 * Copyright (c) 2011 Fabien Udriot
 * Dual licensed under the MIT and GPL licenses, located in
 * MIT-LICENSE.txt and GPL-LICENSE.txt respectively.
 *
 */

/**
 * Return the language options
 */
(function($) {
	$.fullCalendar.getLanguageOptions = function () {

		var options = {
			titleFormat: {
				month: "MMMM yyyy",
				week: "d.[ MMMM][ yyyy]{ - d. MMMM yyyy}",
				day: "dddd, d.MMMM yyyy"
			},
			columnFormat: {
				month: "ddd",
				week: "ddd d.M.",
				day: "dddd d.M."
			},
			timeFormat: {
				"":"h(:mm)t"
			},
			isRTL: false,
			firstDay: 1,
			monthNames: ["Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember"],
			monthNamesShort: ["Jan","Feb","Mär","Apr","Mai","Jun","Jul","Aug","Sep","Okt","Nov","Dez"],
			dayNames: ["Sonntag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag"],
			axisFormat: 'HH:mm',
			dayNamesShort: ["So","Mo","Di","Mi","Do","Fr","Sa"],
			buttonText: {
				prev: "&nbsp;&#9668;&nbsp;",
				next: "&nbsp;&#9658;&nbsp;",
				prevYear: "&nbsp;&lt;&lt;&nbsp;",
				nextYear: "&nbsp;&gt;&gt;&nbsp;",
				today: "heute",
				month: "Monat",
				week: "Woche",
				day: "Tag"
			}
		};
		return options;
	}
})(jQuery);
