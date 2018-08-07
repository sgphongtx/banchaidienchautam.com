<?php

if (isset($_POST['tim'])==true)//isset kiem tra submit
{ 
	if($_POST['tukhoa']!=NULL){$tukhoa=$_POST['tukhoa'];}else {$tukhoa=-1;}
	$_SESSION['kt_tukhoa_item']=$tukhoa;
	$tukhoa = trim(strip_tags($tukhoa));
	if (get_magic_quotes_gpc()==false) 
		{
			$tukhoa = mysqli_real_escape_string($tukhoa);
		}
}
if (isset($_POST['reset'])==true) {

	$_SESSION['kt_tukhoa_item']=-1;
}
if($_SESSION['kt_tukhoa_item']==NULL){$tukhoa=-1;}
if($_SESSION['kt_tukhoa_item']!=NULL){$tukhoa=$_SESSION['kt_tukhoa_item'];}
?>
<script>
$(document).ready(function() {	
		//dao trang thai an hien
	$("img.anhien").click(function(){
	id=$(this).attr("value");
	obj = this;
		$.ajax({
		   url:'status.php',
		   data: 'id='+ id +'&table=tbl_hoi_dap',
		   cache: false,
		   success: function(data){ //alert(idvnexpres);
			obj.src=data;
			if (data=="images/anhien_1.png") obj.title="Nhắp vào để ẩn";
			else obj.title="Nhắp vào để hiện";
		  }
		});
	});
	
	$("img.hot").click(function(){
	id=$(this).attr("value");
	obj = this;
		$.ajax({
		   url:'hot.php',
		   data: 'id='+ id +'&table=tbl_hoi_dap',
		   cache: false,
		   success: function(data){ //alert(idvnexpres);
			obj.src=data;
			if (data=="images/noibat_1.png") obj.title="Nhắp vào để ẩn";
			else obj.title="Nhắp vào để hiện";
		  }
		});
	});
	
	$("#chkall").click(function(){
		var status=this.checked;
		$("input[class='tai_c']").each(function(){this.checked=status;})
	});
	
});
</script>
<div class="main_cont_body">
    
    <h1 class="title_menu_admin">Danh sách câu hỏi</h1><!-- End .title_menu_admin -->
    
    <div class="frame_cont_body">    
    
        <div class="filter_num">
            <form method="POST" action="#" name="frmForm" enctype="multipart/form-data">
            <input type="hidden" name="page" value="<?=$page?>">
            <input type="hidden" name="act" value="question">
            </form> 
        </div><!-- End .filter_s -->
        <div class="block-header bg-gray-lighter">
            <span class="block-title">Danh sách</span>
            <button type="button" onclick="location.href='<?=url_direct('add')?>'" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus-circle"></i> Tạo mới</button>
        </div>
        
        <div class="data_gid">
        <? $errMsg =''?>
		<?
        
        switch ($_GET['action']){
            case 'del' :
                $id = $_GET['id'];
                $r = getRecord("tbl_hoi_dap","id=".$id);
				
					@$result = mysqli_query($conn,"delete from tbl_hoi_dap where id='".$id."'");
					if ($result){
						$errMsg = "Đã xóa thành công.";
					}else $errMsg = "Không thể xóa dữ liệu !";
				
                break;
        }
        
        if (isset($_POST['btnDel'])){
            $cntDel=0;
            $cntNotDel=0;
            $cntParentExist=0;
            if($_POST['chk']!=''){
                foreach ($_POST['chk'] as $id){
                    $r = getRecord("tbl_hoi_dap","id=".$id);
					if($r['idshop']==$idshop){
						@$result = mysqli_query($conn,"delete from tbl_hoi_dap where id='".$id."'");
						if ($result){
							delete_image("tbl_ad",$id,"../");
							if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
							if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
							$cntDel++;
						}else $cntNotDel++;
					}
                }
                $errMsg = "Đã xóa ".$cntDel." phần tử.<br><br>";
                $errMsg .= $cntNotDel>0 ? "Không thể xóa ".$cntNotDel." phần tử.<br>" : '';
                $errMsg .= $cntParentExist>0 ? "Đang có danh mục con sử dụng ".$cntParentExist." phần tử." : '';
            }else{
                $errMsg = "Hãy chọn trước khi xóa !";
            }
        }
        
        $pageSize = 5;
        $pageNum = 1;
        $totalRows = 0;
        
        if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
        if ($pageNum<=0) $pageNum=1;
        $startRow = ($pageNum-1) * $pageSize;
    
        $where="1=1 and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1)";
        
        $MAXPAGE=1;
        $totalRows=countRecord("tbl_hoi_dap",$where);
        
        if ($_REQUEST['cat']!='') $where="parent=".$_REQUEST['cat']; ?>
        <form method="POST" action="#" name="frmForm" enctype="multipart/form-data">
        <input type="hidden" name="page" value="<?=$page?>">
        <input type="hidden" name="act" value="question">
        <? if ($_REQUEST['code']==1) $errMsg = 'Cập nhật thành công.';echo $errMsg;?>
            <table width="100%" border="1">
                <thead>
                    <tr>
                        <td style="width: 70px;" class="text-center">ID</td>
                        <td style="width: 170px;" class="text-center">Danh mục</td>
                        <td class="text-center">Câu hỏi</td>
                        <td style="width: 70px;" class="text-center">Ẩn/Hiện</td>
                        <td style="width: 90px;" class="text-center">Tùy chọn</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td class="text-center">&nbsp;</td>
                        <td class="text-center">&nbsp;</td>
                        <td class="text-center">&nbsp;</td>
                        <td class="text-center">&nbsp;</td>
                        <td class="text-center">&nbsp;</td>
                    </tr>
                </tfoot>
                <tbody>
				<?
                $sortby="order by date_added";
                if ($_REQUEST['sortby']!='') $sortby="order by ".(int)$_REQUEST['sortby'];
                $direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"");
                
                //$sql="select *,DATE_FORMAT(date_added,'%d/%m/%Y %h:%i') as dateAdd,DATE_FORMAT(last_modified,'%d/%m/%Y %h:%i') as dateModify from tbl_hoi_dap where $where $sortby $direction limit ".($startRow).",".$pageSize;
                $sql = "select * from tbl_hoi_dap order by id desc";
                $result=mysqli_query($conn,$sql);
                $i=0;
                while($row=mysqli_fetch_array($result)){
                $parent = getRecord('tbl_hoi_dap','id = '.$row['parent']);
                $color = $i++%2 ? "#d5d5d5" : "#e5e5e5";
                ?>
                    <tr>
                        <td class="text-center"><?=$row['id']?></td>
                        <td><?=get_one_field("tbl_item_category","id=".$row['parent'],"","name")?></td>
                        <td class="text-center"><?=$row['cauhoi']?></td>
                        <td class="text-center">
                            <div class="check tool <?php echo $row['status']==1?'active':'' ?>" data-action='toggleStatus' data-field='status' data-table='tbl_item' title="Ẩn hiện" value="<?=$row['id']?>"></div>
                        </td>
                        <td class="text-center">
                            <a href="<?=url_direct('edit',$_GET['act'],'_m','&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['pageNum'].'&id='.$row['id'])?>" title="Sửa" class="btn btn-xs btn-pencil btn-primary">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="<?=url_direct('del',$_GET['act'],null,'&action=del&page='.$_REQUEST['pageNum'].'&id='.$row['id'])?>" title="Xóa"  onclick="return confirm('Bạn có muốn xoá luôn không ?');"  class="btn btn-xs btn-remove btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                   <?php }?>
                   
                    
                </tbody>
            </table>
            
            <!-- <input type="submit" value="Xóa chọn" name="btnDel" onClick="return confirm('Bạn có chắc chắn muốn xóa ?');" class="button"> -->
				</form>
                
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
            
            
            
        </div><!-- End .data_gid -->
        
        <nav class="text-center">
            <ul class="pagination">
                <?php echo pagesLinks_digit($totalRows,$pageSize);?>
            </ul>
        </nav><!-- End pagination -->
    
    </div><!-- End .frame_cont_body -->
    
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