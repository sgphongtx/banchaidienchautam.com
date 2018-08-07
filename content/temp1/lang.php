<?php
	
	include('config_ajax.php');
	
	
	$lang=$_GET['lang'];
	$_SESSION['luu_lang_x']=$lang;
	
	header("Location:".$linkroot);	
?>