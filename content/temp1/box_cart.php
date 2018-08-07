<style>
	.box_shop_2{text-align:center; padding:10px;}
	.box_shop_2 a{color:#03C;}
	.icon_shop_2{
		background:url('web/assets/stylesheet/images/1321414407_09.png') no-repeat; 
		width:128px; height:128px;
		margin:0 auto;
	}
	.icon_shop_2 span{
		color:#03C;
		width:20px; height:20px;
		line-height:20px;
		margin:0 auto;
		padding:3px 8px;
		font-size:18px;
		background:#fff;
		opacity:0.8;
		filter: alpha(opacity = 80);
		border:1px solid #03C;
	}

</style>
<?php if(isset($_SESSION['tongso'])) {?>
<div class="frame_mau_gh box_cart">
    <h3 class="title_f_m_gh">
        <?php echo module_keyword($mang11,$mang22,"viewcart");?>
    </h3><!-- End .title_f_m_gh -->
    <div class="main_f_m_gh">
    	<div class="box_shop_2">
            <div class="icon_shop_2">
                <span id="cart_21"><?php if(isset($_SESSION['tongso'])) echo $_SESSION['tongso'];else echo "0";?></span>
            </div>
            <a href="xem-gio-hang">   <?php if(isset($_SESSION['tongso'])) echo $_SESSION['tongso'];else echo "0";?> <?php echo module_keyword($mang11,$mang22,"item");?></a>
        </div><!-- End .box_shop_2 -->   
    </div><!-- End .main_f_m_gh -->
</div><!-- End .frame_mau_gh -->
<?php } else { ?>
<div class="box_shop_2" style="display:none">
</div>
<?php } ?>