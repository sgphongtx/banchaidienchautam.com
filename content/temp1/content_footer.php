<footer id="site-footer">
	<?php include("content/".$template."/footer.php");?>
</footer>
<div class="showdt">
<a class="suntory-alo-phone  suntory-alo-green pc-only" id="suntory-alo-phoneIcon"  href="tel:<?=$row_shop['hotline']?>" style="left: 0px; bottom: 3%;">
	<div class="suntory-alo-ph-circle"></div>
	<div class="suntory-alo-ph-circle-fill"></div>
	<div class="suntory-alo-ph-img-circle">
	<i class="fa fa-phone"></i></div>
	<div class="phone-pc"><?=$row_shop['hotline']?></div>
</a>
<script type="text/javascript">
	$('#suntory-alo-phoneIcon').on('click', function () {
	  $('.phone-pc').toggleClass('show-phone');
	});
</script>
<!-- Telephone action -->
<a href="tel:<?=$row_shop['hotline']?>" class="suntory-alo-phone suntory-alo-phone-<?=$key?> suntory-alo-green mobile-only">
	<div class="suntory-alo-ph-circle"></div>
	<div class="suntory-alo-ph-circle-fill"></div>
	<div class="suntory-alo-ph-img-circle">
	<i class="fa fa-phone"></i></div>
</a>
</div>