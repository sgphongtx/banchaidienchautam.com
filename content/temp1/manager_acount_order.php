<div class="widget widget-static-block bg-white">
   <div class="login-wrap space-base">
      <div class="block-title">
         <div class="h3"><?php echo module_keyword($mang11, $mang22, 'listorder'); ?></div>
      </div>
      <div class="block-content">
         <div class="table-responsive">
            <table class="table">
               <thead>
                  <tr>
                     <td class="text-center">#</td>
                     <td class="text-center">Thời gian đặt hàng</td>
                     <td class="text-center">Tổng tiền</td>
                     <td class="text-center">Thanh toán</td>
                     <td class="text-center">Trạng thái</td>
                     <td class="text-center">Chi tiết</td>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     function getValueDonHang($trangthai) {
                        $tentrangthai = "";
                        switch ($trangthai) {
                           case "1":
                              $tentrangthai = "Chờ xử lí";
                              break;
                           case "4":
                              $tentrangthai = "Chờ xuất hàng";
                              break;
                           case "7":
                              $tentrangthai = "Hoàn thành";
                              break;
                           case "9":
                              $tentrangthai = "Huỷ đơn hàng";
                              break;
                           case "10":
                              $tentrangthai = "Từ chối đơn hàng";
                              break;
                           case "11":
                              $tentrangthai = "Hoàn trả đơn hàng";
                              break;
                           case "12":
                              $tentrangthai = "Đã tiếp nhận";
                              break;
                        }

                        return $tentrangthai;

                     }
                     $result = get_records("tbl_donhang", "idshop='$idshop' and idKH='".$_SESSION['kh_shop_login_id']."'", "id desc", " ", " ");
                     while ($row = mysqli_fetch_assoc($result)) :
                  ?>
                  <tr>
                     <td class="text-center"><?php echo $row['id']; ?></td>
                     <td class="text-center"><?php echo date_format(date_create($row['ThoiDiemDatHang']),'d-m-Y H:i:s'); ?></td>
                     <td class="text-center"><?php echo price_according_currency($row['price']); ?></td>
                     <td class="text-center">Thanh toán khi nhận hàng</td>
                     <td class="text-center"><?php echo getValueDonHang($row['status']); ?></td>
                     <td class="text-center"><a href="view-order/orderNr=<?php echo $row['id'] ?>"><i class="fa fa-external-link"></i></a></td>
                  </tr>
                  <?php endwhile; ?>
               </tbody>
               <tfoot>
                  <tr>
                     <td colspan="6"></td>
                  </tr>
               </tfoot>
            </table>
         </div>
      </div>
   </div>
</div>
