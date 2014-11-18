<?php

require_once("sipgateio.class.php");


$fromNumber = $_POST['from'];
$toNumber = $_POST['to'];


$additionalHeader = "";
$charset = "UTF-8";
if(isset($_GET['charset']) && $_GET['charset'] == "iso") {
	$additionalHeader = "; charset=ISO-8859-1";
	$charset = "ISO-8859-1";
}

$sipgateio = new SipgateIO(null,$charset);

$_GET['action'] = strtolower($_GET['action']);

if(isset($_GET['action']) && $_GET['action'] == "play") {
	$sipgateio->play((empty($_GET['file']) ? "FIXME" : $_GET['file']));
}

if(isset($_GET['action']) && $_GET['action'] == "say") {
	$sipgateio->say($_GET['text']);
}

if(isset($_GET['action']) && $_GET['action'] == "busy") {
	$sipgateio->reject("busy");
}

if(isset($_GET['action']) && $_GET['action'] == "reject") {
	$sipgateio->reject();
}

if(isset($_GET['action']) && $_GET['action'] == "voicemail") {
	$sipgateio->voicemail();
}

if(isset($_GET['action']) && $_GET['action'] == "dial") {
	$sipgateio->dial($_GET['number']);
}

if(isset($_GET['action']) && $_GET['action'] == "broken_tag") {
	$sipgateio->customTag("Wurst");
}

if(isset($_GET['action']) && $_GET['action'] == "broken_dial") {
	$sipgateio->dial("");
}

if(isset($_GET['sleep'])) {
	sleep($_GET['sleep']);
}

if(isset($_GET['action']) && $_GET['action'] == "randomsound") {
	$count = (isset($_GET['amount']) ? $_GET['amount'] : 1);

	$urlPrefix = ($_SERVER['HTTPS'] ? "https" : "http")."://".$_SERVER['HTTP_HOST']."/wav/";
	$dir = opendir("./wav/");
	$files = array();
	while(false !== ($file = readdir($dir))) {
		if($file != "." && $file != "..") {
			$files[] = $file;
		}
	}

	for($i=0;$i<$count;$i++) {
		$randomNumber = rand(0,count($files)-1);
		$sipgateio->play($urlPrefix . urlencode($files[$randomNumber]));
	}

	$sipgateio->hangup();
}

if(isset($_GET['broken_header'])) {
	header('Content-type: foo/bar');
} else {
	header('Content-type: application/xml' . $additionalHeader);
}

if(isset($_GET['action']) && $_GET['action'] != "broken") {
	echo $sipgateio->getResponseXML();
} else if(isset($_GET['action']) && $_GET['action'] == "broken") {
	echo '<?xml version="1.0" encoding="UTF-8"?><Response>Deine Mudda';
}
