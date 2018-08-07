<p><img src="" alt=""></p>
<p>Kính chào quý khách, <?php echo $row_res['TenNguoiNhan']; ?></p>
<p><?=$row_shop['name']?> vừa nhận được đơn hàng #<?php echo $id_DH; ?> của quý khách đặt ngày <?=$row_res['ThoiDiemDatHang']?>. Chúng tôi sẽ gửi thông báo đến quý khách qua một email khác ngay khi sản phẩm được giao cho đơn vị vận chuyển.</p>
<div class="row">
	<div class="col-sm-6">
		<p>
			<?php 
				$_min_d = mktime(0, 0, 0, date('m'), (date('d',$row_res['ThoiDiemDatHang']) + 1), date('Y'));
				echo date('d-m-Y', $_min_d);
			?>

		</p>
	</div>
	<div class="col-sm-6"></div>
</div>