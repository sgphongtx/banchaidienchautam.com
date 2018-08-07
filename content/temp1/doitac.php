<div class="widget widget-static-block">
	<div class="brand-slider-wrap space-base">
	  	<div class="block-title">
			<div class="h3"><?php echo module_keyword($mang11,$mang22,"doitac");?></div>
	  	</div>
	  	<div class="block-content">
			<div class="brand-slider">
			 	<div data-owl="slide" data-desksmall="4" data-tabletsmall="2" data-mobile="1" data-tablet="3" data-margin="0" data-item-slide="4" data-ow-rtl="false" data-nav="false" data-autoplay="true" data-loop="true" class="owl-carousel owl-theme products-slide product-items same-height clearfix">
				 	<?php
						$result = get_records("tbl_slider","cate=3 and status=1"," "," "," ");
						while($row = mysqli_fetch_assoc($result )) :
					?>
					<div class="item col-md-12 col-xs-12">
						<a href="<?php echo $row['link']; ?>" title="<?php echo $row['name']; ?>">
							<img src="<?php echo $path_image.$row['image']; ?>" alt="<?php echo $row['name']; ?>">
						</a>
					</div>
					<?php endwhile; ?>
			 	</div>
			</div>
	  	</div>
	</div>
</div>
