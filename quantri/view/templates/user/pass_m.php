<?php
	
	$username = $_SESSION['user']['username'];
	if (isset($_POST['btnSave'])==true) {
		
		$pass_old1 = $_POST['pass_old1'];
		$pass_new1 = $_POST['pass_new1'];
		$pass_new2 = $_POST['pass_new2'];
		if ((isset($_COOKIE[md5("un")]) && isset($_COOKIE[md5("pw")])) || isset($_SESSION['user']['username'])) {
			$id = $_SESSION['user']['id'];
		}
		settype($id, "int");
		
		$pass_old1 = trim(strip_tags($pass_old1));
		$pass_new1 = trim(strip_tags($pass_new1));
		$pass_new2 = trim(strip_tags($pass_new2));
	
		if (get_magic_quotes_gpc()==false) {
			$pass_old1 = mysqli_real_escape_string($pass_old1);
			$pass_new1 = mysqli_real_escape_string($pass_new1);
			$pass_new2 = mysqli_real_escape_string($pass_new2);
		}
		// kiểm tra dữ liệu nhập
		$coloi=false;	
		$passmin=6;
		$md5_pass_old1=md5(md5(md5($pass_old1)));
		$matkhaulay=get_field('tbl_customer','id',$id,'password');
		$md5_matkhaulay=md5(md5(md5($matkhaulay)));
		$pass_update = md5(md5(md5($pass_new1)));
		if ($pass_old1 == NULL){$coloi=true; echo "<script language='javascript'>alert('Bạn chưa nhập mật khẩu củ..!');</script>";}
		elseif ($pass_new1 == NULL){$coloi=true; echo "<script language='javascript'>alert('Bạn chưa nhập mật khẩu mới..!');</script>";}
		elseif (strlen($pass_new1)<$passmin ){$coloi=true; echo "<script language='javascript'>alert('Mật khẩu mới phải lớn hơn ".$passmin." ký tự..!');</script>";}
		elseif ($pass_new1!=$pass_new2){$coloi=true; echo "<script language='javascript'>alert('Mật khẩu mới bạn nhập 2 lần không giống nhau..!');</script>";}
		elseif ($md5_matkhaulay!=$md5_matkhaulay){$coloi=true; echo "<script language='javascript'>alert('Mật khẩu củ bạn nhập không đúng..!');</script>";;}
		else{ // cập nhật pass
			$sql=sprintf("update tbl_customer set password='%s' where id='%d'", $pass_update, $id);
			mysqli_query($conn,$sql) or die(mysqli_error());

			if (mysqli_query($conn,$sql)) {
            header("Location:/quantri?act=logout");
			}
		}
	}
	if (isset($_POST['quayra'])==true) {
		header("location:".url_direct());
	}
?>
<div class="content" style="min-height: 530px;">
	<h3>Đổi mật khẩu quản trị viên</h3>
	<div class="bs-example bs-example-bg-classes">
	    <?php if($errMsg != '') { ?>
	    <p class="bg-warning"><?php echo $errMsg; ?></p>
	    <?php } else { ?>
	    <p class="bg-warning">
	    	Những ô có dấu (<font color="red">*</font>) là bắt buộc<br />
	    </p>
	    <?php } ?>
	</div>
	<div class="block">
	    <div class="block-content">
	        <form method="post" name="frmForm" enctype="multipart/form-data" class="form-horizontal">
	        	<input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />

	        	<div class="form-group">
	                <label class="col-sm-3 control-label">
	                	Mật khẩu cũ <font color="red">*</font>
	                </label>
	                <div class="col-sm-3">
	                    <input type="password" name="pass_old1" class="form-control" value="<?=$pass_old1?>" />
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">
	                	Mật khẩu mới
	                </label>
	                <div class="col-sm-3">
	                    <input type="password" name="pass_new1" class="form-control" value="<?=$pass_new1?>" />
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">
	                	Nhập lại mật khẩu mới
	                </label>
	                <div class="col-sm-3">
	                    <input type="password" name="pass_new2" class="form-control" value="<?=$pass_new2?>" />
	                </div>
	            </div>                 
	            <div class="form-group">
	                <div class="col-sm-offset-3 col-sm-4 btn-gr">
	                    <button type="submit" name="btnSave" class="btn btn-default">Chấp nhận</button>
	                    <button onclick="goBack()" type="button" name="goback" class="btn btn-default">Quay lại</button>
	                </div>
	            </div>
	        </form>
	    </div>
	</div>    
</div>