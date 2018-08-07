<div class="single-widget adv-widget">
   <div class="h3 section-title">
      <?php echo module_keyword($mang11,$mang22,"box_ad");?>
   </div>
   <div class="content-widget">
      <?php
         $result = get_records("tbl_ad","cate=0 and status=1"," "," "," ");
         while($row_ad = mysqli_fetch_assoc($result)) :
      ?>
      <a href="<?php echo $row_ad['link'] ?>" title="<?php echo $row_ad['name'] ?>" target="_blank">
         <img src="<?php echo $path_image ;?>/<?php echo $row_ad['image'] ?>" alt="<?=$row_ad['name']?>" />
      </a>
      <?php endwhile; ?>
   </div>
</div>