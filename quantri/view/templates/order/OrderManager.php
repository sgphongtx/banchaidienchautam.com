<?php 
    if (isset($_POST['btnDel'])){
        $cntDel=0;
        $cntNotDel=0;
        $cntParentExist=0;
        if($_POST['chk']!=''){
            foreach ($_POST['chk'] as $id){
                $r = getRecord("tbl_donhang","id=".$id);
                if($r['idshop']==$idshop){
                    @$result = mysqli_query($conn,"delete from tbl_donhang where id='".$id."'");
                    if ($result){
                        $cntDel++;
                    }else $cntNotDel++;
                }
            }
            $errMsg1 = "Đã xóa ".$cntDel." phần tử.<br><br>";
            $errMsg2 .= $cntNotDel>0 ? "Không thể xóa ".$cntNotDel." phần tử.<br>" : '';
        }else{
            $errMsg3 = "Hãy chọn trước khi xóa !";
        }
    }
?>

<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Đơn hàng <small>Quản lý đơn hàng</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li>Danh sách đơn hàng</li>
            </ol>
        </div>
    </div>
</div>
<div class="content" style="min-height: 530px;">
    <div class="block">
        <div class="block-header bg-gray-lighter">
            <span class="block-title">Danh sách</span>
            <span class=" btn btn-success pull-right hidden" >
                <a href="view/templates/order/exportEmail.php" style="color:#fff;"><i class="fa fa-file-excel-o" style="color:#fff;"></i> Excel</a>
            </span>
        </div>

        <div class="block-content">
            <form method="POST" action="" name="frmForm" enctype="multipart/form-data">
            <div class="table-responsive">
                <div id="main_order">
                    <table class="table table-bordered table-hover btl-list-bbli bg-white">
                        <thead>
                           
                            <tr>
                                 <td style="width: 1px;" class="text-center">
                                    <input type="checkbox" name="chk[]" id="chkall" class="tai_c" value="<?=$row['id']?>" />
                                </td>
                                <td style="width: 50px;" class="text-center">ID</td>
                                <td class="text-left">Tên khách hàng</td>
                                <td style="width: 200px;" class="text-center">Thời gian đặt hàng</td>
                                <td style="width: 300px;" class="text-center">Trạng thái</td>
                                <td style="width: 180px;" class="text-center">Tổng tiền</td>
                                <td style="width: 90px;" class="text-center">Tùy chọn</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = mysqli_query($conn,"select * from tbl_donhang where idshop=".$idshop." order by id desc");
                                while($row = mysqli_fetch_array($query)) : 
                            ?>
                            <tr>
                                <td class="text-center">
                                        <input type="checkbox" name="chk[]" class="tai_c" value="<?php echo $row['id']?>" />
                                    </td>
                                <td class="text-center">
                                    <?=$row['id']?>
                                </td>
                                <td class="text-left">
                                    <a href="<?=url_direct('edit','order','_m','&id='.$row['id'])?>"><?=$row['TenNguoiNhan']?></a>
                                </td>
                                <td class="text-center">
                                    <?=$row['ThoiDiemDatHang']?>
                                </td>
                                <td class="text-center">
                                    <select name="trangthai" class="form-control" id="trangthai" iddonhang="<?php echo $row['id']; ?>" sosanh="<?php echo $row['status']; ?>">
                                        <option value="1">Chờ xử lí</option>
                                        <option value="4">Chờ xuất hàng</option>
                                        <option value="7">Hoàn thành</option>
                                        <option value="9">Huỷ đơn hàng</option>
                                        <option value="10">Từ chối đơn hàng</option>
                                        <option value="11">Hoàn trả đơn hàng</option>
                                        <option value="12">Đã tiếp nhận</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <?=price_according_currency($row['price'])?>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-xs btn-danger" id="xoa_order" href="#" iddonhang="<?php echo $row['id']; ?>">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-center">
                                    <button type="submit" name="btnDel" class="btn btn-danger btn-xs" onClick="return confirm('Bạn có chắc chắn muốn xóa ?');">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                                <td colspan="7"></td>
                            </tr>
                        </tfoot>    
                    </table>
                </div>

            </div>
        </form>
        </div>
    </div>
    
</div>
<script language='javascript'>
    $(document).ready(function(){
         $('#main_order tr td #xoa_order').click(function(){
            var check = confirm('Bạn có muốn xoá đơn hàng này');
            var iddonhang = $(this).attr('iddonhang');
            if(check)
            {
                $.ajax({
                    url: 'view/templates/order/Delete_order.php',
                    type: 'GET',
                    data: {'iddonhang': iddonhang},
                })
                .done(function(data) {
                    alert(data);
                });
            }
            if(check)
            {
                $(this).parent().parent().css('display','none');
            }
            return false;
         })
    })
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#main_order #trangthai').change(function(){
            var status = $(this).find('option:selected').attr('value');
            var iddonhang = $(this).attr('iddonhang');
            $.ajax({
                url: 'view/templates/order/Save_Status.php',
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
            LayIndexSelect($(this).attr('sosanh'),$(this).find('option'))
        });
    })
</script>

<script language="JavaScript">
function chkallClick(o) {
    var form = document.frmForm;
    for (var i = 0; i < form.elements.length; i++) {
        if (form.elements[i].type == "checkbox" && form.elements[i].name!="chkall") {
            form.elements[i].checked = document.frmForm.chkall.checked;
        }
    }
}
</script>
<script type="text/javascript">
$(document).ready(function() {
    
    $("#chkall").click(function(){
        var status=this.checked;
        $("input[class='tai_c']").each(function(){this.checked=status;})
    });
});
</script>