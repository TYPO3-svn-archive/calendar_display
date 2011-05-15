$(document).ready(function(){
	// hide the loading image
	$('.loading').hide();
	
	// filter option
	$('div.available-item > div.filter-wrapper > div.filter > select.category').change(function(){
		filterItems();
	});	
	
	$('div.available-item > div.filter-wrapper > div.search > input.keyword').keyup(function(){
		filterItems();
	});	
	
	$('div.event-list > div.filter-wrapper > form > div.filter > select.category').change(function(){
		filterBooking();
	});	
	
	$('div.event-list > div.filter-wrapper > form > div.search > input.keyword').keyup(function(){
		filterBooking();
	});
	

	// add datetime picker to date-start
	$('.date-start > input').datetimepicker();
	$('#timeBegin').datetimepicker();
	$('#timeEnd').datetimepicker();

	// add key word search box background
	$('.keyword').focus(function() {
		var defaultValue = $('#defauleSearchLabel').val();
		if(defaultValue == $('.keyword').val()) $('.keyword').val('');
		else if ($('.keyword').val() == '') $('.keyword').val(defaultValue);
	});

	$('.keyword').blur(function() {
		var defaultValue = $('#defauleSearchLabel').val();
		if(defaultValue == $('.keyword').val()) $('.keyword').val('');
		else if ($('.keyword').val() == '') $('.keyword').val(defaultValue);
	});
});

function filterItems() {
	var category = $('select.category').val();
	var keyword = $('input.keyword').val();
	var defaultValue = $('#defauleSearchLabel').val();
	if(keyword == defaultValue) {
		keyword = '';
	}
	$.ajax({
		url: '/?type=12637&tx_calendardisplay_pi1[category]=' + category + '&tx_calendardisplay_pi1[keyword]=' + keyword,
		beforeSend: function() {enableLoading(true)},
		success: function(data) {
			enableLoading(false);
			$('.available-item > table > tbody').html(data);
		}
	});
}

function filterBooking() {
	var category = $('select.category').val();
	var keyword = $('input.keyword').val();
	var defaultValue = $('#defauleSearchLabel').val();
	if(keyword == defaultValue) {
		keyword = '';
	}
	var timeBegin = $('input.timeBegin').val();
	$.ajax({
		url: '/?type=12638&tx_calendardisplay_pi1[category]=' + category + '&tx_calendardisplay_pi1[keyword]=' + keyword + '&tx_calendardisplay_pi1[dateBegin]=' + timeBegin,
		beforeSend: function() {enableLoading(true)},
		success: function(data) {
			enableLoading(false);
			$('.event-list > table > tbody').html(data);
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