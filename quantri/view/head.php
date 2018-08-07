<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="direction" lang="<?=get_one_field("tbl_language","id='".$row_shop['default_lang']."'","","code")?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="direction" lang="<?=get_one_field("tbl_language","id='".$row_shop['default_lang']."'","","code")?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="direction" lang="<?=get_one_field("tbl_language","id='".$row_shop['default_lang']."'","","code")?>" xmlns="http://www.w3.org/1999/xhtml">
<!--<![endif]-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<base href="<?php echo HTTPS_SERVER ?>">
		<title>Admin</title>
		<meta name="author" content="webmau.vn" />
		<meta name="robots" content="noindex, nofollow" />
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0" />

		<link rel="stylesheet" type="text/css" href="/public/templates/quantri/plugins/oneui-fw/css/bootstrap.min-1.4.css" />
		<link rel="stylesheet" type="text/css" href="/public/templates/quantri/plugins/oneui-fw/css/oneui.min-1.5.css" />
		<link rel="stylesheet" type="text/css" href="/public/templates/quantri/plugins/fancybox/source/jquery.fancybox.css" />
		<link rel="stylesheet" type="text/css" href="/public/templates/quantri/css/css.css" />
		
		<script type="text/javascript">var root = '<?php echo HTTPS_SHOP ?>'; </script>
		<script type="text/javascript" src="/public/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="/public/templates/quantri/plugins/oneui-fw/js/oneui.min-1.4.js"></script>
		<script type="text/javascript" src="/public/templates/quantri/plugins/fancybox/source/jquery.fancybox.js"></script>
		<script type="text/javascript" src="../filemanager/js/tinymce/tinymce.min.js"></script>
		<script type="text/javascript" src="../filemanager/js/tinymce/tinymce.config.js"></script>
		<script type="text/javascript" src="/public/templates/quantri/js/jquery.number.min.js"></script>
		<script type="text/javascript" src="/public/templates/quantri/js/custom.js"></script>

	</head>
	<body>
		<div id="page-loader"></div>