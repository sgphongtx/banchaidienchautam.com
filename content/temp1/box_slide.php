<div class="single-widget slide-widget">
   <div class="h3 section-title">
      <?php echo module_keyword($mang11,$mang22,"box_slide");?>
   </div>
   <div class="content-widget">
      <div class="image-slider"> 
      	<div data-owl="slide" data-desksmall="1" data-tabletsmall="1" data-mobile="1" data-tablet="1" data-margin="0" data-item-slide="1" data-ow-rtl="false" data-nav="false" data-autoplay="true" data-loop="true" data-delay="3000" data-duration="3000" class="owl-carousel owl-theme products-slide">
				<?php
					$result = get_records("tbl_slider","cate=2 and status=1"," ","0,6"," ");
					while ($row = mysqli_fetch_assoc($result)) :
				?>
				<div class="item">
					<a href="<?php echo $row['link'] != '' ? $row['link'] : '/'?>" title="<?php echo $row['name']?>" target="_blank">
						<img  src="<?php echo $path_image.'/'.$row['image']?>" alt="<?php echo $row['name']?>"/>
				  	</a>
				</div>
				<?php endwhile; ?>
      	</div>			
      </div>        
   </div>
</div>
