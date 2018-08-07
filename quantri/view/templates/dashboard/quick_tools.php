<!--**** add new product ****-->
<div class="col-xs-6 col-sm-4 col-lg-2">
   <a class="block block-link-hover2 text-center" href="<?=url_direct('get','item')?>">
      <div class="block-content block-content-full bg-primary">
         <i class="si si-bag fa-2x text-white"></i>
         <div class="font-w600 text-white-op push-15-t">Sản phẩm</div>
      </div>
   </a>
</div>

<!--**** add new news ****-->
<div class="col-xs-6 col-sm-4 col-lg-2">
   <a class="block block-link-hover2 text-center" href="<?=url_direct('get','news')?>">
      <div class="block-content block-content-full bg-success">
         <i class="si si-note fa-2x text-white"></i>
         <div class="font-w600 text-white-op push-15-t">Bài viết</div>
      </div>
   </a>
</div>

<!--**** manage orders ****-->
<div class="col-xs-6 col-sm-4 col-lg-2">
   <a class="block block-link-hover2 text-center" href="<?=url_direct('get','manage_orders')?>">
      <div class="block-content block-content-full bg-modern">
         <i class="si si-pie-chart fa-2x text-white"></i>
         <div class="font-w600 text-white-op push-15-t">Đơn hàng</div>
      </div>
   </a>
</div>

<!--**** edit css ****-->
<div class="col-xs-6 col-sm-4 col-lg-2">
   <a class="block block-link-hover2 text-center" href="<?=url_direct('get','styleweb')?>">
      <div class="block-content block-content-full bg-city">
         <i class="si si-magic-wand fa-2x text-white"></i>
         <div class="font-w600 text-white-op push-15-t">Giao diện</div>
      </div>
   </a>
</div>

<?php if ($_SESSION['user']['level']==1) : ?>
<!--**** modules ****-->
<div class="col-xs-6 col-sm-4 col-lg-2">
   <a class="block block-link-hover2 text-center" href="<?=url_direct('get','elementweb')?>">
      <div class="block-content block-content-full bg-primary-dark">
         <i class="si si-layers fa-2x text-white"></i>
         <div class="font-w600 text-white-op push-15-t">Module</div>
      </div>
   </a>
</div>
<?php endif; ?>

<!--**** config web information ****-->
<div class="col-xs-6 col-sm-4 col-lg-2">
   <a class="block block-link-hover2 text-center" href="<?=url_direct('get','config_shop')?>">
      <div class="block-content block-content-full bg-amethyst">
         <i class="si si-settings fa-2x text-white"></i>
         <div class="font-w600 text-white-op push-15-t">Cấu hình</div>
      </div>
   </a>
</div>