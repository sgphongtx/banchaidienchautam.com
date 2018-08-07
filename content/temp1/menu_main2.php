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

<link rel="stylesheet" href="public/css/menu_source/cssmenu/styles.css">
 <script src="public/css/menu_source/cssmenu/script.js"></script>

	<div class="menu1 container">
	<div id='cssmenu'>
	<ul>
			  		<?php if(trim(module_keyword($mang11,$mang22, 'mn_home'))!=''){ ?>
					<li <?php echo ($frame=='' ||$frame=='home' )? 'class="active"': ''; ?>>
						<a href='<?php echo $linkroot; ?>'>
							<?php echo module_keyword($mang11,$mang22, 'mn_home') ?>
						</a>
					</li>
			  		<?php } ?>
					<?php each_menu($data_menu,0,array('cate'=>2,'pos'=>1,'hot'=>0),false,$sub); ?>
			  		<?php if(trim(module_keyword($mang11,$mang22, 'mn_sanpham'))!=''){ ?>
					<li <?php echo $sub=='/view-all/' ? 'class="active"': ''; ?>>
						<a href='/view-all/'>
							<?php echo module_keyword($mang11,$mang22, 'mn_sanpham') ?>
						</a>
						<ul>
							<?php each_menu($data_menu,0,array('cate'=>1)); ?>
						</ul>
					</li>
			  		<?php } ?>
					<?php each_menu($data_menu,0,array('cate'=>1,'hot'=>1),false,$sub); ?>
					<?php each_menu($data_menu,0,array('cate'=>2,'hot'=>1),false,$sub); ?>
			  		<?php if(trim(module_keyword($mang11,$mang22, 'mn_contact'))!=''){ ?>
					<li <?php echo ($frame=='contact' )? 'class="active"': ''; ?>>
						<a href='/lien-he.html'>
							<?php echo module_keyword($mang11,$mang22, 'mn_contact') ?>
						</a>
					</li>
			  		<!-- <?php } ?>
			  		<?php if(trim(module_keyword($mang11,$mang22, 'box_download'))!=''){ ?>
			  							<li <?php echo ($frame=='download' )? 'class="active"': ''; ?>>
			  								<a href='/tai-ve.html'>
			  									<?php echo module_keyword($mang11,$mang22, 'box_download') ?>
			  								</a>
			  							</li>
			  		<?php } ?> -->
				</ul>
</div>
</div>
<div class="clearfix"></div>
