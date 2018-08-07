<?php
$frame      = $_REQUEST['act'];

$row_shop = getRecord("tbl_shop","id='$idshop'");
$css = $row_shop['css'];

$row_config = getRecord("dm_config","idshop='$idshop'");	

?>