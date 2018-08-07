<?php
   $result_menu = get_records("tbl_item_category", "status=1", "sort asc", " ",$lang);
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
            $sub = 'view-all/';
         }
         break;
      case 'product_detail':
         if (isset($_GET['tensanpham'])) {
            $tensanpham = $_GET['tensanpham'];
            $iddm = get_one_field("tbl_item", "subject='$tensanpham'", $lang, "parent");
            $sub = get_parent_by_child("tbl_item_category", $iddm);
         }
         break;
   }
?>
<div class="single-widget nav-widget nav-widget-2">
   <h3 class="section-title">
      <?php echo module_keyword($mang11,$mang22,"menu_left_news");?>
   </h3>
   <div class="content-widget">
      <ul> 
         <?php each_menu($data_menu,0,array('cate'=>2),false,$sub); ?>         
      </ul>        
   </div>
</div>
