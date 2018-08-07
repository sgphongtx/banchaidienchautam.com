<?php $errMsg =''?>
<?php

if (isset($_POST['btnSave'])){
	$name          = isset($_POST['name']) ? trim($_POST['name']) : '';
    $link          = isset($_POST['link']) ? trim($_POST['link']) : '';
	$loai          = $_POST['loai'];
	$status        = 0;
    $thutu          = isset($_POST['thutu']) ? trim($_POST['thutu']) : '';
    $image        = isset($_POST['txtImage']) ? trim($_POST['txtImage']) : '';
    
	if ($name=="") $errMsg .= "Hãy nhập tên slide<br>";

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
            $image_ = $image;

			$sql = "UPDATE tbl_slider SET idshop='$idshop', name='$name', cate='$loai', link='$link', image='$image_', sort='$thutu', last_modified=now() WHERE id='$oldid'";
		} else {
            $image_ = $image;
			$sql = "INSERT INTO tbl_slider (idshop , name , cate , link, image, sort, status, date_added, last_modified ) VALUES ('$idshop','$name','$loai','$link','$image_','$thutu','1',now(),now())";
		}

		if (mysqli_query($conn,$sql, $conn)) ;
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
		$sql = "select * from tbl_slider where id='".$oldid."'";
		if ($result = mysqli_query($conn,$sql)) {
			$row=mysqli_fetch_array($result);
			$name          = $row['name'];
			$image         = $row['image'];
            if ($image == '')
                $image_ = __PATH_NOIMAGE__;
            else
                $image_ = __PATH_UPLOAD__ . $image;
			$status        = $row['status'];
			$loai          = $row['cate'];
            $thutu         = $row['sort'];
			$link          = $row['link'];
			$date_added    = $row['date_added'];
			$last_modified = $row['last_modified'];
		}
	}
}

if($image_ == '') 
    $image_ = __PATH_NOIMAGE__;
?>
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Slider <small>Thêm mới Slider</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li><a href="<?=url_direct('get')?>">Danh sách Slider</a></li>
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
                        Tên slide <font color="red">*</font>
                    </label>
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" value="<?=$name?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Loại</label>
                    <div class="col-sm-6">
                        <select name="loai" id="cate" class="form-control">
                            <option value="1" <?php if($loai==1) echo 'selected="selected"';?> > Slider</option>
                            <option value="2" <?php if($loai==2) echo 'selected="selected"';?>> Box Slider</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        Link
                    </label>
                    <div class="col-sm-6">
                        <input type="text" name="link" class="form-control" value="<?=$link?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        Thứ tự
                    </label>
                    <div class="col-sm-6">
                        <input type="text" name="thutu" class="form-control" value="<?=$thutu?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Chọn file hình</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div id="img_preview_main" class="wrap-img-product-thumbnail">
                                <div class="text-left">
                                    <div style="display: inline-block; margin: 10px 10px 10px 0px;">
                                        <a class="btn btn-info iframe-btn" href="../filemanager/dialog.php?type=1&amp;field_id=fieldID&amp;relative_url=1&amp;fldr=slider">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                    <div style="display: inline-block; margin: 10px 10px 10px 0px;">
                                        <a class="btn btn-danger" href="javascript:;" onclick="delete_img_product_thumbnail('fieldID')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="img-thumbnail img-product-thumbnai">
                                    <img class="img-responsive" src="<?php echo $image_; ?>" style="max-width: 450px; max-height: 320px;" />
                                </div>
                            </div>
                        
                            <input id="fieldID" type="hidden" name="txtImage" value="<?php echo $image; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 btn-gr">
                        <button type="submit" name="btnSave" class="btn btn-sm btn-primary">Lưu</button>
                        <button onclick="goBack()" type="button" name="goback" class="btn btn-sm btn-danger">Quay lại</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
