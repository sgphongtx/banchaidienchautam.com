<?php

	include "content/".$template."/mail_gmail/class.phpmailer.php"; 
	include "content/".$template."/mail_gmail/class.smtp.php"; 
	
	if (isset($_POST['btnSubmit'])==true) {		
		$email = $_POST['email'];
		$email = trim(strip_tags($email));	
		if (get_magic_quotes_gpc()==false) {
			$email = mysqli_real_escape_string($email);
		}
		// kiểm tra dữ liệu nhập
		$coloi = false;		
		$rowtin = getRecord("tbl_customer_shop", "email='".$email."'");
		if ($rowtin['id'] == "") {
         $coloi = true; 
         echo "<script language='javascript'>alert('Địa chỉ E-mail không đúng hoặc không tồn tại trên hệ thống. Vui lòng thử lại.');</script>";
     	} else { // cập nhật pass
			$rowmail = getRecord("tbl_config", "id=1");
	         			
			$noidung_Body_full = $noidung_AltBody
			.'<strong>website : </strong>'.$row_shop['name'].'<br />'
			.'<strong>Từ : </strong>'.$host_link_full.'<br />';
		
			$ng_ten   = $row_shop['name'];;
			$ng_email = $rowmail['cauhinh_mail_ten'];
			$ch_email = $rowmail['cauhinh_mail_ten'];
			$ch_pass  = $rowmail['cauhinh_mail_mk'];
		
			$nn_ten = "Thành viên";
			$nn_email = $email;
			
			$tieude = "Phục hồi mật khẩu - vui lòng không trả lời vào mail này";
			$noidung = $noidung_AltBody;			
			
			/*********************************/

			if($email!="") {	
				$randomkey=chuoingaunhien(50);;
				$arrField = array(
					"idshop"              => "'".$idshop."'",
					"email"               => "'".$email."'",
					"dateadd"             => "'".$ngay."'",
					"randomkey"           => "'".$randomkey."'"
				); 
				insert("tbl_pass_randomkey",$arrField);
			
		
				$noidung_AltBody.="<br> Nhấp vào link này để tiến hành xác nhận phục hồi mật khẩu <a href='".$host_link_full."/link/restore-password/".$randomkey.".html'> click here </a>";
				$noidung=$noidung_AltBody;
				
				$kq = @guimail($ng_ten,$ch_email,$ch_email,$ch_pass,$nn_ten,$nn_email,$tieude,$noidung);
			
			}
			echo thongbao(" ",$thongbao='Bạn vừa gửi yêu cầu phục hồi mật khẩu thành công, xin vui lòng kiểm tra mail..!');	
		}
	}

?>
<div class="widget widget-static-block bg-white">
   <div class="register-wrap space-base">
      <div class="block-title">
         <div class="h3"><?=module_keyword($mang11, $mang22, 'forgetpass')?>?</div>
      </div>
      <div class="block-content">
			<div class="col-md-6 col-xs-6 fln mg">
				<p>Nhập địa chỉ e-mail bạn đã dùng để đăng ký tài khoản.</p>
				<p>Nhấp "Gửi" để nhận mật khẩu mới trong e-mail được gửi từ hệ thống.</p>
			</div>
			<div class="col-md-6 col-xs-6 fln mg">
				<form class="form-ignorepass" action="" method="post" enctype="multipart/form-data">
					<fieldset>
						<div class="form-group required">
                  	<input type="email" name="email" value="<?php echo $email; ?>" placeholder="E-Mail" id="input-email" class="form-control" />
                  	<?php echo $errMail; ?>
	               </div>
	               <div class="form-group">
                 		<input type="submit" name="btnSubmit" value="Gửi" class="btn btn-success" style="width: 100%;" />
	               </div>
					</fieldset>
				</form>
			</div>
			<div class="clearfix"></div>
      </div>
   </div>
</div>