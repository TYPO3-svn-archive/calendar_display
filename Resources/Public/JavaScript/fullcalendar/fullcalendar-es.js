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
			timeFormat: {
				agenda: 'h(:mm)t{ - h(:mm)t}',
				'': 'h(:mm)t{-h(:mm)t }'
			},
			monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
			monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
			dayNames: [ 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
			buttonText: {
				today: 'hoy',
				month: 'mes',
				week: 'semana',
				day: 'día'
			}
		};
		return options;
	}
})(jQuery);