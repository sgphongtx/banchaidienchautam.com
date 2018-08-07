<?php $errMsg =''?>
<?php

if (isset($_POST['btnSave'])){
    $name   = isset($_POST['name']) ? trim($_POST['name']) : '';
    $code   = isset($_POST['code']) ? trim($_POST['code']) : '';
    $sort   = isset($_POST['sort']) ? trim($_POST['sort']) : 1;
    $image  = isset($_POST['txtImage']) ? trim($_POST['txtImage']) : '';

    if ($name=="") $errMsg .= "Hãy nhập tên danh mục !<br>";

    $oldid = $_POST['id'];

    if ($errMsg==''){
        if (!empty($_POST['id'])){
            $image_ = $image;
            $sql = "UPDATE tbl_language SET name='$name', code='$code', image='$image_', sort='$sort' WHERE id = '$oldid'";
        }else{
            $image_ = $image;
            $sql = "INSERT INTO tbl_language (name, code, image, sort, status) VALUES ('$name', '$code', '$image_', '$sort', '1')";
        }
        
        if (mysqli_query($conn,$sql)){
            $errMsg = '';
        } else {
            $errMsg = "Không thể cập nhật !";
        }
    }
    
    if ($errMsg == '') {
        $url_direct = url_direct('get',$_GET['act'],'_m','&pageNum='.$_REQUEST['page'].'&code=1');
        echo "<script>window.location='$url_direct'</script>";
    }
} else {
    if (isset($_GET['id'])) {

        $oldid=$_GET['id'];
        $page = $_GET['page'];
        $sql = "SELECT * FROM tbl_language WHERE id='".$oldid."'";
        if ($result = mysqli_query($conn,$sql)) {
            $row           = mysqli_fetch_array($result);
            $name          = $row['name'];
            $code          = $row['code'];
            $image         = $row['image'];
            if ($image == '')
                $image_ = __PATH_NOIMAGE__;
            else
                $image_ = __PATH_UPLOAD__ . $image;
            $status        = $row['status'];
            $sort          = $row['sort'];
        }
    }
}

if($image_ == '') 
    $image_ = __PATH_NOIMAGE__;
?>
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Ngôn ngữ <small>Thêm mới ngôn ngữ</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li><a href="<?=url_direct('get')?>">Ngôn ngữ</a></li>
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

                <div class="col-sm-6">
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            Tên ngôn ngữ <font color="red">*</font>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" value="<?=$name?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            Mã <font color="red">*</font>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="code" class="form-control" value="<?=$code?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Hình đại diện</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div id="img_preview_main" class="wrap-img-product-thumbnail">
                                    <div class="img-thumbnail img-product-thumbnail pull-left">
                                        <img class="img-responsive" src="<?php echo $image_; ?>" style="max-width: 320px; max-height: 320px;" />
                                    </div>
                                    <div class="pull-left">
                                        <div style="margin: 0 10px 10px;">
                                            <a class="btn btn-info iframe-btn" href="../filemanager/dialog.php?type=1&amp;field_id=fieldID&amp;relative_url=1">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </div>
                                        <div style="margin: 0 10px 10px;">
                                            <a class="btn btn-danger" href="javascript:;" onclick="delete_img_product_thumbnail('fieldID')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            
                                <input id="fieldID" type="hidden" name="txtImage" value="<?php echo $image; ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            Thứ tự
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="sort" class="form-control" value="<?=$sort!=''?$sort:'1';?>"/>
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

<script type="text/javascript">
$(function() {

    $('.iframe-btn').fancybox({
        'width'   : 880,
        'height'  : 570,
        'type'    : 'iframe',
        'autoScale'   : false
    });
});

function responsive_filemanager_callback(field_id){

    var url=jQuery('#'+field_id).val();
    jQuery('#'+field_id).closest('.input-group').find('img').attr('src', '<?php echo __PATH_UPLOAD__; ?>' + url);
}

function delete_img_product_thumbnail(field_id){

    jQuery('#'+field_id).val('');
    jQuery('#'+field_id).closest('.input-group').find('img').attr('src', '<?php echo __PATH_NOIMAGE__ ?>');
}
    
</script>