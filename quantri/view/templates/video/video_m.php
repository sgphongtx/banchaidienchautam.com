<?php $errMsg =''?>
<?php

if (isset($_POST['btnSave'])){
	$name          = isset($_POST['name']) ? trim($_POST['name']) : '';
 	$link          = isset($_POST['link']) ? trim($_POST['link']) : '';
	$status        = 0;

	if ($name=="") $errMsg .= "Hãy nhập tên video<br>";

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];

			$sql = "UPDATE tbl_video SET idshop='$idshop', name='$name', link='$link', last_modified=now() WHERE id='$oldid'";
		}else{
			$sql = "INSERT INTO tbl_video (idshop , name, link, status , date_added, last_modified) VALUES ('$idshop','$name','$link','1',now(),now())";
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
		$sql = "select * from tbl_video where id='".$oldid."'";
		if ($result = mysqli_query($conn,$sql)) {
			$row=mysqli_fetch_array($result);
			
			$name          = $row['name'];
			$status        = $row['status'];
			$link        = $row['link'];
			$date_added    = $row['date_added'];
			$last_modified = $row['last_modified'];
		}
	}
}
?>
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Video <small>Thêm mới Video</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li><a href="<?=url_direct('get')?>">Danh sách Video</a></li>
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
                    <label class="col-sm-3 control-label">
                        Tên video <font color="red">*</font>
                    </label>
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" value="<?=$name?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        Link video (youtube)
                    </label>
                    <div class="col-sm-6">
                        <input type="text" name="link" class="form-control" value="<?=$link?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4 btn-gr">
                        <button type="submit" name="btnSave" class="btn btn-sm btn-primary">Chấp nhận</button>
                        <button onclick="goBack()" type="button" name="goback" class="btn btn-sm btn-danger">Quay lại</button>
                    </div>
                </div>           
            </form>
        </div>
    </div>
</div>