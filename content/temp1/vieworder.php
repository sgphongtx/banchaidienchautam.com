<?php
   $id = $_GET['orderNr'];

   $sql = "select * from tbl_donhang";
   $query = mysqli_query($conn,$sql) or die (mysqli_error());
   $info_user = mysqli_fetch_assoc($query);
   if (!$_SESSION['kh_shop_login_id']) {
      header("location:".$host_link_full); 
   }
?>

<div class="widget widget-static-block bg-white">
   <div class="login-wrap space-base">
      <div class="block-title">
         <div class="h3">Chi tiết đơn hàng</div>
      </div>
      <div class="block-content">
         <div class="orderdetail-container">
            <div class="row11 no-margin">
               <div class="order-title">
                  <ul class="list-inline">
                     <li class="list-inline__1">
                        <span class="headline__label">Mã đơn hàng</span>
                        <span class="headline__value"><?php echo $id; ?></span>
                     </li>
                     <li class="list-inline__2">Đặt ngày <?php echo date_format(date_create($info_user['ThoiDiemDatHang']),'d-m-Y H:i:s'); ?></li>
                  </ul>
               </div>
            </div>
            <div class="row">
               <div class="customer-detail">
                  <div class="customer-detail__item col-md-3">
                     <div class="customer-detail__header">
                        Địa chỉ nhận hàng
                     </div>
                     <?php echo $info_user['TenNguoiNhan']; ?>,&nbsp;<?php echo $info_user['soDT']; ?><br/>
                     <?php echo $info_user['DiaChi']; ?>
                  </div>
                  <div class="customer-detail__item col-md-3">
                     <div class="customer-detail__header">
                        Thông tin hóa đơn
                     </div>
                     <?php echo $info_user['TenNguoiNhan']; ?>,&nbsp;<?php echo $info_user['soDT']; ?><br/>
                     <?php echo $info_user['DiaChi']; ?>
                  </div>
                  <div class="customer-detail__item col-md-3">
                     <div class="customer-detail__header">
                        Phương thức thanh toán
                     </div>
                     Thanh toán khi nhận hàng
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
            <div class="row11 no-margin">
               <div class="order-detail table-responsive">
                  <table class="table">
                     <thead>
                        <tr>
                           <th class="text-center">ID Đơn hàng</th>
                           <th class="text-center">Hình sản phẩm</th>
                           <th class="text-center">Tên sản phẩm</th>
                           <th class="text-center">Số lượng</th>
                           <th class="text-center">Đơn giá</th>
                           <th class="text-center">Tạm tính</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $dh = get_records("tbl_donhangchitiet","idDH='$id'","id desc"," "," ");
                           while ($row_dh = mysqli_fetch_assoc($dh)) {
                              $kq=get_records("tbl_item","id='".$row_dh['idSP']."'"," "," "," ");
                              $row1=mysqli_fetch_array($kq);
                        ?>
                        <tr>
                           <td class="text-center"><?php echo $row_dh['idDH']; ?></td>
                           <td class="text-center"><img src="../<?=$row1['image']?>" class="product-brief__image" /></td>
                           <td class="text-center"><?php echo $row1['name']?></td>
                           <td class="text-center"><?php echo $row_dh['SoLuong']?></td>
                           <td class="text-center"><?php echo price_according_currency($row_dh['DonGia']);?></td>
                           <td class="text-center"><?php echo price_according_currency($row_dh['SoLuong']*$row_dh['DonGia']); ?></td>
                        </tr>
                        <?php 
                              $tongcong = $tongcong + $row_dh['SoLuong'] * $row_dh['DonGia'];
                           } 
                        ?>
                     </tbody>
                     <tfoot>
                        <tr>
                           <td colspan="4"></td>
                           <td class="text-center"><label class="control-label">Tổng tiền</label></td>
                           <td class="text-center">
                              <?php echo price_according_currency($tongcong); ?>
                           </td>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
