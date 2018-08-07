<?php
	$sl = get_field("tbl_module","idshop",$row_shop['id'],"sl4");
	if ($sl>0) $limit = $sl;
	else $limit = 3;
?>
<div class="single-widget">
	<h3 class="section-title">
		<?php echo module_keyword($mang11,$mang22,"sell_product");?>
	</h3>
	<div class="content-widget selling-products-widget">
		<ul class="list-product">
			<?php
				$result = get_records("tbl_item","cate=1 and status=1","buy DESC","0,".$limit,$lang);
				while ($row = mysqli_fetch_assoc($result)) :
			?>
			<li class="product-item">
				<div class="ma-item">
					<div class="item-content ">
						<div class="pull-left products-images col-md-4" style="padding-left:0;padding-right:0;">
							<a class="product-image" href="/<?php echo $row['subject']; ?>.html" title="<?php echo $row['name']; ?>">
								<img src="<?php echo $path_image.$row['image']; ?>" alt="<?php echo $row['name']; ?>">
							</a>
						</div>
						<div class="products-des col-md-8">
							<h4 class="product-name">
								<a class="product-image" href="/<?php echo $row['subject']; ?>.html" title="<?php echo $row['name']; ?>">
									<?php echo $row['name']; ?>
								</a>
							</h4>
							<div class="price-box"><?php echo getPrice($row['price'],$row['pricekm']); ?></div>
						</div>	
						<div class="clearfix"></div>					
					</div>
					
				</div>
			</li>
			<?php endwhile; ?>
		</ul>
	</div>
</div>
