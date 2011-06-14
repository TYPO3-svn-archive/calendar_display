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
				week: "d[ MMMM][ yyyy]{ - d MMMM yyyy}", // ex : 10 — 16 Janvier 2010,
				day: 'dddd d MMMM yyyy' // ex : Jeudi 14 Janvier 2010
			},
			columnFormat: {
				month: "ddd",
				week: 'ddd d', // Ven. 15
				day: '' // affichage déja complet au niveau du 'titleFormat'
			},
			timeFormat: {
				'': 'H:mm', // événements vue mensuelle.
				agenda: 'H:mm{ - H:mm}' // événements vue agenda
			},
			isRTL: false,
			firstDay: 1,
			monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
			monthNamesShort: ['janv.','févr.','mars','avr.','mai','juin','juil.','août','sept.','oct.','nov.','déc.'],
			dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
			dayNamesShort: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
			axisFormat: 'HH:mm',
			buttonText: {
				prev: "&nbsp;&#9668;&nbsp;",
				next: "&nbsp;&#9658;&nbsp;",
				prevYear: "&nbsp;&lt;&lt;&nbsp;",
				nextYear: "&nbsp;&gt;&gt;&nbsp;",
				today: "Aujourd'hui",
				month: "Mois",
				week: "Semaine",
				day: "Jour"
			}
		};
		return options;
	}
})(jQuery);