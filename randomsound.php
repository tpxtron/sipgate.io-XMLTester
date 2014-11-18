<?php

header('Content-type: application/xml');
echo file_get_contents("http://sipgateio.rollercoder.de/?action=randomsound&amount=".(isset($_GET['amount'])?$_GET['amount']:1));
