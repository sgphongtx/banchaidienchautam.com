<?php
    $id= $_SESSION['user']['id'];
    settype($id,"int");
    $user = get_records("tbl_users","id='{$id}' "," "," "," ");
    $row_user=mysqli_fetch_assoc($user);
    if (isset($_POST['save-user'])==true) {//isset kiem tra submit
    	$name                 = trim(strip_tags($_POST['name']));
    	$email                = trim(strip_tags($_POST['email']));
    	$address              = trim(strip_tags($_POST['address']));
    	$mobile               = trim(strip_tags($_POST['mobile']));
    	$gender               = trim(strip_tags($_POST['gender']));
    	$password             = trim(strip_tags($_POST['password']));
    	$password_new         = trim(strip_tags($_POST['password-new']));
    	$password_new_confirm = trim(strip_tags($_POST['password-new-confirm']));

		if (get_magic_quotes_gpc()==false) {
			$name                 = mysqli_real_escape_string($name);
			$email                = mysqli_real_escape_string($email);
			$address              = mysqli_real_escape_string($address);
			$mobile               = mysqli_real_escape_string($mobile);
			$password              = mysqli_real_escape_string($password);
			$password_new         = mysqli_real_escape_string($password_new);
			$password_new_confirm = mysqli_real_escape_string($password_new_confirm);
		}

		$ms = '';
		$coloi = false;
		if ($name == '') {$coloi = true; $ms .= "<p>- Bạn chưa nhập họ tên</p>"; }
		if ($email == '') {
			$coloi=true;
			$ms .= "<p>- Bạn chưa nhập địa chỉ mail";
		} else {
			if (filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE) {
				$coloi = true;
				$ms .= "<p>- Bạn nhập email không đúng kiểu ( example@domain.com )</p>";
			} else {
				if (check_table('tbl_users','email='."'".$email."' AND id!=".$id,'id')==false) {
					$coloi = true;
					$ms .= "<p>- Địa chỉ mail này đã có người dùng</p>";
				}
			}
		}
		if ($mobile == '') {$coloi=true; $ms .= "<p>- Bạn chưa nhập số điện thoại</p>"; }
		else {
			if(strlen($mobile)<10 && !ctype_digit($mobile)) {
			  	$coloi = true;
				$ms .= "<p>- Số điện thoại không đúng </p>";
			}
		}
		if ($password == '') {$coloi = true; $ms .= '<p>- Bạn chưa nhập mật khẩu hiện tại</p>';}
		else {
			if (mysqli_num_rows(mysqli_query($conn,"SELECT id FROM tbl_users WHERE password='".md5(md5(md5($password)))."' AND id='$id' LIMIT 1")) < 0) {
				$coloi=true;
				$ms .= "<p>- Mật khẩu không đúng</p>";
			}
		}
		if ($password_new == '') {$coloi = true; $ms .= '<p>- Bạn chưa nhập mật khẩu mới</p>';}
		if ($password_new_confirm == '') {$coloi = true; $ms .= '<p>- Bạn chưa nhập mật khẩu xác nhận</p>';}
		if ($password_new_confirm != $password_new) {$coloi = true; $ms .= '<p>- Mật khẩu xác nhận không trùng khớp</p>';}
		if($coloi==FALSE) {
			$data_update = "name='$name', email='$email', address='$address', mobile='$mobile', gender='$gender',password='".md5(md5(md5($password_new)))."', is_update=1";
			update_table("tbl_users",$id,$data_update,'');
			echo thongbao(url_direct(), $thongbao = 'Chúc mừng bạn đã thay đổi thông tin tài khoản thành công..!');
		}
	}
	ob_start();
?>
<div class="content" style="min-height: 530px;">
	<div class="content content-boxed">
		<!-- cover block -->
		<div class="block">
			<div class="bg-image" style="background-image: url('images/photo3@2x.jpg');">
				<div class="block-content bg-primary-op text-center overflow-hidden">
					<div class="push-30-t push animated fadeInDown">
						<img class="img-avatar img-avatar96 img-avatar-thumb" src="images/no-avatar.png" alt="admin">
					</div>
					<div class="push-30 animated fadeInUp">
						<h2 class="h4 font-w600 text-white push-5"><?=$row_user['name']?></h2>
						<h3 class="h5 text-white-op">Root Administrator</h3>
					</div>
				</div>
			</div>
		</div>
		<!-- end cover block -->

		<!-- block error message -->
		<?php if ($ms!='') { ?>
		<div class="block block-themed block-rounded block-error-ms">
		   <div class="block-header bg-warning">
		      <h3 class="block-title">Lỗi</h3>
		   </div>
		   <div class="block-content">
		      <p><?php echo $ms; ?></p>
		   </div>
		</div>
		<?php } ?>
		<!-- end block error message -->


		<!-- form edit info -->
		<form method="post" name="frmForm" enctype="multipart/form-data">
			<div class="block">

				<!-- tabs -->
				<ul class="nav nav-tabs nav-justified push-20" data-toggle="tabs">
				   <li class="active">
				      <a href="#personal"><i class="fa fa-fw fa-pencil"></i> Thông tin</a>
				   </li>
				   <li class="">
				      <a href="#password"><i class="fa fa-fw fa-asterisk"></i> Mật khẩu</a>
				   </li>
				   <li class="">
				      <a href="#privacy"><i class="fa fa-fw fa-lock"></i> Riêng tư</a>
				   </li>
				</ul>
				<!-- end tabs -->

				<!-- block-content tab-content -->
				<div class="block-content tab-content">
					<!-- #personal -->
					<div class="tab-pane fade active in" id="personal">
						<div class="row items-push">
							<div class="col-sm-6 col-sm-offset-3 form-horizontal">
								<!-- user name -->
								<div class="form-group">
								   <div class="col-xs-6">
								      <label>Username</label>
								      <div class="form-control-static font-w700"><?=$row_user['username']?></div>
								   </div>
								</div>
								<!-- user name -->

								<!-- name -->
								<div class="form-group">
								   <div class="col-xs-12">
								      <label for="name">Họ tên</label>
								      <input class="form-control input-lg" type="text" id="name" name="name" placeholder="Nhập họ tên của bạn.." value="<?=$row_user['name']?>">
								   </div>
								</div>
								<!-- name -->

								<!-- email -->
								<div class="form-group">
								   <div class="col-xs-12">
								      <label for="email">Email</label>
								      <input class="form-control input-lg" type="email" id="email" name="email" placeholder="Nhập email của bạn.." value="<?=$row_user['email']?>">
								   </div>
								</div>
								<!-- email -->

								<!-- address -->
								<div class="form-group">
								   <div class="col-xs-12">
								      <label for="address">Địa chỉ</label>
								      <input class="form-control input-lg" type="text" id="address" name="address" placeholder="Nhập địa chỉ của bạn.." value="<?=$row_user['address']?>">
								   </div>
								</div>
								<!-- address -->

								<!-- mobile -->
								<div class="form-group">
								   <div class="col-xs-12">
								      <label for="mobile">Điện thoại</label>
								      <input class="form-control input-lg" type="text" id="mobile" name="mobile" placeholder="Nhập điện thoại của bạn.." value="<?=$row_user['mobile']?>">
								   </div>
								</div>
								<!-- mobile -->

								<!-- gender -->
								<div class="form-group">
								   <label class="col-xs-12">Giới tính</label>
								   <div class="col-xs-12">
								      <label class="css-input css-radio css-radio-primary push-10-r">
								         <input type="radio" name="gender" value="0"><span></span> Nữ
								      </label>
								      <label class="css-input css-radio css-radio-primary">
								         <input type="radio" name="gender" value="1" checked=""><span></span> Nam
								      </label>
								   </div>
								</div>
								<!-- gender -->
							</div>
						</div>
					</div>
					<!-- end #personal -->

					<!-- #password -->
					<div class="tab-pane fade" id="password">
						<div class="row items-push">
							<div class="col-sm-6 col-sm-offset-3 form-horizontal">
								<!-- current password -->
								<div class="form-group">
								   <div class="col-xs-12">
								      <label for="password">Mật khẩu hiện tại</label>
								      <input class="form-control input-lg" type="password" id="password" name="password">
								   </div>
								</div>
								<!-- current password -->
								<hr>

								<!-- new password -->
								<div class="form-group">
								   <div class="col-xs-12">
								      <label for="password-new">Mật khẩu mới</label>
								      <input class="form-control input-lg" type="password" id="password-new" name="password-new">
								   </div>
								</div>
								<!-- new password -->

								<!-- new password -->
								<div class="form-group">
								   <div class="col-xs-12">
								      <label for="password-new-confirm">Xác nhận mật khẩu mới</label>
								      <input class="form-control input-lg" type="password" id="password-new-confirm" name="password-new-confirm">
								   </div>
								</div>
								<!-- new password -->
							</div>
						</div>
					</div>
					<!-- end #password -->

					<!-- #privacy -->
					<div class="tab-pane fade" id="privacy">
					   <div class="row items-push">
					      <div class="col-sm-6 col-sm-offset-3 form-horizontal">
					         <div class="form-group">
					            <div class="col-xs-12">
					               <div class="font-s13 font-w600 text-center">Đang đợi cập nhật tính năng</div>
					            </div>
					         </div>
					      </div>
   					</div>
					</div>
					<!-- end #privacy -->

				</div>
				<!-- end block-content tab-content -->
				
				<!-- group button -->
				<div class="block-content block-content-full bg-gray-lighter text-center">
					<button class="btn btn-sm btn-primary" type="submit" name="save-user"><i class="fa fa-check push-5-r"></i> Lưu thay đổi</button>
					<button class="btn btn-sm btn-warning" type="reset"><i class="fa fa-refresh push-5-r"></i> Reset</button>
				</div>
				<!-- end group button -->
			</div>
		</form>
		<!-- end form edit info -->
	</div>
</div>
<style type="text/css">.block-error-ms p {margin-bottom: 3px;}</style>
