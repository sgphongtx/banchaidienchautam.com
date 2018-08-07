<?php

include('config_ajax.php');

if(isset($_GET['type'])  && ($_GET['type'] == 'addcmt')) {
	$idshop_ = isset($_GET['idshop']) ? $_GET['idshop'] : '';
	$idsp = isset($_GET['idsp']) ? $_GET['idsp'] : '';
	$name = isset($_GET['name']) ? $_GET['name'] : '';
	$email = isset($_GET['email']) ? $_GET['email'] : '';
	$comment = isset($_GET['comment']) ? $_GET['comment'] : '';
	$ngayhientai = date('Y-m-d h:m:s');
	if ($idsp) {
		if (mysqli_query($conn,"INSERT into product_comment (name, email, date_now, content, id_product, status, idshop) VALUES ('$name','$email','$ngayhientai','$comment','$idsp','0','$idshop_')")) {
			echo '<div class="alert alert-success fade in">
				Gửi bình luận thành công ! <br/>
				Bình luận của bạn đang đợi được xét duyệt bởi quản trị viên.
				<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>
			</div>';
		}
	}
	else
		echo '<div class="alert alert-info fade in">
				Gửi bình luận không thành công ! <br/>
				<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>
			</div>';
}
