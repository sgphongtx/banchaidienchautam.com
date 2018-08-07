<?php
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
	ob_start("ob_gzhandler"); 
else ob_start();

// HTTP
define('HTTP_SERVER', 'http://'.$_SERVER['HTTP_HOST']);

// HTTPS
define('HTTPS_SERVER', 'https://'.$_SERVER['HTTP_HOST']);

// DIR
define('DIR_SYSTEM', __DIR__ . '/systems/');

$idshop     = 363;
$linkroot   = HTTPS_SERVER;
$ngay       = date("Y-m-d H:i:s");
$noimgs     = "/uploads/others/default.png";
$path_image = $linkroot;
	
?>