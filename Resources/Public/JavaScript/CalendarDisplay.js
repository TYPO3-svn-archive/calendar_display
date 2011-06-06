$(document).ready(function(){
	// hide the loading image
	$('.loading').hide();
	
	$('div.event-list select.category').change(function(){
		filterBooking();
	});
	
	$('div.event-list input.keyword').keyup(function(){
		filterBooking();
	});
	
	$('div.event-list input.timeBegin').change(function(){
		filterBooking();
	});
	

	// add datetime picker to date-start
	$('.date-start > input').datepicker();

	// add key word search box background
	$('div.event-list .keyword').focus(function() {
		var defaultValue = $('#defauleSearchLabel').val();
		if(defaultValue == $('div.event-list .keyword').val()) $('div.event-list .keyword').val('');
		else if ($('div.event-list .keyword').val() == '') $('div.event-list .keyword').val(defaultValue);
	});

	$('div.event-list .keyword').blur(function() {
		var defaultValue = $('#defauleSearchLabel').val();
		if(defaultValue == $('div.event-list .keyword').val()) $('div.event-list .keyword').val('');
		else if ($('div.event-list .keyword').val() == '') $('div.event-list .keyword').val(defaultValue);
	});
});

function filterItems() {
	var category = $('div.available-item select.category').val();
	var keyword = $('div.available-item input.keyword').val();
	var defaultValue = $('#defauleSearchLabel').val();
	if(keyword == defaultValue) {
		keyword = '';
	}
	$.ajax({
		url: '/?type=12637&tx_calendardisplay_pi1[category]=' + category + '&tx_calendardisplay_pi1[keyword]=' + keyword,
		beforeSend: function() {enableLoading(true)},
		success: function(data) {
			enableLoading(false);
			$('.available-item > .list-wrapper > table > tbody').html(data);
		}
	});
}

function filterBooking() {
	var category = $('div.event-list select.category').val();
	var keyword = $('div.event-list input.keyword').val();
	var defaultValue = $('#defauleSearchLabel').val();
	if(keyword == defaultValue) {
		keyword = '';
	}
	var timeBegin = $('div.event-list input.timeBegin').val();
	$.ajax({
		url: '/?type=12638&tx_calendardisplay_pi1[category]=' + category + '&tx_calendardisplay_pi1[keyword]=' + keyword + '&tx_calendardisplay_pi1[dateBegin]=' + timeBegin,
		beforeSend: function() {enableLoading(true)},
		success: function(data) {
			enableLoading(false);
			$('.event-list > .list-wrapper > table > tbody').html(data);
		}
	});
}


function enableLoading(enable){
	if (enable) {
		$('.loading').show();
	} else {
		$('.loading').hide();
	}
}