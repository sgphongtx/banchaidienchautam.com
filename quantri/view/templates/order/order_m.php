<?php $errMsg =''?>
<?php
if (isset($_POST['btnSave'])){ 
    $nguoinhan          = isset($_POST['TenNguoiNhan']) ? trim($_POST['TenNguoiNhan']) : '';
    $soDT               = isset($_POST['soDT']) ? trim($_POST['soDT']) : '';
    $DiaChi             = isset($_POST['DiaChi']) ? trim($_POST['DiaChi']) : '';
    $yahoo              = isset($_POST['yahoo']) ? trim($_POST['yahoo']) : '';
    $status             = isset($_POST['status'])?$_POST['status']:1;
    if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql_update1111 = "update tbl_donhang set TenNguoiNhan='".$nguoinhan."', soDT='".$soDT."', DiaChi='".$DiaChi."', yahoo='".$yahoo."',status='".$status."' where id='".$oldid."'";
		}
        if (mysqli_query($conn,$sql_update1111)){
            $errMsg = '';
        }else{
			$errMsg = "Không thể cập nhật..!";
        }
    }
    if ($errMsg == '') {
        echo thongbao(url_direct('get','manage_orders'), $thongbao = 'Cập nhật đơn hàng thành công..!');
    }
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_donhang where id='".$oldid."'";
		if ($result = mysqli_query($conn,$sql)) {
			$row=mysqli_fetch_array($result);
			$nguoinhan       = $row['TenNguoiNhan'];
            $soDT            =$row['soDT'];
            $DiaChi          =$row['DiaChi'];
            $yahoo           =$row['yahoo'];
            $status          =$row['status'];
		}
	}
}
?>
<?php 
$id=$_GET['id'];
?>
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Đơn hàng <small>Chi tiết đơn hàng</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li><a href="<?=url_direct('get','manage_orders')?>">Danh sách Đơn hàng</a></li>
                <li>Chi tiết đơn hàng</li>
            </ol>
        </div>
    </div>
</div>
<div class="content" style="min-height: 530px;">
    <div class="bs-example bs-example-bg-classes">
        <?php if($errMsg != '') { ?>
        <p class="bg-warning"><?php echo $errMsg; ?></p>
        <?php } else { ?>
        <p class="bg-warning">Lưu ý: Những ô có dấu (<font color="red">*</font>) là bắt buộc</p>
        <?php } ?>
    </div>
    <div class="block">
        <div class="block-content" id="main_order">
            <form method="post" name="frmForm" enctype="multipart/form-data" class="form-horizontal">
                <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
                
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        Tên người đặt hàng <font color="red">*</font>
                    </label>
                    <div class="col-sm-6">
                        <input type="text" name="TenNguoiNhan" class="form-control" value="<?=$nguoinhan?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        Điện thoại
                    </label>
                    <div class="col-sm-6">
                        <input type="text" name="soDT" class="form-control" value="<?=$soDT?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        Địa chỉ
                    </label>
                    <div class="col-sm-6">
                        <input type="text" name="DiaChi" class="form-control" value="<?=$DiaChi?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        Email
                    </label>
                    <div class="col-sm-6">
                        <input type="text" name="yahoo" class="form-control" value="<?=$yahoo?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        Tình trạng xử lý <font color="red">*</font>
                    </label>
                    <div class="col-sm-6">
                        <select name="status" class="form-control" id="trangthai" iddonhang="<?php echo $_GET['id']; ?>" sosanh="<?=$status ?>">
                            <option <?php echo ($status==1)?'selected="selected"':'' ?> value="1">Chờ xử lí</option>
                            <option <?php echo ($status==4)?'selected="selected"':'' ?> value="4">Chờ xuất hàng</option>
                            <option <?php echo ($status==7)?'selected="selected"':'' ?> value="7">Hoàn thành</option>
                            <option <?php echo ($status==9)?'selected="selected"':'' ?> value="9">Huỷ đơn hàng</option>
                            <option <?php echo ($status==10)?'selected="selected"':'' ?> value="10">Từ chối đơn hàng</option>
                            <option <?php echo ($status==11)?'selected="selected"':'' ?> value="11">hHàn trả đơn hàng</option>
                            <option <?php echo ($status==12)?'selected="selected"':'' ?> value="12">Đã tiếp nhận</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover btl-list-bbli bg-white">
                        <thead>
                            <tr>
                                <td class="text-center">Mã đơn hàng</td>
                                <td class="text-center">Hình sản phẩm</td>
                                <td class="text-center">Tên sản phẩm</td>
                                <td class="text-center">Số lượng</td>
                                <td class="text-center">Đơn giá</td>
                                <td class="text-center">Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tongcong=0;
                                $where=" idDH=".$id;
                                $sortby="order by id";
                                if ($_REQUEST['sortby']!='') $sortby="order by ".(int)$_REQUEST['sortby'];
                                $direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"");
                                
                                $sql="select * from tbl_donhangchitiet where $where $sortby $direction ";
                                $result=mysqli_query($conn,$sql);
                                while($row=mysqli_fetch_array($result)) :
                                    $kq=get_records('tbl_item','id='.$row['idSP'],' ',' ',' ');
                                    $row1=mysqli_fetch_array($kq);
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?=$row1['idDH']?>
                                </td>
                                <td class="text-center">
                                    <img src="<?=__PATH_UPLOAD__.$row1['image']?>" border="0" class="img-thumbnail" width="50" />
                                </td>
                                <td class="text-center">
                                    <?=$row1['name']?>
                                </td>
                                <td class="text-center">
                                    <?=$row['SoLuong']?>
                                </td>
                                <td class="text-center">
                                    <?=price_according_currency($row['DonGia'])?>
                                </td>
                                <td class="text-center"><?=price_according_currency($row['SoLuong']*$row['DonGia'])?></td>
                            </tr>
                            <?php $tongcong=$tongcong+$row['SoLuong']*$row['DonGia']; ?>
                            <?php endwhile; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right">
                                    <label class="control-label">Tổng tiền</label>
                                </td>
                                <td class="text-left">
                                    <?=price_according_currency($tongcong)?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4 btn-gr">
                        <button type="submit" name="btnSave" class="btn btn-default">Chấp nhận</button>
                        <button onclick="goBack()" type="button" name="goback" class="btn btn-default">Quay lại</button>
                    </div>
                </div>          
            </form>
        </div>
    </div>
</div>


<script language='javascript'>
    $(document).ready(function(){
        $('#main_order #trangthai').change(function(){
            var status = $(this).find('option:selected').attr('value');
            var iddonhang = $(this).attr('iddonhang');
            $.ajax({
                url: 'order/Save_Status.php',
                type: 'GET',
                data: {'status': status, 'iddonhang': iddonhang},
            })
            .done(function(data) {
                alert(data);
            });
        });
        function LayIndexSelect(valueoption, selectval) {
            sooption = selectval.length;
            for(i = 0; i < sooption; i++)
            {
                if(selectval.eq(i).val() == valueoption)
                    selectval.eq(i).attr('selected','selected');
            }
        }
        $('#main_order #trangthai').each(function(){
            //var $(this).attr('sosanh'));
            LayIndexSelect($(this).attr('sosanh'),$(this).find('option'))
        });
    });
</script>