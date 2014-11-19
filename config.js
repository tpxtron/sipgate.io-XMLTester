/**
 * sipgate.io test XML generator
 *
 * Licensed under the WTFPL: http://www.wtfpl.net/
 * TL;DR: Do what the f*ck you want with this. :-)
 *
 * JavaScript for config page
 */

$(document).ready(function() {
	$('.check, input[name=broken_header]').click(function() {
		update();
	});

	$('.input').focus(function() {
		update();
	});

	$('.input, select, input[name=broken_header]').change(function() {
		update();
	});

	$('.input, select').blur(function() {
		update();
	});

	$('.input').keyup(function() {
		update();
	});

	$('#dialNumber, #playFile, #sayText, #amount').focus(function(e) {
		$('input[type=radio]').removeAttr('checked');
		$(e.target).closest('input[type=radio]').attr('checked','checked');
	});

	function update() {
		var action = $('.check:checked').data('action');
		var additionalParams = "";
		switch(action) {
			case 'dial':
				additionalParams = "&number=" + encodeURIComponent($('#dialNumber').val());
				break;
			case 'play':
				additionalParams = "&file=" + encodeURIComponent($('#playFile').val());
				break;
			case 'say':
				additionalParams = "&text=" + encodeURIComponent($('#sayText').val());
				break;
			case 'randomsound':
				additionalParams = "&amount=" + encodeURIComponent($('#amount').val());
				break;
		}

		if($('#broken_header').prop('checked')) {
			additionalParams = additionalParams + "&broken_header=true";
		}
		if($('#charset').val() == "iso") {
			additionalParams = additionalParams + "&charset=iso";
		}

		var url = $('#hiddenURL').val();

		$('#url').val(url+'?action=' + action + additionalParams);
	}

});