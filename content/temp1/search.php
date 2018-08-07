<?php $keyword = isset($_GET['keyword'])?($_GET['keyword']):""; ?>
<div class="widget widget-static-block">
	<div class="new-product-wrap space-base">
		<div class="block-title">
			<h3><?php echo module_keyword($mang11,$mang22,"box_search");?></h3>
		</div>
		<div class="block-content">
			<div id="products-grid" class="products-grid data"></div>
			<ol id="posts-list" class="posts-list data"></ol>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	function pagination(page, cate, content) {
	   $.ajax({
         url: '/content/temp1/s_pagination.php',
         type: 'POST',
         data: {
            'page': page,
            'keyword': '<?php echo $keyword ?>',
            'cate': cate
         },
      })
      .done(function(data_page) {
         $("#" + content).html(data_page);
      });

	}
	pagination(1, 1, "products-grid");
	pagination(1, 2, "posts-list");
	$(".data").on('click', '.pageNum > .pagination li', function() {
	   var page = $(this).attr('page');
	   var cate = $(this).attr('cate');
	   var ctn = cate == 1 ? "products-grid" : "posts-list";
	   pagination(page, cate, ctn);
	});
});
</script>