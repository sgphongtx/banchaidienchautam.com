<div class="widget widget-static-block">
	<div class="new-product-wrap space-base">
		<div class="block-title">
			<h3><?php echo module_keyword($mang11,$mang22,"product_new");?></h3>
		</div>
		<div class="block-content">
			<div class="products-grid">
				<ul class="row product-items same-height clearfix">
					<?php
						$sl= get_field("tbl_module","idshop",$row_shop['id'],"sl1");
						if($sl == "") $sl=9;
						$i=1;
						$result = get_records("tbl_item","cate=1 and status=1","id desc","0,".$sl,$lang);
						while($row = mysqli_fetch_assoc($result)) :
					?>
					<li class="item product-item item-<?=$i?> col-md-4 col-sm-3 col-xs-12">
						<div class="product-item-info">
							<div class="product-top">
								<a href="/<?php echo $row['subject']?>.html" title="<?php echo $row['name']; ?>" class="product-image" 
								<?php if($row_shop['tooltip']==0) : ?> 
									onmouseover="AJAXShowToolTip('show-tip/<?php echo $row['id'];?>'); return false;" 
									onmouseout="AJAXHideTooltip();" 
								<?php endif; ?>>
									<img src="<?php echo $row['image']=='' ? $noimgs : $path_image.$row['image']; ?>" alt="<?php echo $row['name']; ?>">
								</a>
							</div>
							<!-- product-top -->
							<div class="product-item-details">
								<h4 class="product-name">
									<a href="/<?php echo $row['subject']?>.html" title="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></a>
								</h4>
								<div class="price-box">
									<?php echo getPrice($row['price'],$row['pricekm']); ?>
								</div>
							</div>
							<?php if ($row_config['btn_add_cart']==1) : ?>
                     <div class="button-holder">
                        <button type="button" class="btnMuaHang" idsp="<?=$row['id']?>">
                           <i class="fa fa-shopping-cart"></i> <?=av('Thêm vào giỏ','Add to Cart')?>
                        </button>
                     </div>
                  	<?php endif; ?>
						</div>
					</li>
					<!-- product-item -->
					<?php $i++; endwhile; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
