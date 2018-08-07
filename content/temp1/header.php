<?php
if(get_field("tbl_seo","idshop",$idshop,"id")!="") {
	$seo=getRecord("tbl_seo", "idshop=".$idshop);
}
if($seo['googleverify']!=""){
?>
<!-- google-site-verification -->
<meta name="google-site-verification" content="<?php echo $seo['googleverify'];?>" />
<?php }?>
<?php if($seo['alexaVerifyID']!=""){ ?>
<!-- alexa -->
<meta name="alexaVerifyID" content="<?php echo $seo['alexaVerifyID'];?>" />
<?php }?>
<?php if ($row_shop['is_mobile']==1) { ?><link rel="stylesheet" type="text/css" href="/public/templates/content/plugins/bootstrap/3.3.7/css/bootstrap.min.css"><?php } else { ?><link type="text/css" rel="stylesheet" href="/public/templates/content/css/themes.css" /><?php } ?>
<link type="text/css" rel="stylesheet" href="/public/templates/content/plugins/OwlCarousel2/2.2.1/dist/assets/owl.carousel.min.css" />
<link type="text/css" rel="stylesheet" href="/public/templates/content/plugins/OwlCarousel2/2.2.1/dist/assets/owl.theme.default.min.css" />
<link rel="stylesheet" type="text/css" href="/public/templates/content/plugins/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/public/templates/content/plugins/fancyBox/2.1.5/jquery.fancybox.min.css" />
<link rel="stylesheet" type="text/css" href="/public/templates/content/plugins/animate.css/3.5.2/animate.min.css"/>
<link type="text/css" rel="stylesheet" href="/public/templates/content/plugins/magnific-popup/magnific-popup.css" />
<link type="text/css" rel="stylesheet" href="/public/templates/content/plugins/simplyscroll/jquery.simplyscroll.css" />
<link type="text/css" rel="stylesheet" href="/public/templates/content/plugins/jquery.mmenu/css/styles.css" />
<?php if ($row_shop['is_mobile']==1) { ?><link type="text/css" rel="stylesheet" href="/public/templates/content/plugins/jquery.mmenu/css/jquery.mmenu.all.css" /><?php } ?>
<?php if ($row_shop['tooltip']==0) : ?><link rel="stylesheet" type="text/css" href="/public/templates/content/plugins/toolstip/toolstip.css" /><?php endif; ?>
<?php if ($css=="" && $row_shop['is_mobile']!=0) { ?><link rel="stylesheet" type="text/css" href="/public/templates/content/css/reset.css"/><?php } else { file_put_contents('styleweb.css',$css); } ?>
<link rel="stylesheet" type="text/css" href="/styleweb.css"/>
<script type="text/javascript" src="/public/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src='/public/templates/content/js/jquery.validate.js'></script>

<link type="text/css" rel="stylesheet" href="/public/css/ihover/ihover.css" />
<script type="text/javascript" src='/public/css/ihover/ihover.js'></script>
<!--[if IE 6]>
	<script type="text/javascript" src="skin/temp1/scripts/DD_belatedPNG_0.0.8a.js"></script>
	<script>
	  DD_belatedPNG.fix('img, div, span, a, h1, h2, h3, h4, h5, h6, p, table');
	</script>
<![endif]-->

<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="web/assets/stylesheet/FIX_IE.css" />
<![endif]-->

<script type="application/ld+json">{"@context":"http://schema.org","@type":"Organization","name":"Code-Update","url":"<?=$linkroot?>","sameAs":["<?=$row_config['box_face']?>","https://plus.google.com/111823897907449299887"]}</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo $seo['uagoogle'] ?>', 'auto');
  ga('send', 'pageview');

</script>
