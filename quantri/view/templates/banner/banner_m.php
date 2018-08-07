<?php $errMsg =''?>
<?php

if (isset($_POST['btnSave'])){

    $cate        = $_POST['cate'];
    $bg_position = isset($_POST['bg_position']) ? trim($_POST['bg_position']) : '';
    $sort        = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
    $status      = 0;
    $image       = isset($_POST['txtImage']) ? trim($_POST['txtImage']) : '';

    if ($errMsg==''){
        if (!empty($_POST['id'])){
            $oldid = $_POST['id'];
            $image_ = $image;
            $sql = "UPDATE tbl_ad SET idshop='$idshop', cate='$cate', bg_position='$bg_position', sort='$sort', image='$image_', lang='$lang', last_modified=now() WHERE id='$oldid'";
        } else {
            $image_ = $image;
            $sql = "INSERT INTO tbl_ad ( idshop , cate, bg_position, sort , image, status, lang, date_added, last_modified ) VALUES ('$idshop', '$cate', '$bg_position', '$sort', '$image_', '1', '$lang', now(), now())"; 
        }

        if (mysqli_query($conn,$sql, $conn)) ;
        else $errMsg = "Không thể cập nhật !";
    }
 
	if ($errMsg == '') {
        $url_direct = url_direct('get',$_GET['act'],'_m','&pageNum='.$_REQUEST['page'].'&code=1');
        echo "<script>window.location='$url_direct'</script>";
    }
} else {
    if (isset($_GET['id'])){
        $oldid=$_GET['id'];
        $page = $_GET['page'];
        $sql = "select * from tbl_ad where id='".$oldid."'";
        if ($result = mysqli_query($conn,$sql)) {
            $row=mysqli_fetch_array($result);

            $cate          = $row['cate'];
            $bg_position   = $row['bg_position'];
            $sort          = $row['sort'];
            $image         = $row['image'];
            if ($image == '')
                $image_ = __PATH_NOIMAGE__;
            else
                $image_ = __PATH_UPLOAD__ . $image;
            $status        = $row['status'];
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
            <h1 class="page-heading">Hình ảnh <small>Thêm mới Logo - Banner - Background - Favicon</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li><a href="<?=url_direct('get')?>">Banner - Background</a></li>
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
                <div class="col-sm-6">
                    <input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />
                    <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
                    <input type="hidden" name="page" value="<?=$_REQUEST['page']?>" />
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Loại</label>
                        <div class="col-sm-6">
                            <select name="cate" id="cate" class="form-control">
                                <option value="4" <?php if($cate==4) echo 'selected="selected"'?>> Banner </option> 
                                <option value="5" <?php if($cate==5) echo 'selected="selected"'?>> Background </option>
                            </select>
                        </div>
                    </div>
                    <script type="text/javascript">
                    $(document).ready(function() {
                        $('#cate').change(function() {
                            var val = $(this).find('option:selected').attr('value');
                            if (val == 5) $('.bg_position').show();
                            else $('.bg_position').hide();
                        }).change();
                    });
                    </script>
                    <div class="form-group bg_position">
                        <label class="col-sm-3 control-label">Vị trí background</label>
                        <div class="col-sm-6">
                            <select name="bg_position" id="bg_position" class="form-control">
                                <option value="0" <?php if($bg_position==0) echo 'selected="selected"'; ?>>Lặp ngang</option>
                                <option value="1" <?php if($bg_position==1) echo 'selected="selected"'; ?>>Lặp dọc</option>
                                <option value="2" <?php if($bg_position==2) echo 'selected="selected"'; ?>>Lặp ngang và lặp dọc</option>
                                <option value="3" <?php if($bg_position==3) echo 'selected="selected"'; ?>>Cố định</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Hình ảnh</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div id="img_preview_main" class="wrap-img-product-thumbnail">
                                    <div class="text-left">
                                        <div style="display: inline-block; margin: 10px 10px 10px 0px;">
                                            <a class="btn btn-info iframe-btn" href="../filemanager/dialog.php?type=1&amp;field_id=fieldID&amp;relative_url=1&amp;fldr=Banner">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </div>
                                        <div style="display: inline-block; margin: 10px 10px 10px 0px;">
                                            <a class="btn btn-danger" href="javascript:;" onclick="delete_img_product_thumbnail('fieldID')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="img-thumbnail img-product-thumbnail">
                                        <img class="img-responsive" src="<?php echo $image_; ?>" />
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
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>  
</div>
