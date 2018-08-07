<div class="single-widget support-widget">
   <div class="h3 section-title">
      <?php echo module_keyword($mang11,$mang22,"box_support");?>
   </div>
   <div class="content-widget">
      <?php
         $support = get_records("tbl_support","status=1 AND idshop='{$idshop}' "," "," "," ");
         while ($row_support = mysqli_fetch_assoc($support)) :
      ?>
      <div class="agent-small">
         <div class="h4 agent-small-title"><?php echo $row_support['name']; ?></div>
         <div class="agent-small-inner">
            <div class="agent-small-image">
               <a class="agent-small-image-inner">
                  <img src="<?php echo $path_image.$row_support['image']; ?>" alt="<?php echo $row_support['name']; ?>">
               </a>
            </div>
            <!-- agent-small-image -->
            <div class="agent-small-content">
               <?php if ($row_support['nickyahoo'] != '') : ?>
               <div class="agent-small-zalo">
                  <a href='http://zalo.me/<?php echo $row_support['nickyahoo'] ?>' title="<?php echo $row_support['nickyahoo'] ?>">
                     <?php echo $row_support['nickyahoo'] ?>
                  </a>
               </div>
               <?php endif; ?>
               <?php if ($row_support['nickskype'] != '') : ?>
               <div class="agent-small-skype">
                  <a href="skype:<?php echo $row_support['nickskype'] ?>?call">
                     <?php echo $row_support['nickskype'] ?>
                  </a>
               </div>
               <?php endif; ?>
               <?php if ($row_support['dienthoai'] != '') : ?>
               <div class="agent-small-tel">
                  <a href="tel:<?php echo str_replace(" ", "", $row_support['dienthoai']) ?>">
                     <?php echo $row_support['dienthoai']; ?>
                  </a>
               </div>
               <?php endif; ?>
            </div>
            <!-- agent-small-content -->
         </div>
      </div>
      <!-- agent-small -->
      <?php endwhile; ?>
   </div>
</div>
