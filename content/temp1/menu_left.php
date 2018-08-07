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
<link rel="stylesheet" type="text/css" href="public/css/vertical/navAccordion.css">
<div class="single-widget">
   <h3 class="section-title">
      <?php echo module_keyword($mang11,$mang22,"menu_left");?>
   </h3>
   <div class="">
      <nav class="mainNav">
         <ul> 
            <?php each_menu($data_menu,0,array('cate'=>1),false,$sub); ?>         
         </ul>  
      </nav>      
   </div>
</div>

<script src="public/css/vertical/navAccordion.js"></script>
   <script>
      jQuery(document).ready(function(){
      
         //Accordion Nav
         jQuery('.mainNav').navAccordion({
            expandButtonText: '<i class="fa fa-chevron-down"></i>',  //Text inside of buttons can be HTML
            collapseButtonText: '<i class="fa fa-chevron-up"></i>'
         }, 
         function(){
            console.log('Callback')
         });
         
      });
   </script>
