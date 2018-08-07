<div class="single-widget link-widget">
	<h3 class="section-title">
		<?php echo module_keyword($mang11,$mang22,"box_link");?>
	</h3>
	<div class="content-widget">
		<select name="link" class="slt-link form-control">
			<option value="" selected>--Chọn liên kết--</option>
			<?php
				$result = get_records("tbl_link","status=1","id DESC","0,5"," ");
				while ($row_link = mysqli_fetch_assoc($result)) :
			?>
			<option value="<?php echo $row_link['link']; ?>"><?php echo $row_link['name']; ?></option>			
			<?php endwhile; ?>
		</select>
	</div>
</div>
