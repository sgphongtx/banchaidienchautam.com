<?php
if (isset($_POST['tim'])==true)//isset kiem tra submit
{ 
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
?>
<?php 
    switch ($_GET['action']){
    case 'del' :
        $id= $_GET['id'];
        $r = getRecord("tbl_comment","id=".$id);
            @$result = mysqli_query($conn,"delete from tbl_comment where id='".$id."'");
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
                $r = getRecord("tbl_comment","id=".$id);
                    @$result = mysqli_query($conn,"delete from tbl_comment where id='".$id."'");
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

<div class="content" style="min-height: 530px;">
    <h3>Danh sách ý kiến</h3>
    <div class="table-responsive bg-white">
        <div class="block-header">
            <form class="form-inline" method="POST" action="" name="frmForm" enctype="multipart/form-data">
                <div class="col-sm-2">
                    <button type="button" onclick="location.href='<?=url_direct('add')?>'" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus-circle"></i>Thêm mới ý kiến</button>
                </div><!-- End .fils1 --> 
                <div class="form-group col-sm-5">          
                    <button type="submit" name="reset" class="btn btn-default">Reset</button>
                    <input name="tukhoa" type="text" class="form-control" id="tukhoa" onfocus="if(this.value=='Tìm kiếm...') this.value='';" onblur="if(this.value=='') this.value='Tìm kiếm...';" value="Tìm kiếm..." />
                    <button type="submit" name="tim" class="btn btn-default">
                        <i class="fa fa-search"></i>                        
                    </button>
                </div><!-- End .fils2 -->
            </form>
        </div>
        <div class="block-content block-content-full text-center">
            
            <?php if($errMsg1 != '') { ?>
            <div class="alert alert-success"><?=$errMsg1?></div>
            <?php }elseif($errMsg2 != '') { ?>
            <div class="alert alert-danger"><?=$errMsg2?></div>
            <?php }elseif($errMsg3 != '') { ?>
            <div class="alert alert-warning"><?=$errMsg3?></div>
            <?php } ?>
            
            <?php            
                $pageSize = 10;
                $pageNum = 1;
                $totalRows = 0;
                
                if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
                if ($pageNum<=0) $pageNum=1;
                $startRow = ($pageNum-1) * $pageSize;
            
                $where="1=1 and (id='{$tukhoa}' or hoten LIKE '%$tukhoa%' or '{$tukhoa}'=-1)";
                
                $MAXPAGE=1;
                $totalRows=countRecord("tbl_comment",$where);
            ?>
            <form method="POST" action="" name="frmForm" enctype="multipart/form-data">
                <input type="hidden" name="page" value="<?=$page?>" />
                <input type="hidden" name="act" value="comment" />
                <? if ($_REQUEST['code']==1) echo '<div class="alert alert-success">Cập nhật thành công</div>'; ?>
                <table class="table table-bordered table-hover btl-list-bbli bg-white">
                    <thead>
                        <tr>
                            <td style="width: 1px;" class="text-center">
                                <input type="checkbox" name="chk[]" class="tai_c" id="chkall" value="<?=$row['id']?>" />
                            </td>
                            <td style="width: 1px;" class="text-center">ID</td>
                            <td style="width: 100px;" class="text-center">Tên</td>
                            <td class="text-center">Câu hỏi</td>
                            <td style="width: 70px;" class="text-center">Ẩn/Hiện</td>
                            <td style="width: 90px;" class="text-center">Tùy chọn</td>
                        </tr>
                    </thead>                    
                    <tbody>
                        <?php
                            $sortby="order by date_added";
                            if ($_REQUEST['sortby']!='') $sortby="order by ".(int)$_REQUEST['sortby'];
                            $direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"");
                            
                            $sql="select *,DATE_FORMAT(date_added,'%d/%m/%Y %h:%i') as dateAdd,DATE_FORMAT(last_modified,'%d/%m/%Y %h:%i') as dateModify from tbl_comment where 1=1 and $where $sortby $direction limit ".($startRow).",".$pageSize;
                            $result=mysqli_query($conn,$sql);
                            $i=0;
                            while($row=mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="chk[]" class="tai_c" value="<?=$row['id']?>" />
                            </td>
                            <td class="text-center">
                                <?=$row['id']?>
                            </td>
                            <td class="text-center">
                                <?=$row['hoten']?>
                            </td>
                            <td class="text-center">
                                <?=$row['noidung']?>
                            </td>
                            <td class="text-center">
                                <div class="check tool <?php echo $row['status']==1?'active':'' ?>" data-action='toggleStatus' data-field='status' data-table='tbl_comment' title="Ẩn hiện" value="<?php echo $row['id']?>"></div>
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
                        <?php } ?>
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
            </form> 
        </div>
        <nav>
            <ul class="pager">
                <?php echo pagesLinks($totalRows,$pageSize);?>
            </ul>
        </nav><!-- End pagination -->
    </div>
</div>
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