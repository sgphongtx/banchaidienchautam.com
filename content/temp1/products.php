<?php 
	if (isset($_GET['danhmuc'])) {
		$subject = $_GET['danhmuc'];
		$id_category = get_one_field("tbl_item_category","subject='$subject'",$lang,"id");
		$cate = get_one_field("tbl_item_category","subject='$subject'",$lang,"cate");
		if ($id_category=='') header("Location:".$linkroot."/404-page-not-found.html");
	} else {
		$id_category = 0;
		$cate = 1;
	}
	
	$list_parent = get_list_parent('tbl_item_category',$id_category,$lang);
	/*if ($id_category==$lang) $parent = '';
	else */$parent = "AND parent in ({$list_parent})";

	$sl = get_field("tbl_module","idshop",$row_shop['id'],"sl2");
	if ($sl=='') $sl = 9;

	$pageSize = $sl;  $pageNum = 1; $totalRows = 0;
	settype($pageSize,"int");
	settype($pageNum,"int");
	settype($totalRows,"int");

	if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
	if ($pageNum<=0) $pageNum=1;
	$startRow = ($pageNum-1) * $pageSize;
	$totalRows = count_record("tbl_item","cate='$cate' $parent AND status=1",$lang,"","");

	$result = get_records("tbl_item","cate='$cate' $parent AND status=1","id DESC",$startRow.",".$pageSize,$lang);

	if ($totalRows==1) {
		$row = mysqli_fetch_assoc($result);
		header("Location:".$linkroot."/".$row['subject'].".html");
	}

?>
<h1 style="display: none;"><?php echo $description_t; ?></h1>
<?php if ($cate==1 || $subject=='') : ?>
<div class="product-page">
	<div class="page-title category-title product-category">
		<h2><?php echo ($id_category==0) ? module_keyword($mang11, $mang22, "mn_sanpham") : get_one_field("tbl_item_category","subject='$subject'",$lang,"name"); ?></h2>
	</div>
	<div class="category-products">
		<div class="products-grid">
			<ul class="same-height row">
				<?php while ($row = mysqli_fetch_assoc($result)) : ?>
				<li class="item product-item col-md-3 col-sm-3 col-xs-12">
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
		                     <div class="button-holder button-pro">
		                        <button type="button" class="btnMuaHang" idsp="<?=$row['id']?>">
		                           <i class="fa fa-shopping-cart"></i> <?=av('Mua hàng','Add to Cart')?>
		                        </button>
		                        <button type="button" class="move">
                                 <i class="fa fa-search"></i> <a href="/<?php echo $row['subject']?>.html"><?=av('Chi tiết','Read more')?></a>
                              </button>
		                     </div>
		                  	<?php endif; ?>
	            </div>
	         </li>
	         <!-- product-item -->
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>
<?php elseif ($cate==2) : ?>
<div class="post-page">
	<div class="page-title category-title post-category">
		<h2>
			<?php echo get_one_field("tbl_item_category","subject='$subject'",$lang,"name"); ?>
		</h2>
	</div>
	<div class="category-posts">
		<ol class="posts-list">
			<?php while ($row = mysqli_fetch_assoc($result)) : ?>
			<li class="postWrapper postWrapper-<?=$row['id']?> clearfix">
				<div class="col-md-12 col-xs-12 bg-white" style="padding: 15px 0;">
					<div class="post-image col-md-5 col-sm-5">
						<a href="/<?php echo $row['subject']?>.html" title="<?php echo $row['name']; ?>">
	                  <img src="<?php echo $row['image']=='' ? $noimgs : $path_image.$row['image']; ?>" alt="<?php echo $row['name']; ?>" class="img-responsive">
	               </a>
					</div>
					<div class="post-details col-md-6 col-sm-6">
						<div class="post-header">
							<div class="postTitle">
								<h3 class="post-title">
									<a href="/<?php echo $row['subject'] ?>.html" title="<?php echo $row['name'] ?>" class="post-item-link"><?php echo $row['name'] ?></a>
								</h3>
							</div>
						</div>
						<div class="postContent">
							<div class="post-description clearfix"><?php echo catchuoi_tuybien($row['detail_short'],50); ?> </div>
							<a href="/<?php echo $row['subject']?>.html" title="<?php echo $row['name']; ?>" class="aw-blog-read-more"><?=av('Xem tiếp','Continue read')?></a>
						</div>
					</div>
				</div>
			</li>
			<?php endwhile; ?>
		</ol>		
	</div>
</div>
<?php else : ?>
<?php endif; ?>

<nav class="text-center">
   <ul class="pagination">
      <?php 
      	if ($_REQUEST['danhmuc'])
      		echo pagination16($totalRows, $pageSize, $linkroot, "", $_GET['danhmuc']);
      	else 
      		echo pagination16($totalRows, $pageSize, $linkroot, "", 'view-all');
      ?>
   </ul>
</nav><!-- End pagination -->
<?php

?>