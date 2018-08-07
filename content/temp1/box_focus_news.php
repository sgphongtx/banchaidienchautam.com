<div class="single-widget focus-news-widget">
	<div class="h3 section-title">
		<?php echo module_keyword($mang11,$mang22,"box_focus_news");?>
	</div>
	<div class="content-widget">
		<ul class="list-post"> 
			<?php
				$result = get_records("tbl_item","cate=2 and hot=1 and status=1","id DESC","0,5",$lang);
				while ($row = mysqli_fetch_assoc($result)) :
			?>
			<li class="post-item">
				<div class="ma-item">
					<div class="item-content">
						<div class="pull-left post-images">
							<a class="post-image" href="<?php echo $row['subject']; ?>.html" title="<?php echo $row['name']; ?>">
								<img src="<?php echo $path_image.$row['image']; ?>" alt="<?php echo $row['name']; ?>">
							</a>
						</div>
						<div class="post-des">
							<h4 class="post-name">
								<a class="post-image" href="<?php echo $row['subject']; ?>.html" title="<?php echo $row['name']; ?>">
									<?php echo $row['name']; ?>
								</a>
							</h4>
							<div class="meta-post">
								<i class="fa fa-calendar"></i>
								<?php echo dateFormat($row['date_added'],$lang); ?>
							</div>
							<p><?php echo catchuoi_tuybien($row['detail_short'],10); ?></p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div
			</li>
			<?php endwhile; ?>
		</ul>        
	</div>
</div>
