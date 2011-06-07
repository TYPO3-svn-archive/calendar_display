$(document).ready(function(){
	// hide the loading image
	enableLoading(false);
	
	$('.tx-calendardisplay-available-item-event-list select.tx-calendardisplay-filter-category').change(function(){
		filterBooking();
	});
	
	$('.tx-calendardisplay-available-item-event-list input.tx-calendardisplay-filter-keyword').keyup(function(){
		filterBooking();
	});
	
	$('.tx-calendardisplay-available-item-event-list input.tx-calendardisplay-filter-time-begin').change(function(){
		filterBooking();
	});
	

	// add datetime picker to date-start
	$('.tx-calendardisplay-filter-date-start > input').datepicker();

});

function filterItems() {
	var category = $('.tx-calendardisplay-available-item select.tx-calendardisplay-filter-category').val();
	var keyword = $('.tx-calendardisplay-available-item input.tx-calendardisplay-filter-keyword').val();
	var eventId = $('#tx-calendardisplay-pi1-event-id').val();
	var timeBegin = $('#tx-calendardisplay-form-event-time-begin').val();
	$.ajax({
		url: '/?type=12637&tx_calendardisplay_pi1[event]=' + eventId + '&tx_calendardisplay_pi1[category]=' + category + '&tx_calendardisplay_pi1[keyword]=' + keyword + '&tx_calendardisplay_pi1[dateBegin]=' + timeBegin,
		beforeSend: function() {enableLoading(true)},
		success: function(data) {
			enableLoading(false);
			$('.tx-calendardisplay-available-item tbody').html(data);
		}
	});
}

function filterBooking() {
	var category = $('.tx-calendardisplay-available-item-event-list select.tx-calendardisplay-filter-category').val();
	var keyword = $('.tx-calendardisplay-available-item-event-list input.tx-calendardisplay-filter-keyword').val();
	var timeBegin = $('.tx-calendardisplay-available-item-event-list input.tx-calendardisplay-filter-time-begin').val();
	$.ajax({
		url: '/?type=12638&tx_calendardisplay_pi1[category]=' + category + '&tx_calendardisplay_pi1[keyword]=' + keyword + '&tx_calendardisplay_pi1[dateBegin]=' + timeBegin,
		beforeSend: function() {enableLoading(true)},
		success: function(data) {
			enableLoading(false);
			$('.tx-calendardisplay-available-item-event-list tbody').html(data);
		}
	});
}

function enableLoading(enable){
	if (enable) {
		$('.tx-calendardisplay-loading').show();
	} else {
		$('.tx-calendardisplay-loading').hide();
	}
}