<?php $errMsg =''?>
<?php
if (isset($_POST['btnSave'])) {

	$parent        = $_POST['ddCat'];
	if($parent=="") $parent=$lang;
	$detail        = isset($_POST['txtDetail']) ? addslashes($_POST['txtDetail']) : '';

	if ($detail=="") $errMsg .= "Hãy nhập nội dung !<br>";

	if ($errMsg==''){ 
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "UPDATE tbl_item SET idshop='$idshop',parent='$parent', detail='$detail', last_modified=now(), lang='$lang' WHERE id='$oldid'";
		} else {
			$sql = "INSERT INTO tbl_item (idshop, cate , parent, detail, status , date_added, last_modified, lang) VALUES ('$idshop', '4', '$parent', '$detail', '1' ,now(), now(), '$lang')";
		}
		if (mysqli_query($conn,$sql)) ;
		else $errMsg = "Không thể cập nhật !";
	}
    
	if ($errMsg == '') {
        $url_direct = url_direct('get',$_GET['act'],'_m','&pageNum='.$_REQUEST['page'].'&code=1');
        echo "<script>window.location='$url_direct'</script>";
    }
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_item where id='".$oldid."'";
		if ($result = mysqli_query($conn,$sql)) {
			$row=mysqli_fetch_array($result);
			$parent        = $row['parent'];
			$detail        = stripslashes($row['detail']);
			$status        = $row['status'];
			$date_added    = $row['date_added'];
			$last_modified = $row['last_modified'];
		}
	}
}
?>
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Footer <small>Thêm mới Footer</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li><a href="<?=url_direct('get')?>">Footer</a></li>
                <li>Thêm mới</li>
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
        <div class="block-content">
            <form method="post" name="frmForm" enctype="multipart/form-data" class="">
                <input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />
                <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
                <input type="hidden" name="page" value="<?=$_REQUEST['page']?>" />

                <div class="row">
                    <div class="col-sm-3">
                        <h4>Nội dung footer</h4>
                        <p class="text-muted"></p>
                    </div>
                    <div class="col-sm-9">
                    	<div class="panel panel-default panel-light">
                    		<div class="panel-body">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="control-label col-sm-2">Ngôn ngữ</label>
                                        <div class="col-sm-6">
                                            <select name="ddCat" id="ddCat" class="form-control" disabled>
                                                <option value="0"><?=get_field("tbl_language","id",$lang,"name")?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                    			<div class="form-group">
                    				<label class="control-label">Nội dung</label>
                    				<textarea name="txtDetail" class="form-control tinymce-editor" id="txtDetail"><?=$detail;?></textarea>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                	<div class="col-sm-3"></div>
                	<div class="col-sm-9">                		
                		<div class="form-group">
                			<div class="btn-gr">
		                        <button type="submit" name="btnSave" class="btn btn-sm btn-primary">Lưu</button>
		                        <button onclick="goBack()" type="button" name="goback" class="btn btn-sm btn-danger">Quay lại</button>
		                    </div>
                		</div>
                	</div>
                </div>          
            </form>
        </div>
    </div>
</div>
