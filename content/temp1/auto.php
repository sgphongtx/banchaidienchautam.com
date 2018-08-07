<?php 
	$row = getRecord("tbl_item","cate=3 and type=1 and lang=$lang and status=1");
	if ($row['id'] != null) :
?>
<div class="widget widget-static-block">
	<div class="free-type-wrap space-base">
	  	<div class="block-title">
			<div class="h3"><?php echo $row['name'] ?></div>
	  	</div>
	  	<div class="block-content">
			<div class="col-md-12 col-xs-12"><?php echo stripslashes($row['detail']) ?></div>
			<div class="clearfix"></div>
	  	</div>
	</div>
</div>
<?php endif; ?>
