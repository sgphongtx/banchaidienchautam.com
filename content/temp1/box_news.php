<div class="single-widget news-widget">
	<div class="h3 section-title">
		<?php echo module_keyword($mang11,$mang22,"box_news");?>
	</div>
	<div class="content-widget">
		<ul class="list-post" id=""> 
			<?php
				$result = get_records("tbl_item","cate=2 and status=1","id DESC","0,5",$lang);
				while ($row = mysqli_fetch_assoc($result)) :
			?>
			<li class="post-item">
				<div class="ma-item">
					<div class="item-content">
						<div class="pull-left post-images col-md-5" style="padding-left: 0; padding-right: 0;">
							<a class="post-image" href="/<?php echo $row['subject']; ?>.html" title="<?php echo $row['name']; ?>">
								<img src="<?php echo $path_image.$row['image']; ?>" alt="<?php echo $row['name']; ?>">
							</a>
						</div>
						<div class="post-des col-md-7">
							<h4 class="post-name">
								<a class="post-image" href="/<?php echo $row['subject']; ?>.html" title="<?php echo $row['name']; ?>">
									<?php echo $row['name']; ?>
								</a>
							</h4>
							<!-- <p><?php echo catchuoi_tuybien($row['detail_short'],5); ?></p> -->
						</div>
						<div class="clearfix"></div>
					</div>
				</div
			</li>
			<?php endwhile; ?>
		</ul>        
	</div>
</div>
<script type="text/javascript">
(function($) {
	$(function() {
		$("#scroller").simplyScroll({orientation:'vertical',customClass:'vert'});
	});
})(jQuery);
</script>