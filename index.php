<?php

$fromNumber = $_POST['from'];
$toNumber = $_POST['to'];

$additionalHeader = "";
$charset = "UTF-8";
if(isset($_GET['charset']) && $_GET['charset'] == "iso") {
	$additionalHeader = "; charset=ISO-8859-1";
	$charset = "ISO-8859-1";
}

$dom = new DOMDocument('1.0', $charset);

$response = $dom->createElement('Response');
$dom->appendChild($response);

$_GET['action'] = strtolower($_GET['action']);

if(isset($_GET['action']) && $_GET['action'] == "play") {
	// play
	$play = $dom->createElement('Play');

	$url = $dom->createElement('Url',(empty($_GET['file']) ? "FIXME" : $_GET['file']));
	$play->appendChild($url);
	$response->appendChild($play);
}

if(isset($_GET['action']) && $_GET['action'] == "say") {
	// say
	$say = $dom->createElement('Say',$_GET['text']);
	$response->appendChild($say);
}


if(isset($_GET['action']) && $_GET['action'] == "busy") {
	// reject BUSY
	$reject = $dom->createElement('Reject');
	$rejectReason = $dom->createAttribute('reason');
	$rejectReason->value = 'busy';
	$reject->appendChild($rejectReason);
	$response->appendChild($reject);
}

if(isset($_GET['action']) && $_GET['action'] == "reject") {
	// reject REJECT
	$reject = $dom->createElement('Reject');
	$rejectReason = $dom->createAttribute('reason');
	$rejectReason->value = (isset($_GET['reason']) ? $_GET['reason'] : 'rejected');
	$reject->appendChild($rejectReason);
	$response->appendChild($reject);
}

if(isset($_GET['action']) && $_GET['action'] == "voicemail") {
	// dial VOICEMAIL
	$dial = $dom->createElement('Dial');
	$number = $dom->createElement('Voicemail');
	$dial->appendChild($number);
	$response->appendChild($dial);
}

if(isset($_GET['action']) && $_GET['action'] == "dial") {
	// dial 
	$dial = $dom->createElement('Dial');
	$number = $dom->createElement('Number',$_GET['number']);
	$dial->appendChild($number);
	$response->appendChild($dial);
}

if(isset($_GET['action']) && $_GET['action'] == "broken_tag") {
	// broken_tag
	$wurst = $dom->createElement('Wurst');
	$response->appendChild($wurst);
}

if(isset($_GET['action']) && $_GET['action'] == "broken_dial") {
	// dial 
	$dial = $dom->createElement('Dial');
	$response->appendChild($dial);
}

if(isset($_GET['sleep'])) {
	sleep($_GET['sleep']);
}

if(isset($_GET['action']) && $_GET['action'] == "randomsound") {
	$count = (isset($_GET['amount']) ? $_GET['amount'] : 1);

	for($i=0;$i<$count;$i++) {
		$play = $dom->createElement('Play');
		
		$urlPrefix = ($_SERVER['HTTPS'] ? "https" : "http")."://".$_SERVER['HTTP_HOST']."/wav/";
		$dir = opendir("./wav/");
		$files = array();
		while(false !== ($file = readdir($dir))) {
			if($file != "." && $file != "..") {
				$files[] = $file;
			}
		}
		$randomNumber = rand(0,count($files)-1);
		$randomUrl = $urlPrefix . urlencode($files[$randomNumber]);

		$url = $dom->createElement('Url',$randomUrl);
		$play->appendChild($url);
		$response->appendChild($play);
	}

	$hangup = $dom->createElement('Hangup');
	$response->appendChild($hangup);
}

if(isset($_GET['broken_header'])) {
	header('Content-type: foo/bar');
} else {
	header('Content-type: application/xml' . $additionalHeader);
}

if(isset($_GET['action']) && $_GET['action'] != "broken") {
	echo $dom->saveXML();
} else if(isset($_GET['action']) && $_GET['action'] == "broken") {
	echo '<?xml version="1.0" encoding="UTF-8"?><Response>Deine Mudda';
}
