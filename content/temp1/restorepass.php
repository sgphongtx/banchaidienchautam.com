<?php

	include "content/".$template."/mail_gmail/class.phpmailer.php"; 
	include "content/".$template."/mail_gmail/class.smtp.php"; 

	if (isset($_POST['btn_doipass'])==true) {
		
		$random=$_POST['randomkey'];
	
    	$rowtin=getRecord("tbl_pass_randomkey", "randomkey='".$random."' and idshop='".$idshop."'");
	
		if($rowtin['id']=="") echo "<script language='javascript'>alert('Yêu cầu hết hạn hoặc không có thực..!');</script>";
		else {
		$rowmail=getRecord("tbl_config", "id=1");
		
		$noidung_Body_full=$noidung_AltBody
		.'<strong>website : </strong>'.$row_shop['name'].'<br />'
		.'<strong>Từ : </strong>'.$host_link_full.'<br />';
	
		
		$ng_ten=$row_shop['name'];
		$ng_email="webmailt@vanphuco.com";
		
		$ch_email="webmailt@vanphuco.com";
		$ch_pass ="qqq11123";

		$nn_ten="Thành viên";
		$nn_email=$rowtin['email'];
		
		$tieude="Phục hồi mật khẩu - thông tin tài khoản";
		$noidung=$noidung_AltBody;
		
		
		
		/*********************************/
			
		$pass=chuoingaunhien(6);;
		$password=md5(md5(md5($pass)));
		$arrField = array(
			"password"            => "'".$password."'",
			"last_modified 	"     => "'".$ngay."'"
		); 
		update("tbl_customer_shop",$arrField,"email='".$rowtin['email']."'");
		 
		$noidung_AltBody.="
		Chúc mừng bạn đã khôi phục mật khẩu thành công! <br>
		Hãy sử dụng password mới để đăng nhập vào website để thay đổi lại mật khẩu theo ý muốn.
		<br> Mật khẩu để bạn đăng nhập là:".$pass
		." <br>".$row_shop['name']." - ".$host_link_full."<br>"
		;
		$noidung=$noidung_AltBody;
		
		$kq=@guimail($ng_ten,$ng_email,$ch_email,$ch_pass,$nn_ten,$nn_email,$tieude,$noidung);
			
		echo "<script language='javascript'>alert('Bạn vừa xác nhận khôi phục mật khẩu thành công, xin vui lòng kiểm tra mật khẩu mới trong hòm mail của bạn !');</script>";
	    echo '<script type="text/javascript"> window.location = ""; </script>';
		
		}

	}

?>
<div class="widget widget-static-block bg-white">
   <div class="register-wrap space-base">
      <div class="block-title">
         <div class="h3">Xác nhận phục hồi mật khẩu</div>
      </div>
      <div class="block-content">
			<form class="form-ignorepass" action="" method="post" enctype="multipart/form-data">
				<div class="col-xs-12">
					<p class="text-center">Bạn vừa xác nhận yêu cầu phục hồi mật khẩu, <br/>chọn đồng ý để hoàn thành thao tác này!</p>
					<input id="randomkey" name="randomkey"  type="hidden" value="<?php echo $_GET['randomkey'];?>"/>
					<p class="text-center">
						<input class="btn btn-success fln mg" id="btn_doipass" name="btn_doipass" type="submit" value=" Đồng ý "/>
					</p>
				</div>
				<div class="clearfix"></div>
			</form>
      </div>
   </div>
</div>
