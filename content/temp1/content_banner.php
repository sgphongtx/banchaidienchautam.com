<nav id="top">
	<div  class="container ">
		<div id ="top-links" class="col-md-3 col-sm-6 col-xs-8" >
			<?php $row = getRecord("tbl_item","cate=3 and type=0 and lang=$lang");?>
			<i class="glyphicon glyphicon-time"></i> Giờ phục vụ : <?php echo stripslashes($row['detail']);?>
		</div>
		<div id ="top-links" class="col-md-7 col-xs-4 hidden-sm hidden-xs text-center"><i class="fa fa-map-marker"></i> Địa chỉ : <?php echo $row_shop['address']; ?></div>
		<div class="col-md-2 col-sm-6  text-right">
			<?php include("content/temp1/box_language.php"); ?>
		</div>
	</div>
</nav>
<header id="header" class="">
	<div class="container">		
		<?php include ("content/temp1/banner.php"); ?>
	</div>
</header><!-- /header -->
