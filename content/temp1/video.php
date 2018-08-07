<div class="video-widget">
   <div class="block-title">
      <h3>
         <?php echo module_keyword($mang11,$mang22,"box_video");?>
      </h3>
   </div>
   <div class="content-widget row">
      <?php
         $result = get_records("tbl_video","status=1"," ","0,12 "," ");
         while($row_video = mysqli_fetch_assoc($result)) :
      ?>
      <div class="col-md-6" style="padding-bottom: 20px;">
         <div class="embed-responsive embed-responsive-4by3 " id="video_return">
            <iframe class="embed-responsive-item" src="<?php echo get_video_youtobe($row_video['link']); ?>?autoplay=0"></iframe>
         </div>
      </div>
      <?php endwhile; ?>
   </div>
</div>