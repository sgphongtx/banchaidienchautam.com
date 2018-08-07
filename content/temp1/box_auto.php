<?php $row = getRecord("tbl_item","cate=3 and type=0 and lang=$lang");?>
<div class="single-widget auto-widget">
   <div class="h3 section-title">
      <?php echo $row['name'];?>
   </div>
   <div class="content-widget">
      <?php echo stripslashes($row['detail']);?>
   </div>
</div>
