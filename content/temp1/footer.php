<?php 
	$row = getRecord("tbl_item","cate=3 and type=1 and lang=$lang and status=1");
?>

<div class="footer-top">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-xs-12 no-padding">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<h3><?php echo $row['name']; ?></h3>
					<?php $rowtin=getRecord("tbl_shop", "status=1"); ?>
						<div class="logo" style="position:relative; padding:0">
							<div class="img_logo " style="padding:10px 0;"><a href="<?php echo $linkroot ;?>">
						    <?php 
						        $char = substr($rowtin['logo'],0,7); 
						        if($char == 'http://') $background = $rowtin['logo'];
						        else $background = $path_image.$rowtin['logo'];
						    ?>
						        <img class="img-responsive text-center " src="<?php echo $background; ?>" alt="<?php echo $row_shop['name'];?>" />
						    </a>  </div>
						</div><!-- End .banner_mau_gh -->
						
						<div style="margin-top:10px;"><?php echo stripslashes($row['detail']) ?></div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<?php include("content/temp1/box_map.php"); ?>
				</div>
				<div class="footer-block col-md-4 col-sm-4 col-xs-12">
					<div class="footer-widget-content">
						<?php
							$row = getRecord("tbl_item","cate=4 and lang=$lang and status=1");
							echo stripslashes($row['detail']);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="widget-copyright">
					Copyright &copy; 2015-<?=substr(date("Y"), 2)?> <?php echo $row_shop['name'];?>. Powered by <a href="http://aab.vn" target="_blank"> aab.vn </a>
				</div>
			</div>
		</div>
	</div>
</div>