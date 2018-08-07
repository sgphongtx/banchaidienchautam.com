<div class="widget widget-static-block bg-white">
   <div class="contact-wrap space-base">
      <div class="block-title">
         <h3><?php echo module_keyword($mang11,$mang22,"mn_contact");?></h3>
      </div>
      <div class="block-content">
         <div class="col-md-12 col-xs-12">
            <?php
               $auto = getRecord("tbl_item","idshop=".$idshop." and cate=5 and status=1 and lang=$lang");
               if($auto['detail']!=""){
            ?>
            <div class="contact-info"><?php echo $auto['detail']?></div>
            <?php } ?>
         </div>
         <div class="col-md-12 col-xs-12">
            <div class="contact-form"><?php include("content/temp1/mail_gmail/mail.php");?> </div>
         </div>
         <div class="clearfix"></div>
      </div>
   </div>
</div>
