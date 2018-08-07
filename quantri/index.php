<?php
header('X-XSS-Protection:0');
// Version
define('VERSION', '1.0.0.4');

// Configuration
if (is_file('config.php')) {
	require_once 'config.php';
}

// Startup
require_once DIR_SYSTEM . 'startup.php';

require_once 'view/head.php';
if (isset($_SESSION['user']['id'])) {
	$__token = new Csrf(true, false, true); require_once 'view/content.php';
} elseif ($frame=='reminder_password') {
	require_once 'reminder_password.php';
} else {
	require_once 'login.php';
}

mysqli_close($conn);
?>