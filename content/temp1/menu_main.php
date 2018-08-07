<?php
	$result_menu = get_records('tbl_item_category', 'status = 1', 'sort asc', ' ', $lang);
	$data_menu = array();
	while ($row = mysqli_fetch_assoc($result_menu)) {
		$data_menu[$row['id']] = $row;
	}
	$sub = "";
	switch ($frame) {
		case 'products':
			if (isset($_GET['danhmuc'])) {
				$danhmuc = $_GET['danhmuc'];
				$iddm = get_one_field("tbl_item_category", "subject='$danhmuc'", $lang, "id");
				$sub = get_parent_by_child("tbl_item_category", $iddm);
			} else {
				$sub = '/view-all/';
			}
			break;
		case 'product_detail':
			if (isset($_GET['tensanpham'])) {
				$tensanpham = $_GET['tensanpham'];
				$iddm = get_one_field("tbl_item", "subject='$tensanpham'", $lang, "parent");
				$cate = get_one_field("tbl_item", "subject='$tensanpham'", $lang, "cate");
				$idpr = get_parent_by_child("tbl_item_category", $iddm);
				if ($cate==1) {
					$idr = get_one_field("tbl_item_category", "id='$idpr'", $lang, "parent");
					$sub = '/view-all/';
				} else {
					$sub = get_parent_by_child("tbl_item_category", $iddm);
				}
			}
			break;
	}
?>

<nav class="navbar-container">
	<div class="navbar-content nav_menu">
		<div class="container">
			<div class="navbar navbar-d">
				<ul>
			  		
					<?php each_menu($data_menu,0,array('cate'=>2,'pos'=>1,'hot'=>0),false,$sub); ?>
			  		
					<?php each_menu($data_menu,0,array('cate'=>1,'hot'=>1),false,$sub); ?>
					<?php/* each_menu($data_menu,0,array('cate'=>2,'hot'=>1),false,$sub); */?>
					<li><a href="/video.html">Demo sản phẩm</a></li>
			  		<?php if(trim(module_keyword($mang11,$mang22, 'mn_contact'))!=''){ ?>
					<li <?php echo ($frame=='contact' )? 'class="active"': ''; ?>>
						<a href='/lien-he.html'>
							<?php echo module_keyword($mang11,$mang22, 'mn_contact') ?>
						</a>
					</li>
			  		<?php } ?>
				</ul>
			</div>
			<?php if ($row_shop['is_mobile']==1) : ?>
			<div class="navbar navbar-m">
				<div class="header" style="position: relative;">
					<a href="#navbar-m"><span>MENU</span></a>
					<div class="cart_h hidden-sm">
						<a href="<?=$linkroot?>/xem-gio-hang" class="icon-basket">
							<img src="uploads/images/iconcart1.png" width="30" height="36" style="margin-top: 10px;" /> Giỏ hàng  
							 <span class="badge badge-danger">
					 	<?php echo isset($_SESSION['mycart']['tongsl']) ? $_SESSION['mycart']['tongsl'] : 0 ?></span>
						</a>
					</div>	
				</div>
				<div id="navbar-m" class="navbar-mb">
					<ul>
						<li <?php echo ($frame=='' ||$frame=='home' )? 'class="active"': ''; ?>>
							<a href='<?php echo $linkroot; ?>'>
								<?php echo module_keyword($mang11,$mang22, 'mn_home') ?>
							</a>
						</li>

						<?php each_menu($data_menu,0,array('cate'=>2,'pos'=>1,'hot'=>0),false,$sub); ?>

			  			<?php /* if(trim(module_keyword($mang11,$mang22, 'mn_sanpham'))!=''){ ?>
						<li <?php echo $sub=='/view-all/' ? 'class="active"': ''; ?>>
							<a href='/view-all/'>
								<?php echo module_keyword($mang11,$mang22, 'mn_sanpham') ?>
							</a>
							<ul>
								<?php each_menu($data_menu,0,array('cate'=>1)); ?>
							</ul>
						</li>
				  		<?php } */?>

						<?php each_menu($data_menu,0,array('cate'=>1,'hot'=>1),false,$sub); ?>

						<?php each_menu($data_menu,0,array('cate'=>2,'hot'=>1),false,$sub); ?>

				  		<?php if(trim(module_keyword($mang11,$mang22, 'mn_contact'))!=''){ ?>
						<li <?php echo ($frame=='contact' )? 'class="active"': ''; ?>>
							<a href='/lien-he.html'>
								<?php echo module_keyword($mang11,$mang22, 'mn_contact') ?>
							</a>
						</li>
				  		<?php } ?>
					</ul>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</nav>


<style>
  .nav_menu.fix {
    
      overflow: visible;
      position: fixed !important;
      display: block;
      top: 0;
      left:0;
      z-index: 999;
      width:100%;

     

}
.vnkings-spacer{
	height:60px;
}
</style>
 <script type="text/javascript">
            
        jQuery(document).ready(function($) {
            var $filter = $('.nav_menu');
            var $filterSpacer = $('<div />', {
                "class": "vnkings-spacer",
                "height": $filter.outerHeight()
            });
            if ($filter.size())
            {
                $(window).scroll(function ()
                {
                    if (!$filter.hasClass('fix') && $(window).scrollTop() > $filter.offset().top)
                    {
                        $filter.before($filterSpacer);
                        $filter.addClass("fix");
                    }
                    else if ($filter.hasClass('fix')  && $(window).scrollTop() < $filterSpacer.offset().top)
                    {
                        $filter.removeClass("fix");
                        $filterSpacer.remove();
                    }
                });
            }
 
        });
    </script>