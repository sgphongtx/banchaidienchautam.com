<div class="single-widget download-widget">
   <h3 class="section-title">
      <?php echo module_keyword($mang11,$mang22,"box_download");?>
   </h3>
   <div class="content-widget">
      <?php
         $result = get_records("tbl_document","status=1","id DESC","0,5"," ");
         while ($row_dl = mysqli_fetch_assoc($result)) :
      ?>
      <a href="<?php echo $path_image.'/'.$row_dl['url']; ?>">
         <i class="fa fa-download"></i>
         <?php echo $row_dl['name']; ?>            
      </a>
      <?php endwhile; ?>
   </div>
</div>
