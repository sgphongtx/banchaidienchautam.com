<?php
$result = get_records("tbl_item_category","cate=1 and parent='$parent_l' and status=1","sort ASC,id DESC"," "," ");
while ($row = mysqli_fetch_assoc($result)) :
?>
<div class="single-widget nav-widget nav-widget-3">
	<h3 class="section-title">
		<a href="<?php echo $row['subject']; ?>/" title=""><?php echo $row['name']; ?></a>
	</h3>
	<div class="content-widget">
		<?php
			$result_menu = get_records("tbl_item_category", "status=1", "sort asc", " ",$lang);
		   $data_menu = array();
		   while ($row1 = mysqli_fetch_assoc($result_menu)) {
		      $data_menu[$row1['id']] = $row1;
		   }
		?>
		<ul>
			<?php each_menu($data_menu,$row['id'],array('cate'=>1),false); ?>  
		</ul>
	</div>
</div>
<?php endwhile; ?>
