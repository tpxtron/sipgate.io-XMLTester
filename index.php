<?php
/**
 * sipgate.io test XML generator
 *
 * Licensed under the WTFPL: http://www.wtfpl.net/
 * TL;DR: Do what the f*ck you want with this. :-)
 *
 * Main File
 */

require_once("sipgateio.class.php");

// In case somebody tries to access this file and is most-likely not sipgate.io: redirect to config page
if(!isset($_POST['from']) || !isset($_POST['to']) || !isset($_POST['direction'])) {
	header("location:config.php");
}

// Gather variables
$fromNumber = $_POST['from'];
$toNumber = $_POST['to'];
$direction = $_POST['direction'];

// Create the header and the necessary sipgate.io class (for testing purposes, we support ISO-Charset and broken header information)
if(isset($_GET['broken_header'])) {
	header('Content-type: foo/bar');
} else {
	header('Content-type: application/xml' . (isset($_GET['charset']) && $_GET['charset'] == "iso" ? "; charset=ISO-8859-1" : ""));
}
$sipgateio = new SipgateIO(null,(isset($_GET['charset']) && $_GET['charset'] == "iso" ? "ISO-8859-1" : "UTF-8"));

// Decide, what action should be done
$_GET['action'] = strtolower($_GET['action']);
switch($_GET['action']) {
	case 'play':
		$sipgateio->play((empty($_GET['file']) ? "FIXME" : $_GET['file']));
		break;
	case 'say':
		$sipgateio->say($_GET['text']);
		break;
	case 'busy':
		$sipgateio->reject("busy");
		break;
	case 'reject':
		$sipgateio->reject();
		break;
	case 'voicemail':
		$sipgateio->voicemail();
		break;
	case 'dial':
		$sipgateio->dial($_GET['number']);
		break;
	case 'broken_tag':
		$sipgateio->customTag("Wurst");
		break;
	case 'broken_dial':
		$sipgateio->dial("");
		break;
	case 'randomsound':
		$count = (isset($_GET['amount']) ? $_GET['amount'] : 1);

		$urlPrefix = ($_SERVER['HTTPS'] ? "https" : "http")."://".$_SERVER['HTTP_HOST']."/wav/";
		$dir = opendir("./wav/");
		$files = array();
		while(false !== ($file = readdir($dir))) {
			if($file != "." && $file != "..") $files[] = $file;
		}

		for($i = 0; $i < $count; $i++) {
			$randomNumber = rand(0,count($files)-1);
			$sipgateio->play($urlPrefix . urlencode($files[$randomNumber]));
			unset($files[$randomNumber]);                                       // To prevent duplicates
		}

		// After playback, add a hangup so that the call is not transferred to the callee
		$sipgateio->hangup();
		break;
	case 'broken':
		die('<?xml version="1.0" encoding="UTF-8"?><Response>This is broken to maximum extent');
		break;
}

// To simulate a slow server, sleeping is possible, too.
if(isset($_GET['sleep'])) {
	sleep($_GET['sleep']);
}

// Finally, return the generated response XML
echo $sipgateio->getResponseXML();
