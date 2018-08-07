<?php $errMsg =''?>
<?php

if (isset($_POST['btnSave'])){
	$name          = isset($_POST['name']) ? trim($_POST['name']) : '';
	$detail_short  = isset($_POST['txtDetailShort']) ? trim($_POST['txtDetailShort']) : '';
    $url           = isset($_POST['txtUrl']) ? trim($_POST['txtUrl']) : '';
	$status        = 0;

	if ($name=="") $errMsg .= "Hãy nhập tên tài liệu!<br>";

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];

			$sql = "UPDATE tbl_document SET idshop='$idshop', name='$name', detail_short='$detail_short', url='$url', last_modified=now() WHERE id='$oldid'";
		}else{
			$sql = "INSERT INTO tbl_document (idshop, name, detail_short, url, status, date_added, last_modified) VALUES ('$idshop','$name','$detail_short', '$url','1',now(),now())";
		} 

        echo $sql;

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
		$sql = "select * from tbl_document where id='".$oldid."'";
		if ($result = mysqli_query($conn,$sql)) {
			$row=mysqli_fetch_array($result);

            $name          = $row['name'];
            $detail_short  = $row['detail_short'];
            $url           = $row['url'];
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
            <h1 class="page-heading">Tài liệu <small>Thêm mới Tài liệu</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li><a href="<?=url_direct('get')?>">Danh sách tài liệu</a></li>
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
            <form method="post" name="frmForm" enctype="multipart/form-data" class="form-horizontal">
                <input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />
                <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
                <input type="hidden" name="page" value="<?=$_REQUEST['page']?>" />
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        Tên tài liệu <font color="red">*</font>
                    </label>
                    <div class="col-sm-4">
                        <input type="text" name="name" class="form-control" value="<?=$name?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        Mô tả
                    </label>
                    <div class="col-sm-5">
                        <textarea name="txtDetailShort" class="form-control" id="txtDetailShort"><?=$detail_short;?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Chọn file</label>
                    <div class="col-sm-5">
                        <div class="input-group">
                            <input type="text" name="txtUrl" id="fieldID" class="form-control" value="<?php echo $url; ?>">
                            <span class="input-group-addon" style="background-color: #3c7ac9; border-color: #295995;">
                                <a class="iframe-btn" href="../filemanager/dialog.php?type=2&amp;field_id=fieldID&amp;relative_url=1&amp;fldr=document" style="color: #fff;">
                                    <i class="fa fa-folder-open"></i> Browse...
                                </a>
                            </span>
                            <span class="input-group-addon" style="background-color: #c94d3c; border-color: #953629;">
                                <a onclick="delete_file_document('fieldID')" href="javascript:void(0)" title="Xóa file có sẵn" style="color: #fff;">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-2 btn-gr">
                        <button type="submit" name="btnSave" class="btn btn-default">Chấp nhận</button>
                        <button onclick="goBack()" type="button" name="goback" class="btn btn-default">Quay lại</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
function delete_file_document(field_id){
    jQuery('#'+field_id).val('');
}    
</script>