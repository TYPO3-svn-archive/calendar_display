$(document).ready(function(){
	$('.loading').hide();
	
	$('div.available-item > div.filter-wrapper > div.filter > select.category').change(function(){
		filterItems();
	});	
	
	$('div.available-item > div.filter-wrapper > div.search > input.keyword').keyup(function(){
		filterItems();
	});	
	
	$('div.booking-list > div.filter-wrapper > form > div.filter > select.category').change(function(){
		filterBooking();
	});	
	
	$('div.booking-list > div.filter-wrapper > form > div.search > input.keyword').keyup(function(){
		filterBooking();
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
		url: '/?type=12636&tx_calendardisplay_pi1[action]=filterItems&tx_calendardisplay_pi1[controller]=Booking&tx_calendardisplay_pi1[category]=' +category + '&tx_calendardisplay_pi1[keyword]=' + keyword,
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
		url: '/?type=12636&tx_calendardisplay_pi1[action]=filter&tx_calendardisplay_pi1[controller]=Booking&tx_calendardisplay_pi1[category]=' +category + '&tx_calendardisplay_pi1[keyword]=' + keyword + '&tx_calendardisplay_pi1[dateBegin]=' + timeBegin,
		beforeSend: function() {enableLoading(true)},
		success: function(data) {
			enableLoading(false);
			$('.booking-list > table > tbody').html(data);
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