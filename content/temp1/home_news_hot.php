<div class="widget widget-static-block">
   <div class="best-news-wrap space-base bg-white">
      <div class="block-title">
         <div class="h3"><?php echo module_keyword($mang11, $mang22, "home_news_hot"); ?></div>
      </div>
      <div class="block-content">
         <div class="col-md-6 col-sm-6">
            <?php 
               $result1 = get_records("tbl_item","cate=2 and status=1 and hot=1"," ","0,5",$lang);
               if (mysqli_num_rows($result1) > 0) :
               $row1 = mysqli_fetch_assoc($result1); 
            ?>
            <div class="block-post block-first-post">
               <div class="block-post-img">
                  <a href="/<?php echo $row1['subject']; ?>.html" title="<?php echo $row1['name']; ?>">
                     <img src="<?php echo $path_image.$row1['image']; ?>" alt="<?php echo $row1['name']; ?>">
                  </a>
               </div>
               <div class="block-post-content">
                  <h4 class="block-post-title">
                     <a href="/<?php echo $row1['subject']; ?>.html" title="<?php echo $row1['name']; ?>">
                        <?php echo $row1['name']; ?>
                     </a>
                  </h4>
                  <div class="meta-post">
                     <i class="fa fa-calendar"></i>
                     <?php echo dateFormat($row1['date_added'],$lang); ?>
                  </div>
                  <div class="desc post-description">
                     <?php echo catchuoi_tuybien(strip_tags($row1['detail_short']),20); ?>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-sm-6">
            <?php while ($row1 = mysqli_fetch_assoc($result1)) : ?>
            <div class="block-post block-other-post clearfix">
               <div class="block-post-img">
                  <a href="/<?php echo $row1['subject']; ?>.html" title="<?php echo $row1['name']; ?>">
                     <img src="<?php echo $path_image.$row1['image']; ?>" alt="<?php echo $row1['name']; ?>">
                  </a>
               </div>
               <div class="block-post-content">
                  <h4 class="block-post-title">
                     <a href="/<?php echo $row1['subject']; ?>.html" title="<?php echo $row1['name']; ?>">
                        <?php echo $row1['name']; ?>
                     </a>
                  </h4>
                  <div class="meta-post">
                     <i class="fa fa-calendar"></i>
                     <?php echo dateFormat($row1['date_added'],$lang); ?>
                  </div>
                  <div class="desc post-description">
                     <?php echo catchuoi_tuybien(strip_tags($row1['detail_short']),20); ?>
                  </div>
               </div>
            </div>
            <?php endwhile; endif; ?>
         </div>
         <div class="clearfix"></div>
      </div>
   </div>
</div>
