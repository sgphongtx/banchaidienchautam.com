<?php
function LuuChiTietDonHang($idDH, $idSP, $SoLuong, $Gia, $lang, $tl) {
   // Lưu đơn hàng vào dB  
   $vale1 = 'idDH, idSP, Soluong, DonGia';
   $vale2 = "'$idDH', '$idSP', '$SoLuong', '$Gia'";
   $id1   = insert_table('tbl_donhangchitiet', $vale1, $vale2, $hinh);
}
if (isset($_REQUEST['order'])) {
   $idKH    = $_SESSION['kh_shop_login_id'];
   $name    = isset($_REQUEST['InputName']) ? trim($_REQUEST['InputName']) : '';
   $address = isset($_REQUEST['InputAddress']) ? trim($_REQUEST['InputAddress']) : '';
   $phone   = isset($_REQUEST['InputPhone']) ? trim($_REQUEST['InputPhone']) : '';
   $email   = isset($_REQUEST['InputEmail']) ? trim($_REQUEST['InputEmail']) : '';
   $total   = isset($_REQUEST['InputTotal']) ? trim($_REQUEST['InputTotal']) : '';

   $err = false;
   if($name==null) {
      $err = true;
      $errName = '<span class="alert alert-danger"><em>'.av('Bạn chưa nhập họ và tên','Please enter your name !').'</em></span>';
   }
   if($address==null) {
      $err = true;
      $errAddress = '<span class="alert alert-danger"><em>'.av('Bạn chưa nhập địa chỉ','Please enter your address !').'</em></span>';
   }
   if($phone==null) {
      $err = true;
      $errPhone = '<span class="alert alert-danger"><em>'.av('Bạn chưa nhập số điện thoại','Please enter your phone number !').'</em></span>';
   } else {
      if(!preg_match ("/^([0-9]+)$/", $phone)) {
         $err = true;
         $errPhone = '<span class="alert alert-danger"><em>'.av('Điện thoại không hợp lệ. Ví dụ: 0909123456','Your phone is not a number. Example: 0909123456').'</em></span>';
      }
   }
   if($email==null) {
      $err = true;
      $errEmail = '<span class="alert alert-danger"><em>'.av('Bạn chưa nhập email','Please enter your email !').'</em></span>';
   } else {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
         $err = true;
         $errEmail = '<span class="alert alert-danger"><em>'.av($email.' không đúng kiểu',$email.' is not a valid email address !').'</em></span>';
      }
   }

   /********************************************************/

   if($err==FALSE) {

      $_SESSION['price'] = $total;
      $vale1 = 'idshop, price,soDT, ThoiDiemDatHang, TenNguoiNhan, DiaChi, yahoo, GhiChu, status';
      $vale2 = "'$idshop', '$total', '$phone', '$ngay', '$name', '$address', '$email', '$note', '1'";
      $hinh  = "";

      $id1 = insert_table('tbl_donhang',$vale1,$vale2,$hinh);
      $_SESSION['id_DH'] = $id1;
      if ($id1>0) {
         $lastID = $id1;
         $_SESSION['id_DH'] = $lastID;
         $dayid = "id:";
         if (isset($_SESSION['mycart'])) {
            $cart = $_SESSION['mycart']['cart'];
               foreach ($cart as $idSP => $arrid) {
                  $item    = $arrid;
                  $soluong = $item['tongsl'];
                  $dongia  = $item['price'];
                  if ($_SESSION['id_DH'] != "") {
                     LuuChiTietDonHang($lastID, $idSP, $soluong, $dongia, $lang, $tl); // insert chi tiet don hang
                  }
               }
            }

         unset($_SESSION['mycart']);

         header("Location:".$linkroot.'/dat-hang-thanh-cong/');

      }
   }
}
?>
<div class="widget widget-static-block bg-white">
   <div class="checkout-wrap space-base">
      <div class="block-title">
         <div class="h3"><?php echo module_keyword($mang11,$mang22,"order");?></div>
      </div>
      <div class="block-content">
         <?php 
            if($_REQUEST['code']==1) : 
               $id_DH = $_SESSION['id_DH'];
               $row_res = getRecord("tbl_donhang","id='$id_DH'");
         ?>
         <div class="order-result">
            <p class="title-m"><?=av('Cảm ơn đơn đặt hàng của bạn!','Thanks for your order!')?></p>
            <p><?php echo $row_shop['name']; ?> <?=av('sẽ liên hệ quý khách trong vòng 24h làm việc','Will contact you during 24 hours working')?></p>
            <p class="str"><?=av('Luôn giữ điện thoại bên cạnh bạn nhé!','Always keep your phone next to you!')?></p>
            <div class="info">
               <div class="idcode"><?=av('Số đơn hàng','Order number')?><strong>#<?php echo $id_DH; ?></strong></div>
               <div class="desc">
                  <strong><?=av('Người nhận','To')?>:</strong> <?php echo $row_res['TenNguoiNhan']; ?> <br>
                  <strong><?=av('Địa chỉ','Address')?>:</strong> <?php echo $row_res['DiaChi']; ?> <br>
                  <strong><?=av('Điện thoại','Phone')?>:</strong> <?php echo $row_res['soDT']; ?>
               </div>
            </div>
            <div class="button">
               <a href="<?php echo $linkroot; ?>" class="btn btn-primary"><i class="fa fa-chevron-left"></i> <?=av('Tiếp tục mua hàng','Shopping continue')?></a>
            </div>
         </div>
         <?php unset($_SESSION['mycart']); ?>
         <?php else : 
            if(isset($_SESSION['kh_shop_login_id'])) {
               $a2 = getRecord("tbl_customer_shop","id='".$_SESSION['kh_shop_login_id']."'");
            }
            if (isset($_SESSION['mycart'])) :
         ?>
         <div class="checkout-content">
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" enctype="multipart/form-data" class="form-horizontal">
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                  <!--REVIEW ORDER-->
                  <div class="panel panel-info">
                     <div class="panel-heading">
                        <?=av('Xem trước đơn hàng','Review Order')?> <div class="pull-right"><small><a class="afix-1" href="/xem-gio-hang"><?=av('Chỉnh sửa giỏ hàng','Edit Cart')?></a></small></div>
                     </div>
                     <div class="panel-body">
                        <?php
                           $cart = $_SESSION['mycart']['cart'];
                           foreach ($cart as $idSP => $arr_cart) :
                              $item = $arr_cart;
                        ?>
                        <div class="form-group">
                           <div class="col-md-3 col-sm-3 col-xs-3">
                              <a href="<?=$linkroot?>/<?=$item['link']?>" >
                                 <img class="img-responsive" 
                                       src="<?php echo $path_image.$item['url_image']; ?>" 
                                       alt="<?=$item['name']?>" />
                              </a>
                           </div>
                           <div class="col-md-6 col-sm-6 col-xs-6">
                              <div class="name"><a href="<?=$linkroot?>/<?=$item['link']?>"><?=$item['name'];?></a></div>
                              <div class="quantity">
                                 <small><?php echo module_keyword($mang11,$mang22,"quanty_sp");?>: <span><? echo $item['tongsl'];?></span></small>
                              </div>
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                              <h6>
                                 <?php
                                    $tien = $item['price'] * $item['tongsl'];
                                    if(preg_match ("/^([0-9]+)$/", $tien)) echo number_format($tien,0).' '.$row_shop['tiente']; else echo $tien;
                                 ?>
                              </h6>
                           </div>
                        </div>
                        <div class="form-group"><hr /></div>
                        <?php endforeach; ?>
                        <div class="form-group">
                           <div class="col-md-12 col-xs-12">
                              <strong><?=av('Tạm tính','Subtotal')?></strong>
                              <div class="pull-right">
                                 <span>
                                 <?php
                                    $tongtien = $_SESSION['mycart']['tongtien'];
                                    if(preg_match ("/^([0-9]+)$/", $tongtien)) echo number_format($tongtien,0).' '.$row_shop['tiente']; else echo $tongtien;
                                 ?>
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-12 col-xs-12">
                              <small>Shipping</small>
                              <div class="pull-right"><span>-</span></div>
                           </div>
                        </div>
                        <div class="form-group"><hr /></div>
                        <div class="form-group">
                           <div class="col-md-12 col-xs-12">
                              <strong><?php echo module_keyword($mang11,$mang22,"totalprice_sp");?></strong>
                              <div class="pull-right">
                                 <input type="hidden" name="InputTotal" value="<?php echo $_SESSION['mycart']['tongtien']; ?>">
                                 <span>
                                 <?php
                                    $tongtien = $_SESSION['mycart']['tongtien'];
                                    if(preg_match ("/^([0-9]+)$/", $tongtien)) echo number_format($tongtien,0).' '.$row_shop['tiente']; else echo $tongtien;
                                 ?>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--REVIEW ORDER END-->
               </div>

               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                  <!--SHIPPING METHOD-->
                  <div class="panel panel-info">
                     <div class="panel-heading"><?=av('Thông tin người nhận','Shipping address')?></div>
                     <div class="panel-body">
                        <div class="form-group">
                           <div class="col-md-12"><strong><?php echo av('Họ và tên','Name');?>:</strong></div>
                           <div class="col-md-12 <?php echo $errName!='' ? 'has-error has-feedback' : ''; ?>">
                              <input type="text" name="InputName" class="form-control" id="InputName" value="<?=$a2['name'];?>"/>
                           </div>
                           <?php echo $errName; ?>
                        </div>
                        <div class="form-group">
                           <div class="col-md-12"><strong><?php echo av('Địa chỉ','Address') ?>:</strong></div>
                           <div class="col-md-12 <?php echo $errAddress!='' ? 'has-error has-feedback' : ''; ?>">
                              <input type="text" name="InputAddress" class="form-control" id="InputAddress" value="<?=$a2['address']?>"/>
                           </div>
                           <?php echo $errAddress; ?>
                        </div>
                        <div class="form-group">
                           <div class="col-md-12"><strong><?php echo av('Điện thoại','Phone Number') ?>:</strong></div>
                           <div class="col-md-12 <?php echo $errPhone!='' ? 'has-error has-feedback' : ''; ?>">
                              <input type="text" class="form-control" name="InputPhone" id="InputPhone" value="<?=$a2['mobile']?>"/>
                           </div>
                           <?php echo $errPhone; ?>
                        </div>
                        <div class="form-group">
                           <div class="col-md-12"><strong>Email:</strong></div>
                           <div class="col-md-12 <?php echo $errEmail!='' ? 'has-error has-feedback' : ''; ?>">
                              <input type="email" class="form-control" name="InputEmail" id="InputEmailFirst" value="<?=$a2['email']?>" />
                           </div>
                           <?php echo $errEmail; ?>
                        </div>
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="submit" name="order" id="submit" value="<?=av('Đặt hàng','Order')?>" class="btn btn-primary btn-submit-fix" />
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--SHIPPING METHOD END-->
               </div>
            </form>
            <div class="clearfix"></div>
         </div>
         <!-- checkout-content -->
            <?php endif; ?>
         <?php endif;?>
      </div>
   </div>
</div>