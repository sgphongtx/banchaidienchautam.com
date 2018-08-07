<?php
    switch ($_GET['action']){
    case 'del' :
        $id = $_GET['id'];
        $r = getRecord("tbl_keyword","id=".$id);
        if($r['idshop']==$idshop){
            
            @$result = mysqli_query($conn,"delete from tbl_keyword where id='".$id."'");
            if ($result){
                $errMsg1 = "Đã xóa thành công.";
            }else $errMsg2 = "Không thể xóa dữ liệu !";
            
        }
        break;
    }        
    if (isset($_POST['btnDel'])){
        $cntDel=0;
        $cntNotDel=0;
        $cntParentExist=0;
        if($_POST['chk']!=''){
            foreach ($_POST['chk'] as $id){
                $r = getRecord("tbl_keyword","id=".$id);
                if($r['idshop']==$idshop){
                    $resultParent = mysqli_query($conn,"select id from tbl_keyword where parent='".$id."'");
                    if (mysqli_num_rows($resultParent) <= 0){
                        @$result = mysqli_query($conn,"delete from tbl_keyword where id='".$id."'");
                        if ($result){
                            $cntDel++;
                        }else $cntNotDel++;
                    }else{
                        $cntParentExist++;
                    }
                }
            }
            $errMsg1 = "Đã xóa ".$cntDel." phần tử.<br><br>";
            $errMsg2 .= $cntNotDel>0 ? "Không thể xóa ".$cntNotDel." phần tử.<br>" : '';
            $errMsg3 .= $cntParentExist>0 ? "Đang có danh mục con sử dụng ".$cntParentExist." phần tử." : '';
        }else{
            $errMsg3 = "Hãy chọn trước khi xóa !";
        }
    }
?>
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Từ ngữ web</h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li>Từ ngữ web</li>
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
            <!-- /block-content-top -->

            <?php
                $pageSize = 5;
                $pageNum = 1;
                $totalRows = 0;
                
                if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
                if ($pageNum<=0) $pageNum=1;
                $startRow = ($pageNum-1) * $pageSize;
            
                $where="1=1 and (idshop='{$idshop}')  and parent='{$lang}'";
                $totalRows=countRecord("tbl_keyword",$where);
            ?>
            <div class="table-responsive">
                <form method="POST" action="#" name="frmForm" enctype="multipart/form-data">
                    <input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />
                    <input type="hidden" name="page" value="<?=$_REQUEST['pageNum']?>" />

                    <table class="table table-bordered table-hover btl-list-bbli bg-white">
                        <thead>
                            <tr>
                                <td style="width: 1px;" class="text-center">
                                    <input type="checkbox" name="chk[]" class="tai_c" id="chkall" value="<?php echo $row['id']?>" />
                                </td>
                                <td style="width: 50px;" class="text-center">ID</td>
                                <td class="text-center">Ngôn ngữ</td>
                                <td class="text-right">Tùy chọn</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sortby="order by date_added";
                                if ($_REQUEST['sortby']!='') $sortby="order by ".(int)$_REQUEST['sortby'];
                                $direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"");
                                
                                $sql="select * from tbl_keyword where $where $sortby $direction limit ".($startRow).",".$pageSize;
                                
                                $result=mysqli_query($conn,$sql);
                                while($row=mysqli_fetch_array($result)) :
                                    $parent = getRecord('tbl_language','id = '.$row['parent']);
                            ?>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="chk[]" id="chk[]" class="tai_c" id="chkall" value="<?php echo $row['id']; ?>" />
                                </td>
                                <td class="text-center">
                                    <?php echo $row['id']; ?>
                                </td>
                                <td class="text-center">
                                    <span class="label label-danger"><?=$parent['name']?></span>
                                </td>
                                <td class="text-right">
                                    <a href="<?=url_direct('edit',$_GET['act'],'_m','&page='.$_REQUEST['pageNum'].'&id='.$row['id'])?>" class="btn btn-xs btn-pencil btn-primary" title="Sửa">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="<?=url_direct('del',$_GET['act'],null,'&action=del&page='.$_REQUEST['pageNum'].'&id='.$row['id'])?>" class="btn btn-xs btn-remove btn-danger" title="Xóa" onclick="return confirm('Bạn có muốn xoá luôn không ?');" >
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </form>
            </div>

            <nav class="text-center">
                <ul class="pagination">
                    <?php echo pagesLinks_digit($totalRows,$pageSize);?>
                </ul>
            </nav><!-- End pagination -->
        </div>
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