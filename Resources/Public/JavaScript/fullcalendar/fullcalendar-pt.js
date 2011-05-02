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
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'],
		buttonText: {
			prev: '&nbsp;&#9668;&nbsp;',
			next: '&nbsp;&#9658;&nbsp;',
			prevYear: '&nbsp;&lt;&lt;&nbsp;',
			nextYear: '&nbsp;&gt;&gt;&nbsp;',
			today: 'hoje',
			month: 'mês',
			week: 'semana',
			day: 'dia'
		},
		titleFormat: {
			month: 'MMMM yyyy',
			week: "d [ yyyy]{ '&#8212;'[ MMM] d MMM yyyy}",
			day: 'dddd, d MMM, yyyy'
		},
		columnFormat: {
			month: 'ddd',
			week: 'ddd d/M',
			day: 'dddd d/M'
		},
		allDayText: 'dia todo',
		axisFormat: 'H:mm',
		timeFormat: {
			'': 'H(:mm)',
			agenda: 'H:mm{ - H:mm}'
		}
	};
	return options;
}