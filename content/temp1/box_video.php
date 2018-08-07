<div class="single-widget video-widget">
   <div class="h3 section-title">
      <?php echo module_keyword($mang11,$mang22,"box_video");?>
   </div>
   <div class="content-widget">
      <?php
         $result = get_records("tbl_video","status=1"," "," "," ");
         while($row_video = mysqli_fetch_assoc($result)) :
      ?>
      <div class="embed-responsive embed-responsive-4by3" id="video_return">
         <iframe class="embed-responsive-item" src="<?php echo get_video_youtobe($row_video['link']); ?>?autoplay=0"></iframe>
      </div>
      <?php endwhile; ?>
   </div>
</div>