<?php

include('config_ajax.php');

if(isset($_GET['type'])  && ($_GET['type'] == 'addcmt')) {
	$idsp = isset($_GET['idsp']) ? $_GET['idsp'] : '';
	$cate = isset($_GET['cate']) ? $_GET['cate'] : '';
	$name = isset($_GET['name']) ? $_GET['name'] : '';
	$diachi = isset($_GET['diachi']) ? $_GET['diachi'] : '';
	$email = isset($_GET['email']) ? $_GET['email'] : '';
	$phone = isset($_GET['phone']) ? $_GET['phone'] : '';
	$comment = isset($_GET['comment']) ? $_GET['comment'] : '';
	$ngayhientai = date('Y-m-d h:m:s');
	if ($name!='' && $email!='') {
		if (mysqli_query($conn,"INSERT into tbl_comment (idsp, cate, hoten, diachi, email, phone, date_added, last_modified, noidung, status) VALUES ('$idsp',$cate,'$name','$diachi','$email','$phone',now(),now(),'$comment','0')")) {
			echo '<div class="alert alert-success fade in">
				Gửi câu hỏi thành công ! <br/>
				Câu hỏi của bạn đang đợi được xét duyệt bởi quản trị viên.
				<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>
			</div>';
		}
	}
	else{
		echo '<div class="alert alert-info fade in">
				Gửi câu hỏi không thành công ! <br/>
				<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>
			</div>';
	}
}
