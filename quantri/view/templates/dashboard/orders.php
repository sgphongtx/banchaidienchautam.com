<div class="row">
   <div class="col-sm-6 col-md-2">
      <a class="block block-link-hover3 text-center" href="<?=url_direct('get','manage_orders');?>" target="_blank">
         <div class="block-content block-content-full">
            <div class="h1 font-w700 text-muted" data-toggle="countTo" data-to="35"><?php echo countRecord("tbl_donhang"," idshop=".$idshop." and status=1");?></div>
         </div>
         <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Đơn hàng chờ xử lý</div>
      </a>
   </div>
   <div class="col-sm-6 col-md-2">
      <a class="block block-link-hover3 text-center" href="<?=url_direct('get','manage_orders');?>" target="_blank">
         <div class="block-content block-content-full">
            <div class="h1 font-w700 text-primary" data-toggle="countTo" data-to="109"><?php echo countRecord("tbl_donhang"," idshop=".$idshop." and DATE_FORMAT(ThoiDiemDatHang, '%d')=".date('d'));?></div>
         </div>
         <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Tổng đơn hàng hôm nay</div>
      </a>
   </div>
   <div class="col-sm-6 col-md-2 hidden">
      <a class="block block-link-hover3 text-center" href="<?=url_direct('get','manage_orders');?>" target="_blank">
         <div class="block-content block-content-full">
            <div class="h1 font-w700 text-muted" data-toggle="countTo" data-to="109"><?php echo countRecord("tbl_donhang"," idshop=".$idshop." and DATE_FORMAT(ThoiDiemDatHang, '%d')=".(date('d')-1));?></div>
         </div>
         <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Tổng đơn hàng hôm qua</div>
      </a>
   </div>
   <div class="col-sm-6 col-md-2">
      <a class="block block-link-hover3 text-center" href="<?=url_direct('get','manage_orders');?>" target="_blank">
         <div class="block-content block-content-full">
            <div class="h1 font-w700 text-success" data-toggle="countTo" data-to="28" data-after="%"><?php echo countRecord("tbl_donhang"," idshop=".$idshop." and DATE_FORMAT(ThoiDiemDatHang, '%m')=".date('m'));?></div>
         </div>
         <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Tổng đơn hàng tháng này</div>
      </a>
   </div>
   <div class="col-sm-6 col-md-3">
      <a class="block block-link-hover3 text-center" href="javascript:void(0)">
         <div class="block-content block-content-full">
         	<?php
         		$sql = "SELECT SUM(price) as total_money FROM tbl_donhang WHERE idshop=363 AND DATE_FORMAT(ThoiDiemDatHang, '%d')=".date('d');
         		$earning = mysqli_fetch_assoc(mysqli_query($conn,$sql));
         	?>
            <div class="h1 font-w700 text-danger"><span data-toggle="countTo" data-to="8970"><?php echo number_format($earning['total_money'],0); ?></span> VNĐ
            </div>
         </div>
         <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Thu nhập hôm nay</div>
      </a>
   </div>
   <div class="col-sm-6 col-md-3">
      <a class="block block-link-hover3 text-center" href="javascript:void(0)">
         <div class="block-content block-content-full">
         	<?php
         		$sql = "SELECT SUM(price) as total_money FROM tbl_donhang WHERE idshop=363 AND DATE_FORMAT(ThoiDiemDatHang, '%m')=".date('m');
         		$earning = mysqli_fetch_assoc(mysqli_query($conn,$sql));
         	?>
            <div class="h1 font-w700 text-info"><span data-toggle="countTo" data-to="8970"><?php echo number_format($earning['total_money'],0); ?></span> VNĐ
            </div>
         </div>
         <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Thu nhập tháng này</div>
      </a>
   </div>
</div>
<div class="row">
   <div class="col-lg-6">
      <div class="block block-opt-refresh-icon4">
         <div class="block-header bg-gray-lighter">
            <h3 class="block-title">Top bán chạy</h3>
         </div>
         <div class="block-content">
            <table class="table table-borderless table-striped table-vcenter">
               <tbody>
               	<?php
							$result = get_records("tbl_item","cate=1 and status=1","buy DESC","0,10"," ");
							while ($row = mysqli_fetch_assoc($result)) :
						?>
                  <tr>
                     <td class="text-left" style="width: 100px;"><a href="javascript:void(0);"><strong>PID.<?=$row['id']?></strong></a>
                     </td>
                     <td><a href="<?=url_direct('edit','item','_m','&id='.$row['id'])?>"><?=$row['name']?></a>
                     </td>
                     <td class="hidden-xs text-center">
                        <div class="text-warning">
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                        </div>
                     </td>
                  </tr>
               	<?php endwhile; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
   <div class="col-lg-6">
      <div class="block block-opt-refresh-icon4">
         <div class="block-header bg-gray-lighter">
            <h3 class="block-title">Đơn hàng gần đây</h3>
         </div>
         <div class="block-content">
            <table class="table table-borderless table-striped table-vcenter">
               <tbody>
               	<?php
							function getValueDonHang($trangthai) {
							   $tentrangthai = "";
							   switch ($trangthai) {
							      case "1":
							         $tentrangthai = "<span class='label label-info'>Chờ xử lí</span>";
							         break;
							      case "4":
							         $tentrangthai = "<span class='label label-warning'>Chờ xuất hàng</span>";
							         break;
							      case "7":
							         $tentrangthai = "<span class='label label-success'>Hoàn thành</span>";
							         break;
							      case "9":
							         $tentrangthai = "<span class='label label-danger'>Huỷ đơn hàng</span>";
							         break;
							      case "10":
							         $tentrangthai = "<span class='label label-danger'>Từ chối đơn hàng</span>";
							         break;
							      case "11":
							         $tentrangthai = "<span class='label label-warning'>Hoàn trả đơn hàng</span>";
							         break;
							      case "12":
							         $tentrangthai = "<span class='label label-success'>Đã tiếp nhận</span>";
							         break;
							   }
							   return $tentrangthai;
							}
               		$orders = get_records("tbl_donhang", "idshop='$idshop'", "id desc", "0,10", " ");
               		while ($order = mysqli_fetch_assoc($orders)) {
               	?>
                  <tr>
                     <td class="text-center" style="width: 100px;"><a href="base_pages_ecom_order.php"><strong>ORD.<?=$order['id']?></strong></a>
                     </td>
                     <td class="hidden-xs"><a href="<?=url_direct('get','manage_orders');?>"><?=$order['TenNguoiNhan']?></a>
                     </td>
                     <td><?php echo getValueDonHang($order['status']); ?></td>
                     <td class="text-right"><strong><?=number_format($order['price'],0).' VNĐ'?></strong>
                     </td>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>