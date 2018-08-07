
    <?php
    	$rs_cate = get_records("tbl_item_category","cate=1 AND status=1","id ASC","0,4",$lang);
    	if(mysqli_num_fields($rs_cate) > 0) :
    ?>

    <div class="category  container ">
      <div class="row">
       	<div class="same-height clearfix dmsp1">
          	<?php while($row_cate = mysqli_fetch_assoc($rs_cate)) : ?>
           	<div class="product-item col-md-3 col-sm-3 col-xs-12 text-center  ">
              <div class="product-item-info ">
        	      <div class="product-top product-top1 ">
                  	<a href="<?php echo $row_cate['link'] != '' ? $row_cate['link'] : '/'.$row_cate['subject'].'/' ?>">
                      	<img class="img-circle" src="<?php echo $path_image.($row_cate['image'] != '' ? $row_cate['image'] : $noimgs) ?>" alt="<?php echo $row_cate['name'] ?>">
                  	</a>
              	</div>
                <div class="" style="padding:10px;">
                  	<a href="<?php echo $row_cate['link'] != '' ? $row_cate['link'] : '/'.$row_cate['subject'].'/' ?>"><?php echo $row_cate['name'] ?></a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
    <?php endif; ?>
<style>
.btn01{
  
	margin-top: 10px;
}
	.buttons a{
		color:#fff;
    text-transform: uppercase;
	}
  .dmsp1 a{
    color:#04799b;
    font-weight: bold;
  }
</style>