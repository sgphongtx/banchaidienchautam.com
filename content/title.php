<?php
$row_title_lap = $row_shop;
if ($_GET['act'] == "search") {
   $title_t       = $_GET['keyword'].' - '.$row_title_lap['title'];
   $description_t = $row_title_lap['description'];
   $keywords_t    = $row_title_lap['keywords'];
   $image         = get_one_field("tbl_ad", "cate=4 and status=1", "", "image");
}
elseif($_GET['act'] == 'products' && $_GET['danhmuc']) {
   $danhmuc       = $_GET['danhmuc'];
   $row_rs_tit    = getRecord('tbl_item_category', "subject='".$danhmuc."'");
   $link_cn_t     = $row_rs_tit['link'] != '' ? $row_rs_tit['link'] : $row_rs_tit['subject'].'/';
   $title_t       = $row_rs_tit['title'] != '' ? $row_rs_tit['title'] : $row_rs_tit['name'];
   $description_t = $row_rs_tit['description'] != '' ? $row_rs_tit['description'] : $row_rs_tit['name'];
   $keywords_t    = $row_rs_tit['keyword'] != '' ? $row_rs_tit['keyword'] : cat_kytu_dacbiet($row_rs_tit['name'], 1, 1, 0, 0, 1);
   $image         = $row_rs_tit['image'];
}
elseif($_GET['act'] == 'product_detail' && $_GET['tensanpham']) {
   $tensanpham    = $_GET['tensanpham'];
   $row_rs_tit    = $row_rs_tit = getRecord('tbl_item', "subject='".$tensanpham."'");
   $link_cn_t     = $row_rs_tit['subject'].'.html';
   $title_t       = $row_rs_tit['title'] != '' ? $row_rs_tit['title'] : $row_rs_tit['name'];
   $description_t = $row_rs_tit['description'] != '' ? stripslashes($row_rs_tit['description']) : strip_tags(catchuoi_tuybien(stripslashes($row_rs_tit['detail']), 20));
   $keywords_t    = $row_rs_tit['keyword'] != '' ? $row_rs_tit['keyword'] : cat_kytu_dacbiet($row_rs_tit['name'], 1, 1, 0, 0, 1);
   $image         = $row_rs_tit['image'];
}
elseif($_GET['act'] == 'viewcart') {
   $title_t       = av('Xem giỏ hàng','View cart').' - '.$row_title_lap['title'];;
   $description_t = $row_title_lap['description'];
   $keywords_t    = $row_title_lap['keywords'];
   $image         = get_one_field("tbl_ad", "cate=4 and status=1", "", "image");
}
elseif($_GET['act'] == 'order') {
   $title_t       = av('Đặt hàng','Checkout').' - '.$row_title_lap['title'];;
   $description_t = $row_title_lap['description'];
   $keywords_t    = $row_title_lap['keywords'];
   $image         = get_one_field("tbl_ad", "cate=4 and status=1", "", "image");
}
elseif($_GET['act'] == 'login') {
   $title_t       = av('Đăng nhập','Login').' - '.$row_title_lap['title'];;
   $description_t = $row_title_lap['description'];
   $keywords_t    = $row_title_lap['keywords'];
   $image         = get_one_field("tbl_ad", "cate=4 and status=1", "", "image");
}
elseif($_GET['act'] == 'page404') {
   $title_t       = av('Lỗi không tìm thấy','Page not found'). ' - '.$row_title_lap['title'];;
   $description_t = $row_title_lap['description'];
   $keywords_t    = $row_title_lap['keywords'];
   $image         = get_one_field("tbl_ad", "cate=4 and status=1", "", "image");
} else {
   $title_t       = $row_title_lap['title'];
   $description_t = $row_title_lap['description'];
   $keywords_t    = $row_title_lap['keyword'];
   $image         = $rowtin['image'];
   $image         = get_one_field("tbl_ad", "cate=4 and status=1", "", "image");
}
if($row_shop['icon']!="") :
?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $path_image.$row_shop['icon'];?>" />
<?php endif; ?>
<?php if($image=='') $image=$row_shop['icon']; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="<?=get_one_field("tbl_language","id='".$row_shop['default_lang']."'","","code")?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title_t ;?></title>
<base href="<?php echo HTTPS_SERVER ; ?>" />
<?php $demimge =  strpos($path_image.$image,'https://',7); ?>
<meta name="language" content="<?=get_one_field("tbl_language","id='".$row_shop['default_lang']."'","","code")?>" />
<meta name="description" content="<?php echo $description_t; ?>" />
<meta name="keywords" content="<?php echo $keywords_t; ?>" />
<meta name="robots" content="noodp,index,follow" />
<meta name="revisit-after" content="1 days" />
<meta name="copyright" content="Copyright © 2015-<?=date('Y')?> by <?=$row_shop['name']?>" />
<?php if ($row_shop['is_mobile']==1) : ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php endif; ?>
<link rel="canonical" href="<?=$linkroot.'/'.$link_cn_t?>">
<meta property="og:title" content="<?php echo $title_t; ?>">
<meta property="og:image" content="<?php if($demimge > 0) echo '/'.$image; else echo $path_image.$image; ?>"/>
<meta property="og:type" content="<?php if($frame==''||$frame=='home'||$frame=='products') echo 'object'; elseif($frame=='product_detail') echo 'article';?>" />
<meta property="og:url" content="https://<?php echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>" />
<meta property="og:description" content="<?php echo $description_t; ?>">
<meta property="fb:app_id" content="1377863005619239" />
<!-- Dublin Core-->
<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />
<meta name="DC.title" content="<?=$row_shop['title']?>" />
<meta name="DC.identifier" content="<?=$linkroot?>" />
<meta name="DC.description" content="<?=$row_shop['description']?>" />
<meta name="DC.subject" content="<?=$row_shop['keyword']?>" />
<meta name="DC.language" scheme="UTF-8" content="<?=get_one_field("tbl_language","id='".$row_shop['default_lang']."'","","code")?>" />
<!-- Geo Meta Tags -->
<meta name="geo.region" content="VN" />
<meta name="geo.placename" content="Ho Chi Minh City" />
<meta name="geo.position" content="10.806105;106.63668" />
<meta name="ICBM" content="10.806105, 106.63668" />
