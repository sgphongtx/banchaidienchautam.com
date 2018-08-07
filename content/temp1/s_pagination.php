<?php 
	include('config_ajax.php');

	$row_config = getRecord("dm_config","idshop='$idshop'");	

	if($_POST['page']) :
		$page    = $_POST['page'];
		$cate    = $_POST['cate'];
		$keyword = $_POST['keyword'];
		$query 	= "SELECT * FROM tbl_item WHERE cate='$cate' AND status='1'";

		if($keyword != "") {
			$str = "";
			$arr1 = split(" ",$keyword);
			for($i = 0; $i < count($arr1); $i++) {
				$str .= $arr1[$i]."%";
			}
			$query .= " and name like '%".$str."'";
		}

		$current_page = $page;
		$page         -= 1;  
		$display      = 12;
		$start        = $page * $display;

		$data   = "";
		$query  .= " ORDER BY id LIMIT $start, $display";
		$result = mysqli_query($conn,$query);
		while($row = mysqli_fetch_array($result)) :
			$img = $row['image']=='' ? $noimgs : $path_image.$row['image'];
			if ($cate==1) :
				$data .= "
				<li class=\"item product-item col-md-3 col-sm-3 col-xs-12\">
	            <div class=\"product-item-info\">
	               <div class=\"product-top\">
	                  <a href=\"/".$row['subject'].".html\" title=\"".$row['name']."\" class=\"product-image\">
	                     <img src=\"".$img."\" alt=\"".$row['name']."\">
	                  </a>
	               </div>
	               <!-- product-top -->
	               <div class=\"product-item-details\">
	                  <h4 class=\"product-name\">
	                     <a href=\"/".$row['subject'].".html\" title=\"".$row['name']."\">".$row['name']."</a>
	                  </h4>
	                  <div class=\"price-box\">
	                     ".getPrice($row['price'],$row['pricekm'])."
	                  </div>
	               </div>
	               ".(($row_config['btn_add_cart']==1) ? 
		                     "<div class=\"button-holder button-pro\">
		                        <button type=\"button\" class=\"btnMuaHang\" idsp=\"".$row['id']."\">
		                           <i class=\"fa fa-shopping-cart\"></i> ".av('Mua hàng','Add to Cart')."
		                        </button>
		                        <button type=\"button\" class=\"move\">
                                 <i class=\"fa fa-search\"></i> <a href=\"/".$row['subject'].".html\">".av('Chi tiết','Read more')."</a>
                              </button>
		                     </div>
		                    ":"")
                  	."
		               	
	            </div>
	         </li>
	         <!-- product-item -->
				";
			else :
				$data .= "
				<li class=\"postWrapper postWrapper-".$row['id']." clearfix\">
				<div class=\"col-md-12 col-xs-12 bg-white\" style=\"padding: 15px 0;\">
					<div class=\"post-image col-md-5 col-sm-5\">
						<a href=\"/".$row['subject'].".html\" title=\"".$row['name']."\">
	                  <img src=\"".$img."\" alt=\"".$row['name']."\" class=\"img-responsive\">
	               </a>
					</div>
					<div class=\"post-details col-md-6 col-sm-6\">
						<div class=\"post-header\">
							<div class=\"postTitle\">
								<h3 class=\"post-title\">
									<a href=\"/".$row['subject'].".html\" title=\"".$row['name']."\" class=\"post-item-link\">".$row['name']."</a>
								</h3>
							</div>
						</div>
						<div class=\"postContent\">
							<div class=\"post-description clearfix\">".catchuoi_tuybien($row['detail_short'],50)."</div>
							<a href=\"".$row['subject'].".html\" title=\"".$row['name']."\" class=\"aw-blog-read-more\">".av('Xem tiếp','Continue read')."</a>
						</div>
					</div>
				</div>
			</li>
				";
			endif;
		endwhile;
		$data = $cate==1 ? "<ul class='same-height row'>".$data."</ul>" : $data;
		$query_page = "SELECT COUNT(id) AS count FROM tbl_item WHERE cate='$cate' AND name LIKE '%".$str."' AND status='1' ORDER BY id";
		$result_page = mysqli_query($conn,$query_page);
		$row = mysqli_fetch_array($result_page);
		$count = $row['count'];
		$pages = ceil($count / $display);
		if ($count > 0 && $pages > 1) {
		   if ($current_page >= 7) {
		      $start_page = $current_page - 3;
		      if ($pages > $current_page + 3)
		         $end_page = $current_page + 3;
		      else if ($current_page <= $pages && $current_page > $pages - 6) {
		         $start_page = $pages - 6;
		         $end_page = $pages;
		      } else {
		         $end_page = $pages;
		      }
		   } else {
		      $start_page = 1;
		      if ($pages > 7)
		         $end_page = 7;
		      else
		         $end_page = $pages;
		   }

		   $data .= "<nav role='page' class='pageNum text-center'><ul class='pagination'>";
		   if ($current_page > 1) {
		      $data .= "<li page='1' cate='$cate'><a>&laquo;</a></li>";
		      $previous = $current_page - 1;
		      $data .= "<li page='$previous' cate='$cate'><a>&lsaquo;</a></li>";
		   }
		   for ($i = $start_page; $i <= $end_page; $i++) {
		      if ($current_page == $i)
		         $data .= "<li page='$i' cate='$cate' class='active'><a>{$i}</a></li>";
		      else
		         $data .= "<li page='$i' cate='$cate'><a>{$i}</a></li>";
		   }
		   if ($current_page < $pages) {
		      $next = $current_page + 1;
		      $data .= "<li page='$next' cate='$cate'><a>&rsaquo;</a></li>";
		      $data .= "<li page='$pages' cate='$cate'><a>&raquo;</a></li>";
		   }
		   $data = $data."</ul></nav>";
		}
		echo $data;
	endif;
?>