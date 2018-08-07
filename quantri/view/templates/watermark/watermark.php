<?php
$errMsg = '';

if (isset($_POST['btnSave'])) {

    $image_watermark = isset($_POST['image_watermark']) ? $_POST['image_watermark'] : '';
    $position = isset($_POST['position']) ? $_POST['position'] : '';
    $position_custom = isset($_POST['position_custom']) ? $_POST['position_custom'] : '';
    $padding = isset($_POST['padding']) ? intval($_POST['padding']) : 0;
    $opacity = isset($_POST['opacity']) ? intval($_POST['opacity']) : 1;

    $data_array = array(
        'image_watermark' => $image_watermark,
        'wtm_position' => $position,
        'wtm_position_ct' => $position_custom,
        'wtm_padding' => $padding,
        'wtm_opacity' => $opacity
    );

    if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tbl_ad WHERE cate='11'")) > 0) {
        $image_watermark_src = $image_watermark;
        $sql = "UPDATE tbl_ad SET 
        image='$image_watermark_src', 
        wtm_position='$position', 
        wtm_position_ct='$position_custom', 
        wtm_padding='$padding', 
        wtm_opacity='$opacity' 
        WHERE idshop='$idshop' AND cate='11'";
    } else {
        $image_watermark_src = $image_watermark;
        $sql = "INSERT INTO tbl_ad 
        (idshop, cate, image, wtm_position, wtm_position_ct, wtm_padding, wtm_opacity, status, date_added, last_modified, lang) VALUES 
        ('$idshop', '11', '$image_watermark_src', '$position', '$position_custom', '$padding', '$opacity', '1', now(), now(), '$lang')";
    }

    if (mysqli_query($conn,$sql, $conn)) {
        $errMsg = "Cập nhật thành công";
    }
    else $errMsg = "Không thể cập nhật !";

    if ($image_watermark=='') unset($_SESSION['RF']['watermark']);
    else $_SESSION['RF']['watermark'] = $data_array;

    if ($errMsg == '') {
        $url_direct = url_direct('get');
        echo "<script>window.location='$url_direct'</script>";
    }

} else {

    $sql = "SELECT * FROM tbl_ad WHERE cate='11'";
    if ($result = mysqli_query($conn,$sql)) {
        $row=mysqli_fetch_array($result);

        $image_watermark = $row['image'];
        if ($image_watermark == '')
            $image_watermark_src = __PATH_NOIMAGE__;
        else
            $image_watermark_src = __PATH_UPLOAD__ . $image_watermark;
        $position        = $row['wtm_position'];
        $position_custom = $row['wtm_position_ct'];
        $padding         = $row['wtm_padding'];
        $opacity         = $row['wtm_opacity'];

    }

}

if ($image_watermark_src == '') {
    $image_watermark_src = __PATH_NOIMAGE__;
}

if (!$padding) $padding = 0;
if (!$opacity) $opacity = 1;

?>
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Watermark</h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li>Watermark</li>
            </ol>
        </div>
    </div>
</div>
<div class="content" style="min-height: 530px;">
    <div class="bs-example bs-example-bg-classes">
        <?php if($errMsg != '') { ?>
        <p class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $errMsg; ?>            
        </p>
        <?php } ?>
    </div>
    <div class="block">
        <div class="block-content">            
            <div class="row">
                <div class="col-sm-3">
                    <h4>Đóng dấu hình bản quyền</h4>
                    <p class="text-muted">
                        <span>Các hình ảnh sản phẩm, tin tức khi được upload sẽ được tự động chèn hình watermark vào</span>
                    </p>
                </div>
                <div class="col-sm-9">
                    <form method="post" name="frmForm" enctype="multipart/form-data" class="">
                        <div class="form-group">
                            <label class="control-label">Hình watermark</label>
                            <div class="input-group">
                                <div id="img_preview_main" class="wrap-img-product-thumbnail">
                                    <div class="img-thumbnail img-product-thumbnail pull-left">
                                        <img class="img-responsive" style="max-width: 120px" src="<?php echo $image_watermark_src; ?>" />
                                    </div>
                                    <div class="pull-left">
                                        <div style="margin: 0 10px 10px">
                                            <a class="btn btn-info iframe-btn" href="../filemanager/dialog.php?type=1&amp;field_id=fieldID&amp;relative_url=1&amp;fldr=watermark">Đổi</a>
                                        </div>
                                        <div style="margin: 0 10px 10px">
                                            <a class="btn btn-danger" href="javascript:;" onclick="delete_img_product_thumbnail('fieldID')">Xóa</a>
                                        </div>
                                    </div>
                                </div>
                                <input id="fieldID" type="hidden" name="image_watermark" value="<?php echo  $image_watermark ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Vị trí (Chiều cao, chiều rộng)</label>
                            <select class="form-control" id="position" name="position" onchange="change_position(this)">
                                <option value="tl" <?php echo $position == 'tl' ? 'selected' : '' ?>>Ở trên, bên trái</option>
                                <option value="t" <?php echo $position == 't' ? 'selected' : '' ?>>Ở trên, giữa</option>
                                <option value="tr" <?php echo $position == 'tr' ? 'selected' : '' ?>>Ở trên, bên phải</option>
                                <option value="l" <?php echo $position == 'l' ? 'selected' : '' ?>>Ở giữa, bên trái</option>
                                <option value="m" <?php echo $position == 'm' ? 'selected' : '' ?>>Ở giữa, giữa</option>
                                <option value="r" <?php echo $position == 'r' ? 'selected' : '' ?>>Ở giữa, bên phải</option>
                                <option value="bl" <?php echo $position == 'bl' ? 'selected' : '' ?>>Ở dưới, bên trái</option>
                                <option value="b" <?php echo $position == 'b' ? 'selected' : '' ?>>Ở dưới, giữa</option>
                                <option value="br" <?php echo $position == 'br' ? 'selected' : '' ?>>Ở dưới, bên phải</option>
                                <option value="custom" <?php echo $position == 'custom' ? 'selected' : '' ?>>Tùy chỉnh</option>
                            </select>
                        </div>
                        <div class="form-group wrap-position-custom" style="display: none;">
                            <label class="control-label">Vị trí tùy chỉnh (VD: 50x100)</label>
                            <input type="text" name="position_custom" class="form-control" value="<?php echo $position_custom ?>"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Padding</label>
                            <input type="number" name="padding" class="form-control" value="<?php echo $padding ?>"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Opacity</label>
                            <input type="number" name="opacity" class="form-control" value="<?php echo $opacity ?>"/>
                        </div>                 
                        <div class="form-group">
                            <div class="btn-gr">
                                <button type="submit" name="btnSave" class="btn btn-sm btn-primary" onclick="App.loader('show');setTimeout(function(){App.loader('hide');},3000);">Lưu</button>
                                <button onclick="goBack()" type="button" name="goback" class="btn btn-sm btn-danger">Quay lại</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
App.loader('show');

$('#position').change();

function change_position(element){
    if($(element).val() == 'custom'){
        $('.wrap-position-custom').fadeIn();
    }else{
        $('.wrap-position-custom').hide();
    }
}
</script>