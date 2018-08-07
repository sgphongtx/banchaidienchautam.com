<?php

	include "../content/temp1/mail_gmail/class.phpmailer.php";
	include "../content/temp1/mail_gmail/class.smtp.php";

	if (isset($_POST['btn-send'])==true) {
		$email = $_POST['reminder-email'];
		$email = trim(strip_tags($email));
		if (get_magic_quotes_gpc()==false) {
			$email = mysqli_real_escape_string($email);
		}
		// kiểm tra dữ liệu nhập
		$coloi = false;
		$rowtin   = getRecord("tbl_users", "email='$email'");
		$rowshopt = getRecord("tbl_shop", "id='$idshop'");

		if ($rowtin['id'] == ""){
			$coloi = true;
		   $error_login_form = "Email không tồn tại. Vui lòng nhập lại.";
		}
		else { // cập nhật pass
			$rowmail = getRecord("tbl_shop", "id='$idshop'");

			$noidung_Body_full = $noidung_AltBody
			.'<strong>Từ : </strong>'.$row_shop['name'].'<br />'
			.'<strong>website : </strong>'.$host_link_full.'<br />';

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
					"email"               => "'".$email."'",
					"dateadd"             => "'".$ngay."'",
					"randomkey"           => "'".$randomkey."'"
				);
				insert("tbl_pass_randomkey",$arrField);

				$pass = chuoingaunhien(6);;
				$password = md5(md5(md5($pass)));
				$arrField = array(
					"password"            => "'".$password."'",
					"last_modified 	"     => "'".$ngay."'"
				);
				update("tbl_users",$arrField,"email='".$rowtin['email']."'");


				$noidung_AltBody.="
				Khôi phục mật khẩu thành công! <br>
				Hãy dử dụng password mới để thay đổi lại password theo ý muốn.
				<br> Mật khẩu để bạn đăng nhập: ".$pass
				." <br>".$row_shop['name']." - ".HTTP_SHOP."<br>"
				;
				$noidung=$noidung_AltBody;

				$kq = @guimail($ng_ten,$ch_email,$ch_email,$ch_pass,$nn_ten,$nn_email,$tieude,$noidung);

				if ($kq == 0) {
					echo "<script language='javascript'>alert('Yêu cầu khẩu thất bại, xin vui lòng kiểm tra mail để phục hồi lại mật khẩu..!');</script>";
				} else {
					echo "<script language='javascript'>alert('Bạn vừa yêu cầu khẩu thành công, xin vui lòng kiểm tra mail để phục hồi lại mật khẩu..!');</script>";
					echo '<script type="text/javascript"> window.location = '.url_direct().'; </script>';
				}

			}

		}
	}

?>
<div class="content overflow-hidden">
   <div class="row">
      <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
         <div class="block block-themed animated fadeIn">
            <div class="block-header bg-primary">
               <ul class="block-options">
                  <li>
                     <a href="" data-toggle="tooltip" data-placement="left" title="Đăng nhập"><i class="si si-login"></i></a>
                  </li>
               </ul>
               <h3 class="block-title">Quên mật khẩu</h3>
            </div>
            <div class="block-content block-content-full block-content-narrow">
               <h1 class="h2 font-w600 push-30-t push-5"><?=$row_shop['name']?></h1>
               <p class="help-block animated fadeInDown" style="color: #D26A5C;"> <?php echo $error_login_form?> </p>
               <form class="js-validation-reminder form-horizontal push-30-t push-50" method="post">
                  <div class="form-group">
                     <div class="col-xs-12">
                        <div class="form-material form-material-primary floating">
                           <input class="form-control" type="email" id="reminder-email" name="reminder-email">
                           <label for="reminder-email">Email</label>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-12 col-sm-6 col-md-5">
                        <button class="btn btn-block btn-primary" name="btn-send" type="submit">
                        	<i class="si si-envelope-open pull-right"></i> Gửi Mail
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="push-10-t text-center animated fadeInUp">
   <small class="text-muted font-w600"><span class="js-year-copy">2015-<?=date('Y')?></span> &copy; OneUI 2.1</small>
</div>
<script type="text/javascript" src="/public/templates/quantri/plugins/oneui-fw/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/public/templates/quantri/plugins/oneui-fw/js/base_pages_reminder.js"></script>