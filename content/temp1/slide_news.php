<div class="widget widget-static-block">
	<div class="slide-news-wrap space-base">
		<div class="block-title">
			<div class="h3"><?php echo module_keyword($mang11, $mang22, "slide_news"); ?></div>
		</div>
		<div class="block-content">
			<div class="products-grid">
				<div data-owl="slide" data-desksmall="3" data-tabletsmall="2" data-mobile="1" data-tablet="3" data-margin="0" data-item-slide="3" data-ow-rtl="false" data-nav-text="false" data-loop="false" class="owl-carousel owl-theme products-slide product-items same-height clearfix">
					<?php
						$i=1;
						$result1 = get_records("tbl_item","cate=2 and status=1","sort ASC,id DESC","0,12",$lang); 
						while ($row1 = mysqli_fetch_assoc($result1)) : 
					?>
					<div class="item product-item item-<?=$i?> col-md-12 col-xs-12">
						<div class="product-item-info">
							<div class="product-top">
								<a href="/<?php echo $row1['subject']?>.html" title="<?php echo $row1['name']; ?>" class="product-image">
									<img src="<?php echo $row1['image']=='' ? $noimgs : $path_image.$row1['image']; ?>" alt="<?php echo $row1['name']; ?>">
								</a>
							</div>
							<!-- product-top -->
							<div class="product-item-details">
								<h4 class="product-name">
									<a href="/<?php echo $row1['subject']?>.html" title="<?php echo $row1['name']; ?>"><?php echo $row1['name']; ?></a>
								</h4>
								<div class="meta-post">
									<i class="fa fa-calendar"></i>
									<?php echo dateFormat($row1['date_added'],$lang); ?>
								</div>
								<div class="desc product-item-description">
									<?php echo catchuoi_tuybien(strip_tags($row1['detail_short']),10); ?>
								</div>
							</div>
						</div>
					</div>
					<!-- product-item -->
					<?php $i++; endwhile; ?>
				</div>
			</div>
		</div>
	</div>
</div>
