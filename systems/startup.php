<?php
// Error Reporting
//error_reporting(E_ALL);

date_default_timezone_set('Asia/Ho_Chi_Minh');

// Check if SSL
if ((isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) || $_SERVER['SERVER_PORT'] == 443) {
	$_SERVER['HTTPS'] = true;
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
	$_SERVER['HTTPS'] = true;
} else {
	$_SERVER['HTTPS'] = false;
}

// Database
require_once(DIR_SYSTEM . 'database/database.php');

// Session
session_start();

// Func
require_once(DIR_SYSTEM . 'core/func.php');

// Helper
require_once(DIR_SYSTEM . 'helper/general.php');
require_once(DIR_SYSTEM . 'helper/getDataSitemap.php');
require_once(DIR_SYSTEM . 'helper/token.php');

// Language
$parent_l=0;
$lang = $_SESSION['luu_lang_x'];
if ($lang=='' || $row_shop['multi_lang']==0) {
	$lang = $row_shop['default_lang'];
}

$keyword_index = getRecord('tbl_keyword', "idshop='{$idshop}' AND  parent='{$lang}' ");
if($keyword_index['title_module']!="") {
	$mang1 = get_field("tbl_template","id",$row_shop['idtemplate'],"list_title_module");
	$mang2 = $keyword_index['title_module'];
}else{
	$mang1 = get_field("tbl_template","id",$row_shop['idtemplate'],"list_title_module");
	if($lang==2) $mang2=get_field("tbl_template","id",$row_shop['idtemplate'],"title_module2");
	else $mang2=get_field("tbl_template","id",$row_shop['idtemplate'],"title_module1");
}

$mang11=explode(",", $mang1);
$mang22=explode(",", $mang2);

?>