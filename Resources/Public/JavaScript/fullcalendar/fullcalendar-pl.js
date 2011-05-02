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
$.fullCalendar.getLanguageOptions = function () {

	var options = {
		timeFormat: {
			agenda: 'H:mm{ - H:mm}',
			'': 'H:mm'
		},
		axisFormat: 'H:mm',
		firstDay: 1,
		monthNames: ['styczeń','luty','marzec','kwiecień','maj','czerwiec','lipiec','sierpień','wrzesień','październik','listopad','grudzień'],
		monthNamesShort: ['sty.','lut.','mar.','kwi.','maj','cze.','lip.','sie.','wrz.','paź.','lis.','gru.'],
		dayNames: ['niedziela','poniedziałek','wtorek','środa','czwartek','piątek','sobota'],
		dayNamesShort: ['niedz.','pon.','wt.','śr.','czw.','pt.','sob.'],
		buttonText: {
			prev: '&nbsp;&#9668;&nbsp;',
			next: '&nbsp;&#9658;&nbsp;',
			prevYear: '&nbsp;&lt;&lt;&nbsp;',
			nextYear: '&nbsp;&gt;&gt;&nbsp;',
			today: 'dzisiaj',
			month: 'miesiąc',
			week: 'tydzień',
			day: 'dzień'
		},
		allDayText: 'cały dzień'
	};
	return options;
}