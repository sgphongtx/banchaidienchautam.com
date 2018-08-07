<?php
// Version
define('VERSION', '1.0.0.4');

// Configuration
if (is_file('config.php')) {
	require_once('config.php');
}
// Startup
require_once(DIR_SYSTEM . 'startup.php');
?>
<?php //echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n"; ?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="direction" lang="<?=get_one_field("tbl_language","id='".$row_shop['default_lang']."'","","code")?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="direction" lang="<?=get_one_field("tbl_language","id='".$row_shop['default_lang']."'","","code")?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="direction" lang="<?=get_one_field("tbl_language","id='".$row_shop['default_lang']."'","","code")?>" xml:lang="<?=get_one_field("tbl_language","id='".$row_shop['default_lang']."'","","code")?>" xmlns="http://www.w3.org/1999/xhtml">
<!--<![endif]-->
<head>
<?php include("content/title.php");?>
<?php
   $url=get_field("tbl_template","id",$row_shop['idtemplate'],"url");
	$template = "temp1";
?>
<?php include("content/".$template."/header.php");?>
</head>

<body class="class_body_t<?=$frame=='page404'?' error404':''?>"<?=$row_shop['is_mobile']==0?' style="min-width: 1170px;"':''?>>
<?php //echo !extension_loaded('openssl')?"Not Available":"Available"; ?>
	<?php 
		if ($frame=='page404') 
			include ("content/".$template."/page404.php");
		else 
			include("content/".$template."/content.php");
	?>

	<?php
		$rowtin=getRecord("tbl_ad", "status=1 and idshop='".$idshop."' and cate=5");
		switch($rowtin['bg_position']){
			case 0 : $bg_repeat="repeat-x";break;
			case 1 : $bg_repeat="repeat-y";break;
			case 2 : $bg_repeat="repeat";break;
			case 3 : $bg_position="fixed";break;
		}
	?>
	<?php if($rowtin['image']!="") : ?>
	<style type="text/css">
		.class_body_t {
			background-color: transparent;
			background-image: url('<?php echo $path_image.$rowtin['image']?>');
			background-repeat: <?=$rowtin['bg_position'] != 3 ? $bg_repeat : 'no-repeat'?>;
			background-attachment: <?=$rowtin['bg_position'] == 3 ? $bg_position : 'scroll'?>;
			background-position: center top;
			background-size: auto auto;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function() {
		   $("body").removeClass("class_body");
			$("body").addClass("class_body_t");
		});
	</script>
	<?php endif; ?>
	
	<!-- Load Facebook SDK for JavaScript -->
	<div id="fb-root"></div>
	<script>
	window.fbAsyncInit = function() {
		FB.init({
		appId      : '1586382511656268',
		xfbml      : true,
		version    : 'v2.7'
		});
	};

  	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
	</script>

	<?php if ($row_shop['zopim']!='') echo $row_shop['zopim'] ?>
	<!--Start of Tawk.to Script-->
	<!--End of Tawk.to Script-->
</body>
</html>
<?php mysqli_close($conn); ?>