<?php $rowtin=getRecord("tbl_shop", "status=1"); ?>
<div class="logo col-md-3 col-sm-3 col-xs-6 product-item " style="position:relative; padding:0">
	<div class="img_logo " style="padding:10px 0;"><a href="<?php echo $linkroot ;?>">
    <?php 
        $char = substr($rowtin['logo'],0,7); 
        if($char == 'http://') $background = $rowtin['logo'];
        else $background = $path_image.$rowtin['logo'];
    ?>
        <img class="img-responsive text-center " src="<?php echo $background; ?>" alt="<?php echo $row_shop['name'];?>" />
    </a>  </div>
</div><!-- End .banner_mau_gh -->
<div class="col-md-4 col-sm-3 col-xs-6 timkiem " style="padding-left: 0;padding-right: 0; margin-bottom: 10px;">
	<?php include("content/temp1/box_search.php"); ?>
</div>
<div class="col-md-5 col-sm-6 col-xs-12 giohang hidden-xs" style="">
	<div class="cart_h">
		<a href="<?=$linkroot?>/xem-gio-hang" class="icon-basket">
			<img src="uploads/images/iconcart.png" width="30" height="36" style="margin-top: 10px;" /> <span style="color: #f00; font-weight: 600;">Giỏ hàng </span> 
			 <span class="badge badge-danger">
	 	<?php echo isset($_SESSION['mycart']['tongsl']) ? $_SESSION['mycart']['tongsl'] : 0 ?></span>
		</a>
	</div>
	<div class="hotline_h">
		<span>Hotline : <?php echo $row_shop['hotline']; ?></span>
	</div>
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<style type="text/css">
	
</style>