<div class="widget widget-static-block">
	<div class="slider-wrap space-base">
		<div class="owl-w-effect owl-carousel owl-theme">
			<?php
			  $result = get_records("tbl_slider","cate=1 and status=1","sort asc"," "," ");
			  while ($row_q = mysqli_fetch_assoc($result)) :
			?>
			<div class="item">
				<a href="<?php echo $row_q['link']; ?>">
					<img src="<?php echo $path_image.$row_q['image']; ?>" alt="<?php echo $row_q['name']; ?>">
				</a>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$('.owl-w-effect').owlCarousel({
			animateOut: "fadeOut",
		   items:1,
		   loop: true,
		   nav: false,
		   dots: true,
		   autoplay: true,
		   smartSpeed: 3000
		});
	});	
</script>