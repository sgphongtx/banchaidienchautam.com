<? $errMsg =''?>
<?
if (isset($_POST['btnSave'])){
    $name      = isset($_POST['name']) ? trim($_POST['name']) : '';
    $image           = isset($_POST['txtImage']) ? trim($_POST['txtImage']) : '';
    $parent    = $_POST['ddCat'];
    if ($parent =="") $parent=0;
    $detail    = isset($_POST['txtDetail']) ? addslashes($_POST['txtDetail']) : '';
    $status    = 0;
    $loaihinh  = isset($_POST['loaihinh']) ? trim($_POST['loaihinh']) : '';

    if ($name=="") $errMsg .= "Hãy nhập tên bài viết tự soạn thảo !<br>";

    if ($errMsg=='') {

        if (!empty($_POST['id'])){
            $oldid = $_POST['id'];
             $image_ = $image;
            $sql = "UPDATE tbl_item SET idshop = '$idshop', name = '$name', parent = '$parent', type = '$loaihinh', detail = '$detail', image='$image_', lang = '$lang', last_modified = now() WHERE id = '$oldid'";
        }else{
            $image_ = $image;
            $sql = "INSERT INTO tbl_item (idshop, name, parent, detail, image, type, cate, status, lang, date_added, last_modified) VALUES ('$idshop', '$name', '$parent', '$detail', '$image_', '$loaihinh', '3', '1', '$lang', now(), now())";
        }

        if (mysqli_query($conn,$sql, $conn)) ;
        else $errMsg = "Không thể cập nhật !";
    }
    if ($errMsg == '') {
        $url_direct = url_direct('get',$_GET['act'],'_m','&pageNum='.$_REQUEST['page'].'&code=1');
        echo "<script>window.location='$url_direct'</script>";
    }
}else{
    if (isset($_GET['id'])) {

        $oldid=$_GET['id'];
        $page = $_GET['page'];
        $sql = "select * from tbl_item where id='".$oldid."'";
        if ($result = mysqli_query($conn,$sql)) {
            $row=mysqli_fetch_array($result);

            $name          = $row['name'];
            $parent        = $row['parent'];
            $detail        = stripslashes($row['detail']);
            $loaihinh      = $row['type'];
            $status        = $row['status'];

            $image         = $row['image'];
            if ($image == '')
                $image_ = __PATH_NOIMAGE__;
            else
                $image_ = __PATH_UPLOAD__ . $image;
        }
    }
}
if($image_ == ''){
    $image_ = __PATH_NOIMAGE__;
}
?>
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Tự soạn thảo <small>Thêm mới Bài viết</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li><a href="<?=url_direct('get')?>">Danh sách bài viết</a></li>
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
            <form method="post" name="frmForm" enctype="multipart/form-data">
                <input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />
                <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
                <input type="hidden" name="page" value="<?=$_REQUEST['page']?>" />
                
                <div class="row">
                    <div class="col-sm-3">
                        <h4>Nội dung bài viết</h4>
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
                                    <div class="row">
                                        <label class="control-label col-sm-2">
                                            Tên bài viết <font color="red">*</font>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control" value="<?=$name?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="control-label col-sm-2">Loại</label>
                                        <div class="col-sm-6">
                                            <select name="loaihinh" class="form-control" id="loaihinh">                    
                                                <option value="0" <?php if($loaihinh==0) echo 'selected="selected"';?> >  Box </option>
                                                <option value="1" <?php if($loaihinh==1) echo 'selected="selected"';?> >  Module </option>
                                             </select>
                                        </div>
                                    </div>                                      
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Nội dung bài viết</label>
                                    <textarea name="txtDetail" class="form-control tinymce-editor" id="txtDetail"><?=$detail;?></textarea>
                                </div>
                                <div class="form-group">
                                            <div class="row">
                                                <label class="control-label col-sm-2">Hình đại diện</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <div id="img_preview_main" class="wrap-img-product-thumbnail">
                                                            <div class="img-thumbnail img-product-thumbnail pull-left">
                                                                <img class="img-responsive" src="<?php echo $image_; ?>" style="width: 120px; height: 120px;" />
                                                            </div>
                                                            <div class="pull-left">
                                                                <div style="margin: 0 10px 10px;">
                                                                    <a class="btn btn-info iframe-btn" href="../filemanager/dialog.php?type=1&amp;field_id=fieldID&amp;relative_url=1&amp;fldr=product">
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
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
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
