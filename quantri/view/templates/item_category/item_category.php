<?php
if (isset($_POST['tim'])==true) {
    //isset kiem tra submit 
    if($_POST['tukhoa']!=NULL) { $tukhoa=$_POST['tukhoa']; } else { $tukhoa=-1; }
    $tukhoa = trim(strip_tags($tukhoa));
}

if (isset($_POST['reset'])==true) {
    header("Location:".url_direct('get'));
}
?>
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
                            $errMsg1 = "Đã xóa thành công.";
                        }
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
                $r = getRecord("tbl_item_category","id=".$id);
                if($r['idshop']==$idshop && $r['del']==1){
                    if (isHaveChild("tbl_item_category", $id)==false){
                        @$result = mysqli_query($conn,"delete from tbl_item_category where id='".$id."'");
                        if ($result){
                            if($r['belong']==1) {
                                $errMsg1 = "Đã xóa thành công.";
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
            <h1 class="page-heading">Sản phẩm <small>Danh mục sản phẩm</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li>Danh mục sản phẩm</li>
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
                            <div class="col-md-3">
                                <?php 
                                    $result_menu = get_records('tbl_item_category','cate=1 and status = 1','sort asc,id asc',' ',$lang);
                                    $data_menu = array(); 
                                    while ($row = mysqli_fetch_assoc($result_menu)) { 
                                        $data_menu[] = $row;
                                    } 
                                ?>
                                <script language="javascript">
                                    var menus = new Array(); 
                                    <?php foreach($data_menu as $item) { ?>
                                        menus.push({
                                            menu_id: '<?php echo $item['id']; ?>',
                                            menu_name: '<?php echo $item['name']; ?>',
                                            menu_parent_id: '<?php echo $item['parent']; ?>',
                                        }); 
                                    <?php } ?>
                                </script>
                                <select name="ddCat" class="form-control iteCategory" id="menu_parent_id_<?php echo $oldid ?>">
                                    <?php show_menu_select($data_menu, 0); ?>
                                </select>
                                <script language="javascript">
                                    $(function() {
                                        var id = '<?php echo $oldid; ?>';
                                        var id_parent = '<?php echo $parent; ?>';

                                        get_parent(menus, 0, id, id_parent, '|--');
                                        $('#menu_parent_id_' + id).html(html);
                                    });
                                </script>
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-6">
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
                $pageSize = 20;
                $pageNum = 1;
                $totalRows = 0;
                if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
                if ($pageNum<=0) $pageNum=1;
                $startRow = ($pageNum-1) * $pageSize;

                $where = "1=1 and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1) and cate=1 and (idshop='{$idshop}') and lang='{$lang}'";
                if ($_REQUEST['cat']!='') :
                    $list_parent = get_list_parent("tbl_item_category",$_REQUEST['cat'],$lang);
                    $where = "parent in ($list_parent) and cate=1 and (idshop='{$idshop}') and lang='{$lang}'";
                endif;

                $totalRows=countRecord("tbl_item_category",$where);
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
                                    <a href="<?=url_direct('get',$_GET['act'])?>&cat=<?=$_REQUEST['cat']?>&pageNum=<?=$_REQUEST['page']?>&sortby=id&direction=<?=$_REQUEST['direction']==1?0:1?>">ID</a>
                                </td>
                                <td style="width: 150px;" class="text-center">Hình đại diện</td>
                                <td class="text-left">
                                    <a href="<?=url_direct('get',$_GET['act'])?>&cat=<?=$_REQUEST['cat']?>&pageNum=<?=$_REQUEST['page']?>&sortby=name&direction=<?=$_REQUEST['direction']==1?0:1?>">Tên danh mục</a>
                                </td>
                                <td style="width: 100px;" class="text-center">Nổi bật</td>
                                <td style="width: 100px;" class="text-center">Ẩn/Hiện</td>
                                <td style="width: 100px;" class="text-right">Tùy chọn</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sortby="order by date_added";
                                if ($_REQUEST['sortby']!='') $sortby="order by ".$_REQUEST['sortby'];
                                $direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"asc");
                                $sql="select * from tbl_item_category where $where $sortby $direction limit ".($startRow).",".$pageSize;
                                $result=mysqli_query($conn,$sql);
                                while ($row=mysqli_fetch_array($result)) :
                                    $parent = getRecord('tbl_item_category','id='.$row['parent']);
                                    $arr_temp = get_list_parent1('tbl_item_category',$row['parent']);
                                    $arr=explode(",",$arr_temp);
                            ?>
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="chk[]" class="tai_c" value="<?php echo $row['id']?>" />
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row['id']?>
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
                                    <td class="text-left">
                                        <?php
                                        if(count($arr) > 0) :
                                            for($i=0;$i < count($arr); $i++) :
                                                $pro = getRecord('tbl_item_category',"status = 1 and lang=$lang and id=".$arr[$i]);
                                                if(trim($pro['name'] != '')) :
                                                    echo "<span class='text-info'>".$pro['name']."&nbsp;&nbsp;&gt;&nbsp;&nbsp;</span>";
                                                endif;
                                            endfor;
                                        endif;
                                        ?>
                                        <?php echo "<span class='text-danger'>".$row['name']."</span>"?>
                                    </td>                                
                                    <td class="text-center">
                                        <div class="star tool <?php echo $row['hot']==1?'active':'' ?>" data-action='toggleStatus' data-field='hot' data-table='tbl_item_category' title="Nổi bật" value="<?php echo $row['id']?>"></div>
                                    </td>
                                    <td class="text-center">
                                        <div class="check tool <?php echo $row['status']==1?'active':'' ?>" data-action='toggleStatus' data-field='status' data-table='tbl_item_category' title="Ẩn hiện" value="<?php echo $row['id']?>"></div>
                                    </td>
                                    <td class="text-right">
                                        <a href="<?=url_direct('edit',$_GET['act'],'_m','&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['pageNum'].'&id='.$row['id'])?>" class="btn btn-xs btn-pencil btn-primary" title="Sửa">
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

<script type="text/javascript">
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