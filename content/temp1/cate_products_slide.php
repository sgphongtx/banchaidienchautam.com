<?php
	$result = get_records("tbl_item_category","cate=1 and parent='$parent_l' and status=1","sort ASC,id DESC"," ",$lang);
	while ($row = mysqli_fetch_assoc($result)) :
		$parent = get_list_parent("tbl_item_category",$row['id'],$lang);
		$result1 = get_records("tbl_item","cate=1 and parent in ({$parent}) and status=1","sort ASC,id DESC","0,12".$sl,$lang);
		if (mysqli_num_rows($result1) > 0) :
?>
<div class="widget widget-static-block">
	<div class="product-by-category-wrap3 space-base">
		<div class="block-title">
			<div class="h3">
				<a href="<?php echo $row['link']!='' ? $row['link'] : $row['subject'].'/'; ?>"><?php echo $row['name']; ?></a>
			</div>
		</div>
		<div class="block-content">
			<div class="products-grid">
				<div data-owl="slide" data-desksmall="3" data-tabletsmall="2" data-mobile="1" data-tablet="3" data-margin="0" data-item-slide="3" data-ow-rtl="false" data-nav-text="false" data-loop="false" class="owl-carousel owl-theme products-slide product-items same-height clearfix">
               <?php $i=1; while ($row1 = mysqli_fetch_assoc($result1)) : ?>
               <div class="item product-item item-<?=$i?> col-md-12 col-xs-12">
						<div class="product-item-info">
							<div class="product-top">
								<a href="/<?php echo $row1['subject']?>.html" title="<?php echo $row1['name']; ?>" class="product-image" 
								<?php if($row_shop['tooltip']==0) : ?> 
									onmouseover="AJAXShowToolTip('show-tip/<?php echo $row1['id'];?>'); return false;" 
									onmouseout="AJAXHideTooltip();" 
								<?php endif; ?>>
									<img src="<?php echo $row1['image']=='' ? $noimgs : $path_image.$row1['image']; ?>" alt="<?php echo $row1['name']; ?>">
								</a>
							</div>
							<!-- product-top -->
							<div class="product-item-details">
								<h4 class="product-name">
									<a href="/<?php echo $row1['subject']?>.html" title="<?php echo $row1['name']; ?>"><?php echo $row1['name']; ?></a>
								</h4>
								<div class="price-box">
									<?php echo getPrice($row1['price'],$row1['pricekm']); ?>
								</div>
							</div>
                     <?php if ($row_config['btn_add_cart']==1) : ?>
                     <div class="button-holder">
                        <button type="button" class="btnMuaHang" idsp="<?=$row1['id']?>">
                           <i class="fa fa-shopping-cart"></i> <?=av('Thêm vào giỏ','Add to Cart')?>
                        </button>
                     </div>
                  	<?php endif; ?>
						</div>
					</div>
					<!-- product-item -->
					<?php $i++; endwhile; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
		endif;
	endwhile; 
?>
