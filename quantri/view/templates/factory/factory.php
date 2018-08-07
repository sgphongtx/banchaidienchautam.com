<?php
    if (isset($_POST['tim'])==true){//isset kiem tra submit
    	if($_POST['tukhoa']!=NULL){$tukhoa=$_POST['tukhoa'];}else {$tukhoa=-1;}
    	$_SESSION['kt_tukhoa_item']=$tukhoa;
    	$tukhoa = trim(strip_tags($tukhoa));
    }
    if (isset($_POST['reset'])==true) {
    	$_SESSION['kt_tukhoa_item']=-1;
        header("Location:".url_direct('get'));
    }
    if($_SESSION['kt_tukhoa_item']==NULL){$tukhoa=-1;}
    if($_SESSION['kt_tukhoa_item']!=NULL){$tukhoa=$_SESSION['kt_tukhoa_item'];}

    switch ($_GET['action']){
            case 'del' :
                $id = $_GET['id'];
                $r = getRecord("Manufacturer","id=".$id);
                @$result = mysqli_query($conn,"delete from Manufacturer where id='".$id."'");
                if ($result){
                    $errMsg1 = "Đã xóa thành công.";
                }else $errMsg2 = "Không thể xóa dữ liệu !";
                break;
    }

    if (isset($_POST['btnDel'])){
            $cntDel=0;
            $cntNotDel=0;
            if($_POST['chk']!=''){
                foreach ($_POST['chk'] as $id){
                    $r = getRecord("Manufacturer","id=".$id);
                    @$result = mysqli_query($conn,"delete from Manufacturer where id='".$id."'");
                    if ($result){
                        $cntDel++;
                    }else $cntNotDel++;
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
            <h1 class="page-heading">Nhà sản xuất</h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li>Nhà sản xuất</li>
            </ol>
        </div>
    </div>
</div>
<div class="content" style="min-height: 530px;">
    <div class="block">
        <div class="block-header bg-gray-lighter">
            <span class="block-title">Danh sách</span>
            <button type="button" onclick="location.href='<?=url_direct('add')?>'" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus-circle"></i> Tạo mới</button>
        </div>
        <div class="block-content">
            <div class="block-content-top" style="margin-bottom: 20px;">
                <form method="POST" action="" name="frmForm" enctype="multipart/form-data">
                    <div class="dataTable_filter">
                        <div class="row">
                            <div class="col-md-4">
                                <input name="tukhoa" type="text" class="form-control" id="tukhoa"
                                onfocus="if(this.value=='Tìm kiếm...') this.value='';"
                                onblur="if(this.value=='') this.value='Tìm kiếm...';" value="Tìm kiếm..."
                                style="display: inline-block; width: auto; margin-right: 5px;" />
                                <button type="submit" name="tim" class="btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                                <button type="submit" name="reset" class="btn btn-default">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            </div>
                            <div class="col-md-5 pull-right">
                                <?php if ($_REQUEST['code']==1) { ?>
                                <div class="alert alert-success" style="margin-bottom: 0px;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>Cập nhật thành công
                                </div>
                                <?php } ?>
                                <?php if ($errMsg1 != '') { ?>
                                <div class="alert alert-success" style="margin-bottom: 0px;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><?=$errMsg1?>
                                </div>
                                <?php } elseif ($errMsg2 != '') { ?>
                                <div class="alert alert-danger" style="margin-bottom: 0px;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><?=$errMsg2?>
                                </div>
                                <?php } elseif ($errMsg3 != '') { ?>
                                <div class="alert alert-warning" style="margin-bottom: 0px;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><?=$errMsg3?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php
                $pageSize = 10;
                $pageNum = 1;
                $totalRows = 0;

                if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
                if ($pageNum<=0) $pageNum=1;
                $startRow = ($pageNum-1) * $pageSize;
                $where = "id='{$tukhoa}' or name LIKE '%$tukhoa%' or $tukhoa = -1";
                $totalRows=countRecord("Manufacturer",$where);

            ?>
            <form method="POST" action="" name="frmForm" enctype="multipart/form-data">
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="act" value="manufacturer" />
                <div class="table-responsive">
                    <table class="table table-bordered table-hover btl-list-bbli bg-white">
                        <thead>
                            <tr>
                                <td style="width: 1px;" class="text-center">
                                    <input type="checkbox" name="chk[]" class="tai_c" id="chkall" value="<?php echo $row['id']?>" />
                                </td>
                                <td style="width: 50px;" class="text-center">ID</td>
                                <td style="width: 120px;" class="text-center">Hình ảnh</td>
                                <td class="text-left">nhà sản xuất</td>
                                <td style="width: 70px;" class="text-center">Ẩn/Hiện</td>
                                <td style="width: 90px;" class="text-right">Xóa/sửa</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sortby = "order by id desc";

                                $sql = "select * from Manufacturer where $where $sortby limit ".($startRow).",".$pageSize;
                                $result = mysqli_query($conn,$sql);
                                while($row = mysqli_fetch_array($result)) :
                            ?>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="chk[]" class="tai_c" id="chkall" value="<?=$row['id']?>" />
                                </td>
                                <td class="text-center">
                                    <?=$row['id']?>
                                </td>
                                <td class="text-center">
                                    <?php if($row['img']==true) : ?>
                                    <a href="javascript:void(0)" title="Click vào xem ảnh">
                                        <img src="<?php echo __PATH_UPLOAD__.$row['img']?>" border="0" class="img-thumbnail" style="max-width: 50px;" />
                                    </a>
                                    <?php else : ?>
                                    <img src="<?php echo __PATH_NOIMAGE__; ?>" border="0" class="img-thumbnail" style="max-width: 50px;" />
                                    <?php endif; ?>
                                </td>
                                <td class="text-left">
                                    <?php echo $row['name']?>
                                </td>
                                <td class="text-center">
                                    <div class="check tool <?php echo $row['status']==1?'active':'' ?>" data-action='toggleStatus' data-field='status' data-table='Manufacturer' title="Ẩn hiện" value="<?=$row['id']?>"></div>
                                </td>
                                <td class="text-right">
                                    <a href="<?=url_direct('edit',$_GET['act'],'_m','&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['pageNum'].'&id='.$row['id'])?>" title="Sửa" class="btn btn-xs btn-pencil btn-primary">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="<?=url_direct('del',$_GET['act'],null,'&action=del&page='.$_REQUEST['pageNum'].'&id='.$row['id'])?>" title="Xóa"  onclick="return confirm('Bạn có muốn xoá luôn không ?');"  class="btn btn-xs btn-remove btn-danger">
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
            </form>
        </div>

        <nav class="text-center">
            <ul class="pagination">
                <?php echo pagesLinks_digit($totalRows,$pageSize);?>
            </ul>
        </nav><!-- End pagination -->
    </div>

</div>

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

<script>
$(document).ready(function() {

    $("#chkall").click(function(){
        var status=this.checked;
        $("input[class='tai_c']").each(function(){this.checked=status;})
    });
    $('.iteCategory').change(function() {
        var idCat = $(this).find('option:selected').val();
        window.location = '<?=url_direct('get',$_GET['act'],null,'&cat=')?>'+idCat;
    });

});
</script>