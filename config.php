<?php
/**
 * sipgate.io test XML generator
 *
 * Licensed under the WTFPL: http://www.wtfpl.net/
 * TL;DR: Do what the f*ck you want with this. :-)
 *
 * Config page
 */

// the URL will be needed for the generated Link...
$url = ($_SERVER['HTTPS'] ? "https" : "http")."://".$_SERVER['HTTP_HOST']."/";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>sipgate.io testlink configuration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
	</head>

	<body>
		<div class="container">
			<h1>sipgate.io testlink configuration</h1>
		</div>

		<div class="container">
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" data-action="busy" checked /> Busy</label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" data-action="reject" /> Reject</label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" data-action="voicemail" /> Voicemail</label></div></div>
			<div class="row"><div class="col-xs-12"><label>
				<div style="display: inline-block; vertical-align: top;">
					<input type="radio" name="action" class="check" id="chk_dial" data-action="dial" />
				</div>
				<div style="display: inline-block;">
					Dial: <input type="text" class="input" id="dialNumber" /><br />
					<label><input type="checkbox" name="option" class="check" id="dialoriginal" /> Send "Dial" with original number</label><br />
					<label><input type="checkbox" name="option" class="check" id="dialvoicemail" /> Dial Voicemail if "55000" is original number</label><br />
					Caller ID: <input type="text" class="input" id="dialNumberCallerId" /><br />
				</div>
			</label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" id="chk_play" data-action="play" /> Play: <input type="text" class="input" id="playFile" /></label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" id="chk_say" data-action="say" /> Say: <input type="text" class="input" id="sayText" /></label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" id="chk_randomsound" data-action="randomsound" /> Play <i>n</i> Random Sounds: <input type="text" class="input" id="amount" value="1" size="2" /></label></div></div>
			<div class="row"><div class="col-xs-12"><label>Charset: 
				<select id="charset">
					<option value="utf">UTF-8</option>
					<option value="iso">ISO-8859-1</option>
				</select>
			</label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" data-action="broken" /> simulate totally broken XML</label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" data-action="broken_tag" /> simulate unknown tag in XML</label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="radio" name="action" class="check" data-action="broken_dial" /> simulate a dial without any target at all</label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="checkbox" name="option" class="check" id="broken_header" /> simulate a broken XML header</label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="checkbox" name="option" class="check" id="setCallerId" /> Caller ID: <input type="text" name="callerId" class="input" id="callerId" /></label></div></div>
			<div class="row"><div class="col-xs-12"><label><input type="checkbox" name="option" class="check" id="emptyresponse" /> send empty response if "55000" is original number</label></div></div>	
			<div class="row"><div class="col-xs-12"><label><input type="checkbox" name="option" class="check" id="sleep" /> Sleep <i>n</i> seconds before answering: <input type="text" name="sleepSeconds" class="input" id="sleepSeconds" /></label></div></div>

		</div>
		<div class="container">
			<hr />
			<div class="row">
				<div class="col-xs-12">
					<label>Your URL is:<br />
						<input type="text" id="url" style="width: 100%;" value="<?php echo $url; ?>?action=busy" size="100">
					</label>
					<input type="hidden" id="hiddenURL" value="<?php echo $url; ?>" />
				</div>
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
		<script src="config.js"></script>
	</body>
</html>
