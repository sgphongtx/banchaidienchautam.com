<?php
    switch ($_GET['action']){
        case 'del' :
            $id = $_GET['id'];
            $r = getRecord("tbl_item_category","id=".$id);
            if($r['idshop']==$idshop && $r['del']==1){
                 
                if (isHaveChild("tbl_item_category", $id)==false){
                    @$result = mysqli_query($conn,"delete from tbl_item_category where id='".$id."'");
                    if ($result){
                        if($r['belong']==1) {
                            if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
                            if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
                            $errMsg1 = "Đã xóa thành công.";
                        }
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
                $r = getRecord("tbl_item_category","id=".$id);
                if($r['idshop']==$idshop && $r['del']==1){
                     
                    if (isHaveChild("tbl_item_category", $id)==false){
                        @$result = mysqli_query($conn,"delete from tbl_item_category where id='".$id."'");
                        if ($result){
                            if($r['belong']==1) {
                                if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
                                if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);                                  
                            }
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
            <h1 class="page-heading">Ngôn ngữ</h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li>Danh sách ngôn ngữ</li>
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
                $pageSize = 10;
                $pageNum = 1;
                $totalRows = 0;
                
                if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
                if ($pageNum<=0) $pageNum=1;
                $startRow = ($pageNum-1) * $pageSize;
            
                $where="1=1 and (cate=1 or cate=0) and (idshop='{$idshop}' or del=0) and parent=1";
                
                $MAXPAGE=1;
                $totalRows=countRecord("tbl_item_category",$where);
            ?>
            <div class="table-responsive">
                <form method="POST" action="#" name="frmForm" enctype="multipart/form-data">
                    <input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />
                    <input type="hidden" name="page" value="<?=$_REQUEST['pageNum']?>" />

                    <table class="table table-bordered table-hover btl-list-bbli bg-white">
                        <thead>
                            <tr>
                                <td style="width: 50px;" class="text-center">ID</td>
                                <td style="width: 150px;" class="text-center">Hình đại diện</td>
                                <td class="text-center">Ngôn ngữ</td>
                                <td style="width: 100px;" class="text-center">Ẩn/Hiện</td>
                                <td style="width: 100px;" class="text-right">Tùy chọn</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sortby="order by id asc";                                
                                $sql="select *,DATE_FORMAT(date_added,'%d/%m/%Y %h:%i') as dateAdd,DATE_FORMAT(last_modified,'%d/%m/%Y %h:%i') as dateModify from tbl_item_category where parent<>0 and $where $sortby limit ".($startRow).",".$pageSize;
                                $result=mysqli_query($conn,$sql);
                                $i=0;
                                while($row=mysqli_fetch_array($result)) :
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?=$row['id']?>
                                </td>
                                <td class="text-center">
                                    <?php if($row['image']==true) : ?>
                                    <a href="javascript:void(0)" title="Click vào xem ảnh">
                                        <img src="<?php echo __PATH_UPLOAD__.$row['image']?>" border="0" class="img-thumbnail" style="max-width: 50px;" />
                                    </a>
                                    <?php else : ?>
                                    <img src="<?php echo __PATH_NOIMAGE__; ?>" border="0" class="img-thumbnail" style="max-width: 50px;" />
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <span class="label label-danger"><?=$row['name']?></span>
                                </td>
                                <td class="text-center">
                                    <div class="check tool <?php echo $row['status']==1?'active':'' ?>" data-action='toggleStatus' data-field='status' data-table='tbl_item_category' title="Ẩn hiện" value="<?=$row['id']?>"></div>
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
                        <tfoot>
                            <tr>
                                <td colspan="8"></td>
                            </tr>
                        </tfoot> 
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>