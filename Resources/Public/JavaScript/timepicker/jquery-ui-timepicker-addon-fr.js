/**
 * @preserve
* jQuery timepicker addon
* By: Trent Richardson [http://trentrichardson.com]
* Version 0.9.3
* Last Modified: 02/05/2011
*
* Copyright 2010 Trent Richardson
* Dual licensed under the MIT and GPL licenses.
* http://trentrichardson.com/Impromptu/GPL-LICENSE.txt
* http://trentrichardson.com/Impromptu/MIT-LICENSE.txt
 *
 * Language options
 */


/**
 * Return the language options
 *
 * Other translation available @ view-source:http://jqueryui.com/demos/datepicker/localization.html
 */
$.timepicker.getLanguageOptions = function () {

	var options = {
		ampm: false,
		timeFormat: 'hh:mm tt',
		timeOnlyTitle: 'Sélection temps',
		timeText: 'Temps',
		hourText: 'Heure',
		minuteText: 'Minute',
		secondText: 'Seconde',
		closeText: 'Fermer',
		prevText: 'Précédent',
		nextText: 'Suivant',
		currentText: 'Aujourd\'hui',
		monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
		'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
		monthNamesShort: ['Janv.','Févr.','Mars','Avril','Mai','Juin',
		'Juil.','Août','Sept.','Oct.','Nov.','Déc.'],
		dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
		dayNamesShort: ['Dim.','Lun.','Mar.','Mer.','Jeu.','Ven.','Sam.'],
		dayNamesMin: ['D','L','M','M','J','V','S'],
		weekHeader: 'Sem.',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''

	};
	return options;
}
	

