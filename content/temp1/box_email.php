<?php	
	if (isset($_POST['v'])) {
		$email = isset($_POST['v'])?$_POST['v']:"";
		$vale1 = 'idshop, email, date_added';
		$vale2 = "'$idshop', '$email', '$ngay'";

		insert_table('tbl_email',$vale1,$vale2,$hinh);
		echo thongbao("",$thongbao='Bạn đã đăng ký mail thành công..!');
	}
?>
<div class="single-widget newsletter-widget">
	<div class="h3 section-title">
		<?php echo module_keyword($mang11,$mang22,"box_email");?>
	</div>
	<div class="content-widget">
		<form method="POST" id="newsletter-form" action="" enctype="multipart/form-data">
			<input type="text" name="v" value="" placeholder="Nhập email..." 
			onblur="if(this.value=='') this.value='Nhập email...'" 
			onfocus="if(this.value =='Nhập email...') this.value=''">
			<button type="submit"\><i class="fa fa-envelope-o"></i></button>
		</form>
	</div>
</div>