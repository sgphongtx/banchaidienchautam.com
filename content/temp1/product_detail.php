<?php
	$subject = $_GET['tensanpham'];
	$sqlupdate = "update tbl_item SET view=view+1 where subject='$subject' and idshop='$idshop'";
	mysqli_query($conn,$sqlupdate);

	$row = getRecord("tbl_item", "subject='$subject' and status=1");

	$parent      = $row['parent'];
	$parent_name = get_field("tbl_item_category","id",$parent,"name");
	$parent_link = get_field("tbl_item_category","id",$parent,"subject");
	$src_array   = json_decode($row['sort_all_images'],true);

	if($row['id']=="") header("Location:".$linkroot."/404-page-not-found.html");
	else {
		if($row['cate']==1) update_session_product_view($row['id']);
	}
?>
<?php if ($row['cate']==1) : ?>
<script type="text/javascript">
$(function() {
	productImage();
	responsiveProductZoom();	
});
</script>
<div class="single-product-page">
	<div class="col-wrapper-main">
		<div class="product-view">
			<div class="row product-collateral primary_block">
            <?php if($row['image']!='') : ?>
	        	<div class="col-md-7 product-left-column">
 	            <div id="image-block">
                 	<img id="proimage" class="img-responsive" itemprop="image" src="<?php echo $row['image']=='' ? $noimgs : $path_image.$row['image']; ?>" alt="<?php echo $row['name']; ?>" data-zoom-image="<?php echo $path_image.$row['image']; ?>" />
 	            </div>
 	            <!-- /#image-block -->
					<div id="views_block" class="clearfix">
						<div id="thumbs_list">
							<div id="thumblist" class="thumblist owl-carousel">
								<?php
									$d=1;
									foreach ($src_array as $value) :
								?>
								<div id="thumbnail_<?php echo $d; ?>" class="thumb_item " data-src="<?php echo $value[1] ?>" data-type="<?php echo $value[0] ?>">
									<a href="javascript:void(0)" data-imageid="<?php echo $row['id']; ?>" data-image="<?php echo $path_image; ?><?php echo $value[1] ?>" data-zoom-image="<?php echo $path_image; ?><?php echo $value[1] ?>" title="<?php echo $row['name']; ?>">
										<img class="img-responsive" id="thumb_<?php echo $d; ?>" src="<?php echo $path_image; ?><?php echo $value[1] ?>" alt="<?php echo $row['name']; ?>" itemprop="image" />
									</a>
								</div>
								<?php $d++; endforeach; ?>
							</div>
						</div>
					</div>
					<!-- /.views_block -->
    	            <div class="clear"></div>
    	        </div>
	           <!-- /.product-left-column -->
            <?php endif; ?>
				<div class="col-md-5 product-center-column">
					<h1 itemprop="name"><?php echo $row['name']; ?></h1>
					<div class="category" itemprop="category">
						<span>Category: </span>
						<a href="<?php echo $parent_link.'/'; ?>" title="<?php echo $parent_name; ?>">
							<h2 class="h5"><?php echo $parent_name; ?></h2>
						</a>
					</div>
					<div class="product-description rte" itemprop="description">
						<?php echo stripslashes($row['detail_short']); ?>
					</div>
					<div class="clearfix"><?php echo getPricePageDetail($row['price'],$row['pricekm']); ?></div>
					<?php if ($row_config['btn_add_cart']==1) : ?>
					<div class="quantity_wanted_p">
						<div class="js-qty">
							<button type="button" class="control-quantity control-minus">&minus;</button>
							<input name="idtin" id="idtin" type="hidden" value="<?=$row['id'];?>" />
							<input type="text" name="quantity" size="5" id="qty" class="slsp" style="text-align:center" value="1">
							<button type="button" class="control-quantity control-add">+</button>
						</div>
						<button type="button" name="addcart" idtin="<?=$row['id']?>" id="addcart" class="btn adtocart">
							<i class="fa fa-shopping-cart"></i>
							<span id="AddToCartText">Thêm vào giỏ</span>
						</button>
					</div>
					<?php endif; ?>
					<div class="clearfix"></div>
					<?php if ($row_config['shareface']==1) : ?>
					<div class="socialsharing_product no-print">
						<ul class="social-sharing list-unstyled">
							<li>
								<a class="btn btn-facebook" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo getCurrentPageURL(); ?>" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;">
									<i class="fa fa-facebook"></i>
								</a>
							</li>
							<li>
								<a class="btn btn-google-plus" target="_blank" href="https://plus.google.com/share?url=<?php echo getCurrentPageURL(); ?>" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;">
									<i class="fa fa-google-plus"></i>
								</a>
							</li>
							<li>
								<a class="btn btn-twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $row['name']; ?>&amp;url=<?php echo getCurrentPageURL(); ?>&amp;" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;">
									<i class="fa fa-twitter"></i>
								</a>
							</li>
							<li>
								<a class="btn btn-pinterest" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo getCurrentPageURL(); ?>&amp;description=<?php echo strip_tags(stripslashes($row['detail_short'])); ?>&amp;media=<?php echo $path_image.$row['image']; ?>" title="" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;">
									<i class="fa fa-pinterest-p"></i>
								</a>
							</li>
						</ul>
					</div>
					<!-- /.socialsharing_product -->
					<?php endif; ?>
					<div class="clearfix"></div>
				</div>
				<!-- /.product-center-column -->
	        	<div class="col-md-7 product-right-column"></div>
	        	<!-- /.product-right-column -->
	        	<div class="clearfix"></div>
	    	</div>
	    	<!-- /.primary_block -->

			<div class="product-collateral foreign_block">
				<div class="product-detail-tab">
					<ul class="nav nav-tabs">
						<li class="nav-tab-item active">
							<a href="#box-detail" id="link-box-detail" data-toggle="tab" aria-expanded="true" class="data switch">Chi tiết</a>
						</li>
						<?php if ($row_config['cmt_prod']==1) : ?>
						<li class="nav-tab-item">
							<a href="#box-reviews" id="link-box-reviews" data-toggle="tab" aria-expanded="false" class="data switch">Bình luận/Đánh giá</a>
						</li>
						<?php endif; ?>
					</ul>
					<div class="nav-tab-content tab-content">
						<div class="box-collateral box-detail tab-pane fade active in" id="box-detail"><?php echo stripslashes($row['detail']); ?></div>
						<div class="box-collateral box-reviews tab-pane fade" id="box-reviews">
							<?php 
								if ($row_config['cmt_prod']==1) : 
									if ($row_config['cmt_dis_style']==0) :
										include ('content/temp1/Box_comment.php');
									else :
							?>
							<div class="fb-comments" data-href="<?=getCurrentPageURL()?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
							<?php 
									endif; 
								endif; 
							?>
						</div>
					</div>
				</div>
				<!-- /.product-detail-tab -->
			</div>
			<!-- /.foreign_block -->
		</div>
		<!-- /.product-view -->

		<div class="relatived-product">
			<div class="relatived-product-title">
				<div class="h3"><?php echo module_keyword($mang11,$mang22,"product_relative"); ?></div>
			</div>
			<div class="relativedslider-container ">
				<div class="products-grid ">
					<div data-owl="slide" data-desksmall="4" data-tabletsmall="2" data-mobile="1" data-tablet="3" data-margin="0" data-item-slide="4" data-ow-rtl="false" data-nav-text="true" data-loop="false" class="owl-carousel owl-theme products-slide product-items same-height clearfix">
						<?php
							$result1 = get_records("tbl_item","cate=1 and parent=$parent and id<>".$row['id']." and status=1"," "," ",$lang);
							while ($row1 = mysqli_fetch_assoc($result1)) :
						?>
						<div class="item product-item col-md-12 col-xs-12">
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
							</div>
						</div>
						<!-- product-item -->
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.col-wrapper-main -->
</div>
<?php else : ?>
<div class="single-post-page">
	<div class="col-wrapper-main">
		<div class="post-wrapper bg-white" style="padding: 20px; margin-bottom: 30px;">
			<div class="entry-header">
				<h1 class="entry-title" itemprop="headline"><?php echo $row['name']; ?></h1>
				<?php if ($row_config['shareface']==1) : ?>
				<div class="socialsharing_product no-print">
					<ul class="social-sharing list-unstyled">
						<li>
							<a class="btn btn-facebook" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo getCurrentPageURL(); ?>" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;">
								<i class="fa fa-facebook"></i> Facebook
							</a>
						</li>
						<li>
							<a class="btn btn-google-plus" target="_blank" href="https://plus.google.com/share?url=<?php echo getCurrentPageURL(); ?>" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;">
								<i class="fa fa-google-plus"></i> Google +
							</a>
						</li>
						<li>
							<a class="btn btn-twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $row['name']; ?>&amp;url=<?php echo getCurrentPageURL(); ?>&amp;" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;">
								<i class="fa fa-twitter"></i> Twitter
							</a>
						</li>
						<li>
							<a class="btn btn-pinterest" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo getCurrentPageURL(); ?>&amp;description=<?php echo strip_tags($row['detail_short']); ?>&amp;media=<?php echo $path_image.$row['image']; ?>" title="" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;">
								<i class="fa fa-pinterest-p"></i> Pinterest
							</a>
						</li>
					</ul>
				</div>
				<?php endif; ?>
			</div>
			<!-- /.entry-header -->
			<div class="entry-content" itemprop="articleBody">
				<?php echo stripslashes($row['detail']); ?>
			</div>
		</div>
		<!-- /.post-wrapper -->
		<?
		$result1 = get_records("tbl_item","cate=2 and parent=$parent and id<>".$row['id']." and status=1"," "," ",$lang);
		if(mysqli_num_rows($result1)>0):
			?>
			<div class="relatived-post space-base bg-white">
				<div class="relatived-post-title">
					<div class="h3"><?php echo module_keyword($mang11,$mang22,"new_relative"); ?></div>
				</div>
				<div class="relativedpost-container">
					<div class="row">
						<?php					
						while ($row1 = mysqli_fetch_assoc($result1)) :
							?>
							<div class="fave_relatived_post col-md-6 col-sm-6 col-xs-6">
								<div class="relatived-image-wrap col-md-4 col-sm-4 col-xs-4">
									<a href="/<?php echo $row1['subject']?>.html" title="<?php echo $row1['name']; ?>">
										<img itemprop="image" src="<?php echo $row1['image']=='' ? $noimgs : $path_image.$row1['image']; ?>" alt="<?php echo $row1['name']; ?>" class="img-responsive">
									</a>
								</div>
								<div class="relatived-post-details col-md-8 col-sm-8 col-xs-8">
									<h4 class="small-title">
										<a href="/<?php echo $row1['subject'] ?>.html" title="<?php echo $row1['name'] ?>"><?php echo $row1['name'] ?></a>
									</h4>
									<div class="post-small-content">
										<div class="relatived-post-desc"><?php echo catchuoi_tuybien($row1['detail_short'],10); ?> </div>
										<a href="/<?php echo $row1['subject']?>.html" title="<?php echo $row1['name']; ?>" class="aw-blog-read-more"><?=av('Xem tiếp','Continue read')?></a>
									</div>
								</div>
							</div>
						<?php endwhile;?>
					</div>
				</div>
			</div>
			<?endif;?>
		<!-- /.relatived-post -->
		<?php 
			if ($row_config['cmt_post']==1) : 
				if ($row_config['cmt_dis_style']==0) :
					include ('content/temp1/Box_comment.php');
				else :
		?>
		<div class="comments-post-area space-base bg-white">
			<div class="comments-post-content" style="padding: 20px;">
				<div class="fb-comments" data-href="<?=getCurrentPageURL()?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
			</div>
		</div>
		<?php 
				endif; 
			endif; 
		?>
	</div>
</div>
<?php endif; ?>