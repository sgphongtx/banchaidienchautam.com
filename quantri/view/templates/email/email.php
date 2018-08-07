<?php        
    switch ($_GET['action']){
        case 'del' :        
            $id = $_GET['id'];        
            $r = getRecord("tbl_email","id=".$id);        
            if($r['idshop']==$idshop){        
                $resultParent = mysqli_query($conn,"select id from tbl_email where parent='".$id."'");
                if (mysqli_num_rows($resultParent) <= 0){        
                    @$result = mysqli_query($conn,"delete from tbl_email where id='".$id."'");
                    if ($result){
                        $errMsg1 = "Đã xóa thành công.";        
                    }else $errMsg2 = "Không thể xóa dữ liệu !";        
                }else{        
                    $errMsg3 = "Đang có danh mục sử dụng. Bạn không thể xóa !";         
                }        
            }        
        break;       
    }

    if (isset($_POST['btnDel'])){        
        $cntDel=0;        
        $cntNotDel=0;
        $cntParentExist=0;        
        if($_POST['chk']!=''){        
            foreach ($_POST['chk'] as $id){        
                $r = getRecord("tbl_email","id=".$id);        
                if($r['idshop']==$idshop){        
                    $resultParent = mysqli_query($conn,"select id from tbl_email where parent='".$id."'");
                    if (mysqli_num_rows($resultParent) <= 0){        
                        @$result = mysqli_query($conn,"delete from tbl_email where id='".$id."'");
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
            <h1 class="page-heading">Đăng ký nhận tin qua mail</h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li>Danh sách Email</li>
            </ol>
        </div>
    </div>
</div>
<div class="content" style="min-height: 530px;">
    <div class="block">
        <div class="block-header bg-gray-lighter">
            <span class="block-title">Danh sách</span>
            <button type="button" onclick="location.href='view/templates/email/emaiLexport.php'" class="btn btn-primary btn-sm pull-right"><i class="fa fa-file-excel-o"></i> Xuất file excel</button>
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
        
                $where="1=1 and idshop='{$idshop}'"; 
                $totalRows=countRecord("tbl_email",$where);
            ?>
            <div class="table-responsive">
                <form method="POST" action="#" name="frmForm" enctype="multipart/form-data">
                    <input type="hidden" name="page" value="<?=$page?>" />
                    <input type="hidden" name="act" value="email" />

                    <table class="table table-bordered table-hover btl-list-bbli bg-white">
                        <thead>
                            <tr>
                                <td style="width: 1px;" class="text-center">
                                    <input type="checkbox" name="chk[]" class="tai_c" id="chkall" value="<?php echo $row['id']?>" />
                                </td>
                                <td style="width: 50px;" class="text-center">ID</td>
                                <td class="text-left">Email</td>
                                <td style="width: 80px;" class="text-center">Ẩn/Hiện</td>
                                <td style="width: 80px;" class="text-right">Tùy chọn</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sortby="order by date_added";
                                if ($_REQUEST['sortby']!='') $sortby="order by ".(int)$_REQUEST['sortby'];
                                $direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"");
                                
                                $sql="select *,DATE_FORMAT(date_added,'%d/%m/%Y %h:%i') as dateAdd,DATE_FORMAT(last_modified,'%d/%m/%Y %h:%i') as dateModify from tbl_email where $where $sortby $direction limit ".($startRow).",".$pageSize;
                                $result=mysqli_query($conn,$sql);
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
                                    <?=$row['email']?>
                                </td>
                                <td class="text-center">
                                    <div class="check tool <?php echo $row['status']==1?'active':'' ?>" data-action='toggleStatus' data-field='status' data-table='tbl_email' title="Ẩn hiện" value="<?=$row['id']?>"></div>
                                </td>
                                <td class="text-right">
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
                                <td colspan="4"></td>
                            </tr>
                        </tfoot> 
                    </table>
                </form>
            </div>
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