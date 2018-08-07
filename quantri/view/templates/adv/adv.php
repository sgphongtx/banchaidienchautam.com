<?php        
    switch ($_GET['action']){
        case 'del' :
            $id = $_GET['id'];
            $r = getRecord("tbl_ad","id=".$id);
            if($r['idshop']==$idshop){                 
                @$result = mysqli_query($conn,"delete from tbl_ad where id='".$id."'");
                if ($result){
                    $errMsg1 = "Đã xóa thành công.";
                }else $errMsg2 = "Không thể xóa dữ liệu !";                 
            }
            break;
    }

    if (isset($_POST['btnDel'])){
        $cntDel=0;
        $cntNotDel=0;
        if($_POST['chk']!=''){
            foreach ($_POST['chk'] as $id){
                $r = getRecord("tbl_ad","id=".$id);
                if($r['idshop']==$idshop){
                     
                    @$result = mysqli_query($conn,"delete from tbl_ad where id='".$id."'");
                    if ($result){
                        $cntDel++;
                    }else $cntNotDel++;
                     
                }
            }
            $errMsg1 = "Đã xóa ".$cntDel." phần tử.<br><br>";
            $errMsg2 .= $cntNotDel>0 ? "Không thể xóa ".$cntNotDel." phần tử.<br>" : '';
        }else{
            $errMsg2 = "Hãy chọn trước khi xóa !";
        }
    }
?>
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Quảng cáo <small>Danh sách quảng cáo</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li>Danh sách quảng cáo</li>
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
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /block-content-top -->

            <?php
                $pageSize = 10;
                $pageNum = 1;
                $totalRows = 0;
                
                if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
                if ($pageNum<=0) $pageNum=1;
                $startRow = ($pageNum-1) * $pageSize;
            
                $where="1=1 and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1) and (idshop='{$idshop}') and (cate=0 or cate=1 or cate=2 or cate=3 or cate=7 or cate=8)";
                $totalRows=countRecord("tbl_ad",$where);
            ?>
            <form method="POST" action="#" name="frmForm" enctype="multipart/form-data">
                <input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />
                <input type="hidden" name="page" value="<?=$_REQUEST['pageNum']?>" />

                <div class="table-responsive">
                    <table class="table table-bordered table-hover btl-list-bbli bg-white">
                        <thead>
                            <tr>
                                <td style="width: 1px;" class="text-center">
                                    <input type="checkbox" name="chk[]" class="tai_c" id="chkall" value="<?php echo $row['id']?>" />
                                </td>
                                <td style="width: 50px;" class="text-center">
                                    <a href="<?=url_direct('get',$_GET['act'])?>&pageNum=<?=$_REQUEST['page']?>&sortby=id&direction=<?=$_REQUEST['direction']==1?0:1?>">ID</a>
                                </td>
                                <td style="width: 200px;" class="text-center">Hình ảnh</td>
                                <td class="text-left">
                                    <a href="<?=url_direct('get',$_GET['act'])?>&cat=<?=$_REQUEST['cat']?>&pageNum=<?=$_REQUEST['page']?>&sortby=name&direction=<?=$_REQUEST['direction']==1?0:1?>">Tên quảng cáo</a>
                                </td>
                                <td style="width: 200px;" class="text-center">Loại</td>
                                <td style="width: 80px;" class="text-center">Ẩn/Hiện</td>
                                <td style="width: 80px;" class="text-right">Tùy chọn</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sortby="order by date_added";
                            if ($_REQUEST['sortby']!='') $sortby="order by ".$_REQUEST['sortby'];
                            $direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"asc":"desc");
                            
                            $sql="select * from tbl_ad where $where $sortby $direction limit ".($startRow).",".$pageSize;
                            $result=mysqli_query($conn,$sql);
                            $i=0;
                            while($row=mysqli_fetch_array($result)) :
                        ?>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="chk[]" class="tai_c" value="<?=$row['id']?>" />
                                </td>
                                <td class="text-center">
                                    <?=$row['id']?>
                                </td>
                                <td class="text-center">
                                    <?php if($row['image']==true) : ?>
                                    <a href="javascript:void(0)" title="Click vào xem ảnh">
                                        <img src="<?php echo __PATH_UPLOAD__.$row['image']?>" border="0" class="img-thumbnail" style="max-width: 150px;" />
                                    </a>
                                    <?php else : ?>
                                    <img src="<?php echo __PATH_NOIMAGE__; ?>" border="0" class="img-thumbnail" style="max-width: 150px;" />
                                    <?php endif; ?>
                                </td>
                                <td class="text-left">
                                    <?=$row['name']?>
                                </td>
                                <td class="text-center">
                                    <span class="label label-danger">
                                    <?php 
                                        if($row['cate']==0) echo "Quảng cáo";
                                        elseif($row['cate']==1) echo "Quảng cáo chạy bên trái";
                                        elseif($row['cate']==2) echo "Quảng cáo chạy bên phải";
                                        elseif($row['cate']==3) echo "Quảng cáo góc phải dưới footer";
                                        elseif($row['cate']==7) echo "Popup trang chủ";
                                        elseif($row['cate']==8) echo "QC trang chủ";
                                    ?>                                        
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="check tool <?php echo $row['status']==1?'active':'' ?>" data-action='toggleStatus' data-field='status' data-table='tbl_ad' title="Ẩn hiện" value="<?=$row['id']?>"></div>
                                </td>
                                <td class="text-right">
                                    <a href="<?=url_direct('edit',$_GET['act'],'_m','&page='.$_REQUEST['pageNum'].'&id='.$row['id'])?>" title="Sửa" class="btn btn-xs btn-pencil btn-primary">
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
    
});
</script>