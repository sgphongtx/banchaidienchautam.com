<?php
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
	ob_start("ob_gzhandler"); 
else ob_start();

// HTTP
define('HTTP_SERVER', 'http://'.$_SERVER['HTTP_HOST'] . '/quantri/');
define('HTTP_SHOP', 'http://'.$_SERVER['HTTP_HOST']);

// HTTP
define('HTTPS_SERVER', 'https://'.$_SERVER['HTTP_HOST'] . '/quantri/');
define('HTTPS_SHOP', 'https://'.$_SERVER['HTTP_HOST']);

// DIR
define('DIR_SYSTEM', '../systems/');
define('PATH_TEMPLATES', 'view/templates/');
define('__PATH_UPLOAD__', "");
define('__PATH_NOIMAGE__', "/uploads/others/default.png");

$idshop     = 363;
$ngay       = date("Y-m-d H:i:s");
	
?>