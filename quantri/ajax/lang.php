<?php
	$lang = $_GET['lang'];

	$_SESSION['luu_lang_x']=$lang;
	
	header("Location:".url_direct());
?>