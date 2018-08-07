<?php 
$URI            = substr($_SERVER["REQUEST_URI"],1);
$arr_uri        = explode("/",$URI);
if (!$arr_uri[1]) header("Location:/404-page-not-found.html");
$_SESSION["currency"] = $arr_uri[1];

header("Location:/");
 ?>