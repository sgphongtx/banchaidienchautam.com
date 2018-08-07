<?php
   $errMsg = '';
   $this_page_table = 'tbl_currency';
   if (isset($_POST['btnSave'])) {
      $data_crc = $_POST;
      unset($data_crc["btnSave"]);

      foreach ($data_crc as $key => $value) {
         $data_crc[strtolower(trim(str_replace("txt","",str_replace("slc","",$key))))] = $value;
         unset($data_crc[$key]);
      }

      $check_exit_currency = get_one_field($this_page_table,"idshop=".$idshop." AND code=".$data_crc["code"]);
      if ($_GET['id']) $check_exit_currency = get_one_field($this_page_table,"idshop=".$idshop." AND code=".$data_crc["code"]." AND id<>".$_GET['id']);
      if (count($check_exit_currency)) {
         $errMsg = '<p>Đơn vị tiền tệ này đã tồn tại.</p>';
      } elseif ($data_crc["status"] && $data_crc["title"] && $data_crc["code"]) {
         if($data_crc["status"] != 1 && $data_crc["status"] != 0) {
            $errMsg = '<p>Giá trị trạng thái không hợp lệ.</p>';
         } else {
            if($_GET["id"]):
               foreach ($data_crc as $key => $value) {
                  $vl .= $key."='".$value."',";
               }
               $vl = substr($vl,0,-1);
               $sql = "UPDATE $this_page_table SET $vl WHERE id=".$_GET['id'];
               if (mysqli_query($conn,$sql)) {
                  $url_direct = url_direct('get',$_GET['act'],'_m','&pageNum='.$_REQUEST['page'].'&code=1');
                  echo "<script>window.location='$url_direct'</script>";
               } else {
                  $errMsg = '<p>Cập nhật không thành công.</p>';
               }
            else :
               $data['idshop'] = $idshop;
               $sql = "INSERT INTO $this_page_table (".implode(",",array_keys($data_crc)).") VALUES ('".implode("','",$data_crc)."')";
               if (mysqli_query($conn,$sql)) {
                  $url_direct = url_direct('get',$_GET['act'],'_m','&pageNum='.$_REQUEST['page'].'&code=1');
                  echo "<script>window.location='$url_direct'</script>";
               } else $errMsg = '<p>Thêm mới không thành công.</p>';
            endif;
         }
      } else $errMsg = '<div class="alert alert-danger">Những trường có dấu <strong>*</strong> là bắt buộc.</div>';
   }
   if($data_crc) $result = $data_crc;
   elseif ($_GET["id"]) {
      $result = get_one_row($this_page_table,"id=".$_GET['id'],"");
   }
?>
<div class="content bg-gray-lighter">
   <div class="row items-push">
      <div class="col-sm-7">
         <h1 class="page-heading">Tiền tệ</h1>
      </div>
      <div class="col-sm-5 text-right hidden-xs">
         <ol class="breadcrumb push-10-t">
            <li><a href="<?=url_direct()?>">Quản trị</a>
            </li>
            <li><a href="<?=url_direct("get")?>">Danh sách</a>
            </li>
            <li><?php echo $_GET[ "id"]? "Cập nhật" : "Thêm mới" ?>
            </li>
         </ol>
      </div>
   </div>
</div>
<div class="content">
   <?php if ($errMsg=='') { ?>
   <div class="alert alert-warning alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <p><i>Lưu ý</i>: Những ô có dấu (*) là bắt buộc</p>
   </div>
   <?php } else { ?>
   <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?=$errMsg;?>
   </div>
   <?php } ?>
   <div class="block">
      <div class="block-content">
         <form method="post" name="frmForm" enctype="multipart/form-data" class="form-horizontal">

            <div class="form-group">
               <label class="col-sm-3 control-label">
                  Tiêu đề <font color="red">*</font>
               </label>
               <div class="col-sm-4">
                  <input type="text" name="txtTitle" class="form-control" value="<?=$result["title"] ?>"/>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-3 control-label">
                  Mã code <a target="_blank" href="http://www.xe.com/iso4217.php"><i class="fa fa-question-circle"></i></a><font color="red">*</font>
               </label>
               <div class="col-sm-4">
                  <input type="text" name="txtCode" class="form-control" value="<?=$result["code"] ?>"/>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-3 control-label">
                  Ký hiệu bên trái <a target="_blank" href="http://www.xe.com/symbols.php"><i class="fa fa-question-circle"></i></a>
               </label>
               <div class="col-sm-4">
                  <input type="text" name="txtSymbol_Left" class="form-control" value="<?=$result["symbol_left"] ?>"/>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-3 control-label">
                  Ký hiệu bên phải <a target="_blank" href="http://www.xe.com/symbols.php"><i class="fa fa-question-circle"></i></a>
               </label>
               <div class="col-sm-4">
                  <input type="text" name="txtSymbol_Right" class="form-control" value="<?=$result["symbol_right"] ?>"/>
               </div>
            </div>

            <div class="form-group">
               <label class="col-sm-3 control-label"> chữ số thập phân </label>
               <div class="col-sm-4">
                  <input type="text" name="txtDecimal_Place" class="form-control" value="<?=$result["decimal_place"] ?>"/>
               </div>
            </div>

            <div class="form-group">
               <label class="col-sm-3 control-label"> Tỉ giá </label>
               <div class="col-sm-4">
                  <input type="text" name="txtValue" class="form-control" value="<?=$result["value"] ?>"/>
               </div>
            </div>

            <div class="form-group">
               <label class="col-sm-3 control-label">
                  Trạng thái <font color="red">*</font>
               </label>
               <div class="col-sm-4">
                  <select class="form-control" name="slcStatus">
                     <option value="1" <?php echo $result[ "status"]==1 ? "selected": "" ?>
                        <?php echo $result["status"] !="" ? "" : "selected" ?>>Kích hoạt</option>
                     <option value="0" <?php if($result[ "status"] && $result[ "status"]==0 ) echo "selected" ?>>Vô hiệu</option>
                  </select>
               </div>
            </div>

            <div class="form-group">
               <div class="col-sm-3"></div>
               <div class="col-sm-4">
                  <button type="submit" name="btnSave" class="btn btn-primary">Chấp nhận</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>