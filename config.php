<?php 
$url = ($_SERVER['HTTPS'] ? "https" : "http")."://".$_SERVER['HTTP_HOST']."/";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>sipgate.io Testlink-Konfigurator</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="rollercoder.de | Tobias Niepel">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
	</head>

	<body>
		<div class="container">
			<h1>sipgate.io Testlink-Konfigurator</h1>
		</div>

		<div class="container">
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" data-action="busy" checked /> Busy</label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" data-action="reject" /> Reject</label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" data-action="voicemail" /> Voicemail</label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" id="chk_dial" data-action="dial" /> Dial: <input type="text" class="input" id="dialNumber" /></label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" id="chk_play" data-action="play" /> Play: <input type="text" class="input" id="playFile" /></label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" id="chk_say" data-action="say" /> Say: <input type="text" class="input" id="sayText" /></label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" id="chk_randomsound" data-action="randomsound" /> Play <i>n</i> Random Sounds: <input type="text" class="input" id="amount" value="1" /></label></div></div>
			<div class="row"><div class="col-xs-12"><label>Charset: 
				<select id="charset">
					<option value="utf">UTF-8</option>
					<option value="iso">ISO-8859-1</option>
				</select>
			</label></div></div>
			
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" data-action="broken" /> syntaktisch invalides XML simulieren</label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" data-action="broken_tag" /> kaputtes XML (unbekannter Tag) simulieren</label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" data-action="broken_dial" /> Dial ohne Target</label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="checkbox" name="option" class="check" id="broken_header" /> Falscher XML-Header</label></div></div>

		</div>
		<div class="container">
			<hr />
			<div class="row">
				<div class="col-xs-12">
				<label>Deine URL lautet:<br /><input type="text" id="url" style="width: 100%;" value="<?php echo $url; ?>?action=busy"></label>
				</div>
			</div>
		</div>
		

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

		<script type="text/javascript">
		<!--
			$(document).ready(function() {
				$('.check').click(function() {
					update();
				});

				$('.input').focus(function() {
					update();
				});

				$('.input').change(function() {
					update();
				});

				$('.input').blur(function() {
					update();
				});

				$('.input').keyup(function() {
					update();
				});

				$('select').change(function() {
					update();
				});

				$('select').blur(function() {
					update();
				});

				$('input[name=broken_header]').change(function() {
					update();
				});

				$('input[name=broken_header]').click(function() {
					update();
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

					var url = '<?php echo $url; ?>';

					$('#url').val(url+'?action=' + action + additionalParams);
				}

			});

		-->
		</script>
	</body>
</html>
