<?php
	include('config_ajax.php');

	$act = isset($_POST['act']) ? $_POST['act'] : '';

	if ($act!='') {
		if ($act=='register') {
			$email = stripslashes(strip_tags($_POST['email']));
	      $password = stripslashes(strip_tags($_POST['password']));

	      $err_reg = false;
	      $errMS = '';

	      if (check_table("tbl_customer_shop","email='$email'","id") == false) {
				$errMS = '<span><i class="fa fa-exclamation-circle"></i> Địa chỉ email này đã tồn tại.</span>';
				$err_reg = true;
			}

			if ($err_reg==false) {
				$password = md5(md5(md5($password)));
		      $randomkey = chuoingaunhien(50);

		      $value1 = 'idshop, email, password, date_added, last_modified, active, status, randomkey';
		      $value2 = "'$idshop', '$email', '$password', '$ngay', '$ngay', '1', '1', '$randomkey'";
		      insert_table('tbl_customer_shop', $value1, $value2, $hinh);

		      $errMS = 'ok';
		      $_SESSION['kh_shop_login_id'] = mysqli_insert_id();
			}	
			echo $errMS;      
		}
		// end register

		if ($act=='login') {
			$email = $_POST['email'];
	      $password = $_POST['password'];
			$err_log = false;
			$errMS = '';

			if ($email == '' || $password == '') {
				$errMS = '<span><i class="fa fa-exclamation-circle"></i> Vui lòng nhập tên tài khoản và mật khẩu</span>';
				$err_log = true;
			}

			if ($err_log == false) {
				$row_ctm_shop = getRecord("tbl_customer_shop","email='$email' and status=1");
				if ($row_ctm_shop['id'] == '') {
					$errMS = '<span><i class="fa fa-exclamation-circle"></i> Tài khoản không đúng hoặc chưa được đăng ký.</span>';
				} else {
					$password_decode = md5(md5(md5($password)));
					if ($row_ctm_shop['password'] != $password_decode) {
						$errMS = '<span><i class="fa fa-exclamation-circle"></i> Mật khẩu không đúng.</span>';
					} else {
						if($row_ctm_shop['status'] == 0) {
							$errMS = '<span><i class="fa fa-exclamation-circle"></i> Tài khoản của bạn đã bị khóa bởi ban quản trị.</span>';
						} else {
	    					$errMS = 'ok';
	                  $_SESSION['kh_shop_login_id'] = $row_ctm_shop['id'];
	    					$_SESSION['kh_shop_login_username'] = $row_ctm_shop['email'];
	              	}
					}
				}
			}
			echo $errMS;
		}
		// end login

		if ($act=='edit_info') {
			$id       = $_POST['id'];
			$fullname = $_POST['fullname'];
			$gender   = $_POST['gender'];
			$dob      = $_POST['dob'];
			$address  = $_POST['address'];
			$tel      = $_POST['tel'];
			$errMS 	 = '';

			if (check_table("tbl_customer_shop","id<>'$id' AND mobile='$tel'","*") == false) {
				$errMS .= '<span><i class="fa fa-exclamation-circle"></i> Số điện thoại đã tồn tại.</span>';
			}

			if ($errMS=='') {
				$dob = date_format(date_create($dob),'Y-m-d');
				$up = "name='$fullname', mobile='$tel', address='$address', birthday='$dob', sex='$gender'";
				if (mysqli_query($conn,"UPDATE tbl_customer_shop SET $up WHERE id=$id")) {
					$errMS = 'ok';
				}
			}
			echo $errMS;
		}
		// end edit info

		if ($act=='edit_pass') {
			$id       = $_POST['id'];
	      $password = stripslashes(strip_tags($_POST['password']));
	      $errMS = '';
			
			$password = md5(md5(md5($password)));

	      $sql = sprintf("UPDATE tbl_customer_shop SET password='%s' WHERE id='%d'", $password, $id);
	      if (mysqli_query($conn,$sql)) {
	      	$errMS = 'ok';
	      }
			echo $errMS;      
		}
		// end register
	}

?>