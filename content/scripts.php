
<script type="text/javascript" src="/public/templates/content/plugins/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/public/templates/content/plugins/OwlCarousel2/2.2.1/dist/owl.carousel.min.js"></script>
<?php if ($frame=='product_detail') { ?>
<script type="text/javascript" src='/public/templates/content/plugins/elevatezoom/3.0.8/jquery.elevatezoom.min.js'></script>
<script type="text/javascript" src='/public/templates/content/plugins/fancyBox/2.1.5/jquery.fancybox.min.js'></script>
<?php } ?>
<script type="text/javascript" src="/public/templates/content/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
<?php if ($row_shop['is_mobile']==1) { ?>
<script type="text/javascript" src="/public/templates/content/plugins/jquery.mmenu/js/jquery.mmenu.all.min.js"></script>
<?php } ?>
<?php if ($row_shop['tooltip']==0) : ?>
<script type="text/javascript" src="/public/templates/content/plugins/toolstip/ajax.js"></script>
<script type="text/javascript" src="/public/templates/content/plugins/toolstip/ajax-dynamic-content.js"></script>
<script type="text/javascript" src="/public/templates/content/plugins/toolstip/home.js"></script>
<?php endif; ?>
<?php if($row_config['adv_scroll'] != 0) { ?>
<script type="text/javascript" src="/public/templates/content/js/floater_xlib.js"></script>
<?php } ?>
<script type="text/javascript" src="/public/templates/content/js/global.js"></script>
<script type="text/javascript" src="/public/templates/content/plugins/simplyscroll/jquery.simplyscroll.js"></script>

<script type="text/javascript">
(function($) {
	$(function() { //on DOM ready
		$("#scroller").simplyScroll({
			customClass: 'vert',
			orientation: 'vertical',
            auto: true,
            manualMode: 'loop',
			frameRate: 20,
			speed: 2
		});
	});
})(jQuery);
</script>