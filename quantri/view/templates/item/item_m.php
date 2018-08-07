<script src="/public/templates/quantri/js/jquery-ui.min.js" type="text/javascript"></script>
<?php $errMsg = ''; ?>
<?php

if (isset($_POST['btnSave'])) {

    $name          = isset($_POST['name']) ? trim($_POST['name']) : '';
    $parent        = $_POST['ddCat'];
    $manufacturer    = isset($_POST['manufacturer']) ? trim($_POST['manufacturer']) : '';
    
    if($parent=="") $parent=$lang;
    
    $subject         = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $subject_temp    = isset($_POST['subject_tmp']) ? trim($_POST['subject_tmp']) : '';
    $detail_short    = isset($_POST['txtDetailShort']) ? addslashes($_POST['txtDetailShort']) : '';
    $detail          = isset($_POST['txtDetail']) ? addslashes($_POST['txtDetail']) : '';
    $price           = isset($_POST['price']) ? trim($_POST['price']) : '';
    $price           = str_replace(',', '', $price);
    $pricekm         = isset($_POST['price2']) ? trim($_POST['price2']) : '';
    $pricekm         = str_replace(',', '', $pricekm);
    $image           = isset($_POST['txtImage']) ? trim($_POST['txtImage']) : '';
    $sort_all_images = isset($_POST['all_image_child']) ? trim($_POST['all_image_child']) : '';
    $sort            = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
    $status          = 0;
    $title           = isset($_POST['title']) ? trim($_POST['title']) : '';
    $description     = isset($_POST['description']) ? trim($_POST['description']) : '';
    $keyword         = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';

    if ($name=="") $errMsg .= "Hãy nhập tên danh mục !<br>";

    if($subject == ''){
        $errMsg .= "Hãy nhập đường dẫn/Alias !<br>";
    }else{
        if (!empty($_POST['id'])){
            //Chinh sua
            $where_tmp = " AND id<>". $_POST['id'] ." ";
        }
        $lst_item = get_records('tbl_item', "idshop=$idshop $where_tmp AND cate=1 AND subject='". $subject ."'", " ", " ", " ");
        if(mysqli_num_rows($lst_item)){
            $errMsg .= "Đường dẫn/Alias này đã tồn tại !<br>";
        }
    }

    if ($errMsg=='') {
        if (!empty($_POST['id'])) {
            $oldid = $_POST['id'];
            $image_ = $image;
            $sql = "UPDATE tbl_item SET idshop = '$idshop', name = '$name', parent = '$parent', manufacturer='$manufacturer', subject = '$subject', subject_temp = '$subject_temp', detail_short = '$detail_short', detail = '$detail', price='$price', pricekm='$pricekm', image='$image_', sort_all_images='$sort_all_images', sort = '$sort', title = '$title', description = '$description', keyword = '$keyword', lang = '$lang', last_modified = now() WHERE id = '$oldid'";
        } else {
            $image_ = $image;
            $sql = "INSERT INTO tbl_item (idshop, cate, name, parent, manufacturer, subject, subject_temp, detail_short, detail, price, pricekm, image, sort_all_images, sort, title, description, keyword, status, date_added, last_modified, lang) VALUES ('$idshop', '1', '$name', '$parent', '$manufacturer', '$subject', '$subject_temp', '$detail_short', '$detail', '$price', '$pricekm', '$image_', '$sort_all_images', '$sort', '$title', '$description', '$keyword', '1', now(), now(), '$lang')"; }

        if (mysqli_query($conn,$sql, $conn)) ;
        else $errMsg = "Không thể cập nhật !";
    }

    if ($errMsg == '') {
        $url_direct = url_direct('get',$_GET['act'],'_m','&cat='.$_REQUEST['cat'].'&pageNum='.$_REQUEST['page'].'&code=1');
        echo "<script>window.location='$url_direct'</script>";
    }
} else {
    if (isset($_GET['id'])) {

        $oldid=$_GET['id'];
        $page = $_GET['page'];

        $sql = "select * from tbl_item where id='".$oldid."'";
        if ($result = mysqli_query($conn,$sql)) {

            $row=mysqli_fetch_array($result);

            $name          = $row['name'];
            $parent        = $row['parent'];
            $manufacturer  = $row['manufacturer'];
            $subject       = $row['subject'];
            $subject_temp  = $row['subject_temp'];
            $detail_short  = stripslashes($row['detail_short']);
            $detail        = stripslashes($row['detail']);

            $image         = $row['image'];
            if ($image == '')
                $image_ = __PATH_NOIMAGE__;
            else
                $image_ = __PATH_UPLOAD__ . $image;

            $sort_all_images = $row['sort_all_images'];
            if($sort_all_images == ''){
                $lst_tmp = json_decode($sort_all_images, true);
                $sort_all_images_array = array();
                foreach ($lst_tmp as $ite_tmp) {
                    if($ite_tmp[0] == 'IMG_CHILD_MAIN' || substr($ite_tmp[0], 0, 10) != 'IMG_CHILD_'){
                        $array_tmp = array($ite_tmp[0], $ite_tmp[1]);
                        array_push($sort_all_images_array, $array_tmp);
                    }
                }
                $sort_all_images = json_encode($sort_all_images_array);
            }
            
            $price           = $row['price'];
            $pricekm         = $row['pricekm'];
            $sort            = $row['sort'];
            $status          = $row['status'];            
            
            $title           = $row['title'];
            $description     = $row['description'];
            $keyword         = $row['keyword'];
            
            $date_added      = $row['date_added'];
            $last_modified   = $row['last_modified'];
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
            <h1 class="page-heading">Sản phẩm <small>Thêm mới Sản phẩm</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li><a href="<?=url_direct('get')?>">Danh sách sản phẩm</a></li>
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
    <div class="">
        <form method="post" name="frmForm" enctype="multipart/form-data">
            <input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />
            <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
            <input type="hidden" name="page" value="<?=$_REQUEST['page']?>" />

            <div class="block">
                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
                    <li class="active">
                        <a href="#btabs-animated-fade-general">Tổng quan</a>
                    </li>
                    <li>
                        <a href="#btabs-animated-fade-data">Chi tiết</a>
                    </li>
                    <li>
                        <a href="#btabs-animated-fade-images">Hình ảnh</a>
                    </li>
                </ul>
                
                <div class="tab-content block-content">
                    <div class="tab-pane fade in active" id="btabs-animated-fade-general">
                        <div class="row">
                            <div class="col-sm-3">
                                <h4>Thông tin sản phẩm</h4>
                                <p class="text-muted">Cung cấp thông tin về tên, mô tả sản phẩm</p>
                            </div>
                            <div class="col-sm-9">
                                <div class="panel panel-default panel-light">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="control-label">Tên sản phẩm <font color="red">*</font></label>
                                            <input type="text" name="name" class="form-control" value="<?=$name?>"/>
                                        </div>
                                        <div class="form-group">
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
                                            <select name="ddCat" class="form-control iteCategory" id="menu_parent_id_<?php echo $parent ?>">
                                                <?php show_menu_select($data_menu, 0); ?>
                                            </select>
                                            <script language="javascript">
                                                $(function() {
                                                    var id = '<?php echo $oldid; ?>';
                                                    var id_parent = '<?php echo $parent; ?>';

                                                    get_parent_m(menus, 0, id, id_parent, '|--');
                                                    $('#menu_parent_id_' + id_parent).html(html);
                                                });
                                            </script>
                                        </div>
                                         <div class="form-group hidden">
                                            <label class="control-label">Thương hiệu</label>
                                            <select class="form-control" name="manufacturer">
                                                <option value="0">---- Chọn thương hiệu -----</option>
                                                <?php
                                                    $rs_manufacturer = get_records("Manufacturer", "status=1", "name asc", " ", " ");
                                                    while($row_manufacturer = mysqli_fetch_assoc($rs_manufacturer)) :
                                                ?>
                                                <option value="<?php echo $row_manufacturer['id'] ?>" <?php echo $manufacturer == $row_manufacturer['id'] ? 'selected' : '' ?>><?php echo $row_manufacturer['name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Mô tả</label>
                                            <textarea name="txtDetailShort" class="form-control tinymce-editor" id="txtDetailShort" style="height:350px;"><?=$detail_short;?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- panel -->
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <div class="col-sm-3">
                                <h4>Tối ưu SEO</h4>
                                <p class="text-muted">
                                    Thiết lập thẻ tiêu đề, thẻ mô tả, đường dẫn. Những thông tin này xác định cách bài viết xuất hiện trên công cụ tìm kiếm.
                                </p>
                            </div>
                            <div class="col-sm-9">
                                <div class="panel panel-default panel-light">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div>
                                                <label class="control-label">Tiêu đề trang (tối đa 70 ký tự)</label>
                                                <span class="pull-right">Số ký tự đã dùng <b class="elcount">0</b>/70</span>
                                            </div>
                                            <input type="text" name="title" class="form-control countW" id="seo_title" value="<?=$title?>" maxlength="70" />
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <label class="control-label">Thẻ mô tả (tối đa 160 ký tự)</label>
                                                <span class="pull-right">Số ký tự đã dùng <b class="elcount">0</b>/160</span>
                                            </div>
                                            <textarea name="description" class="form-control countW" id="seo_description" maxlength="160"><?=$description?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <label class="control-label">Từ khóa</label>
                                            </div>
                                            <input type="text" name="keyword" class="form-control" id="seo_keyword" value="<?=$keyword?>"/>
                
                                            <div class="alert alert-info" role="alert" style="margin-top: 5px;">
                                                <b>Sử dụng từ khóa mục tiêu</b>
                                                <div>Từ khóa mục tiêu được tìm thấy trong:</div>
                                                <ul class="" style="list-style-type: square;">
                                                    <li class="page_title">Tiêu đề trang: <b style="color: red;">Không</b></li>
                                                    <li class="meta_description">Meta Description: <b style="color: red;">Không</b></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="label-control">
                                                Đường dẫn / Alias <font color="red">*</font> (<a href="javascript:void(0);" data-action="default-alias">Mặc định</a>)
                                            </label>                                    
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon3"><?php echo $linkroot; ?>/</span>
                                                <input type="text" name="subject" class="form-control" value="<?=$subject?>"/>
                                                <input type="hidden" name="subject_tmp" class="form-control" value="<?=$subject_temp?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <div class="panel panel-default panel-light">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="control-label">Thứ tự</label>
                                            <input type="text" name="txtSort" class="form-control" value="<?=$sort?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                    </div>
                    <!-- #btabs-animated-fade-general -->
                    <div class="tab-pane fade" id="btabs-animated-fade-data">
                        <div class="row">
                            <div class="col-sm-3">
                                <h4>Thông tin chi tiết sản phẩm</h4>
                                <p class="text-muted">Cung cấp thông tin về hình ảnh, thông tin chi tiết, giá sản phẩm</p>
                            </div>
                            <div class="col-sm-9">
                                <div class="panel panel-default panel-light">
                                    <div class="panel-body">
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
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="control-label col-sm-2">Giá bán</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="price" class="form-control money" value="<?=$price?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="control-label col-sm-2">Giá khuyến mãi</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="price2" class="form-control money" value="<?=$pricekm?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Chi tiết sản phẩm</label>
                                            <textarea name="txtDetail" class="form-control  tinymce-editor" id="txtDetail" style="height:350px;"><?=$detail;?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- panel -->
                            </div>
                        </div>
                    </div>
                    <!-- #btabs-animated-fade-data -->
                    <div class="tab-pane fade" id="btabs-animated-fade-images">
                        <input id="all_image_child" type="hidden" name="all_image_child" value='<?php echo $sort_all_images ?>' />
                        <input id="image_child_add_tmp" type="hidden" value="" />
                        <div id="wrap_all_image">
                            <ul class="list-inline sortable-grid clearfix">
                                <li class="col-xs-12 col-sm-3">
                                    <div class="inner">
                                        <a href="../filemanager/dialog.php?type=1&amp;field_id=image_child_add_tmp&amp;relative_url=1&amp;fldr=product" class="iframe-btn text-center" style="display: block; width: 100%; height: 100%;">
                                            <i class="si si-plus" style="font-size: 50px; margin-top: 30px; display: inline-block;"></i>
                                            <div>Thêm hình ảnh</div>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                
                        </div>
                    </div>
                    <!-- #btabs-animated-fade-images -->
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
            </div>
        </form>
    </div>
</div>


<script type="text/javascript">
$(function() {

    $('.money').number(true);

    $('.iframe-btn').fancybox({
        'width'   : 880,
        'height'  : 570,
        'type'    : 'iframe',
        'autoScale'   : false
    });
});

function responsive_filemanager_callback(field_id){
    var myJsonString = '',
        imgs_array = [],
        array_tmp = [],
        i = 0,
        is_edit = false;
    var url=jQuery('#'+field_id).val();

    if(field_id == 'image_child_add_tmp'){
        myJsonString = jQuery('#all_image_child').val();
        imgs_array = [];
        if(myJsonString !== ''){
            imgs_array = JSON.parse(myJsonString);
        }
        var d = new Date();
        array_tmp = ['IMGS_OTHER_'+(d.getTime()), url];
        imgs_array.push(array_tmp);
        if(imgs_array.length > 0){
            myJsonString = JSON.stringify(imgs_array);
        }else{
            myJsonString = '';
        }
        $('#all_image_child').val(myJsonString);

    }else if(field_id == 'fieldID'){
        myJsonString = jQuery('#all_image_child').val();
        imgs_array = [];
        is_edit = false;
        if(myJsonString !== ''){
            imgs_array = JSON.parse(myJsonString);
            for (i = 0; i < imgs_array.length; i++) {
                if(imgs_array[i][0] == 'IMG_CHILD_MAIN'){
                    imgs_array[i][1] = url;
                    is_edit = true;
                    break;
                }
            }
        }
        if(is_edit === false){
            array_tmp = ['IMG_CHILD_MAIN', url];
            imgs_array.push(array_tmp);
        }
        if(imgs_array.length > 0){
            myJsonString = JSON.stringify(imgs_array);
        }else{
            myJsonString = '';
        }
        $('#all_image_child').val(myJsonString);

        jQuery('#'+field_id).closest('.input-group').find('img').attr('src', '<?php echo __PATH_UPLOAD__ ?>' + url);

    }else if(field_id.substring(0, 11) == 'IMGS_OTHER_'){
        myJsonString = jQuery('#all_image_child').val();
        imgs_array = [];
        if(myJsonString !== ''){
            imgs_array = JSON.parse(myJsonString);
            for (i = 0; i < imgs_array.length; i++) {
                if(imgs_array[i][0] == field_id){
                    imgs_array[i][1] = url;
                    break;
                }
            }
        }
        if(imgs_array.length > 0){
            myJsonString = JSON.stringify(imgs_array);
        }else{
            myJsonString = '';
        }
        $('#all_image_child').val(myJsonString);

    }else if(field_id.substring(0, 12) == 'image_child_'){
        myJsonString = jQuery('#all_image_child').val();
        var stt = field_id.substring(12, field_id.length);
        imgs_array = [];
        is_edit = false;
        if(myJsonString !== ''){
            imgs_array = JSON.parse(myJsonString);
            for (i = 0; i < imgs_array.length; i++) {
                if(imgs_array[i][0] == 'IMG_CHILD_'+stt){
                    imgs_array[i][1] = url;
                    is_edit = true;
                    break;
                }
            }
        }
        if(is_edit === false){
            array_tmp = ['IMG_CHILD_'+stt, url];
            imgs_array.push(array_tmp);
        }
        if(imgs_array.length > 0){
            myJsonString = JSON.stringify(imgs_array);
        }else{
            myJsonString = '';
        }
        $('#all_image_child').val(myJsonString);

        jQuery('#'+field_id).closest('.input-group').find('img').attr('src', '<?php echo __PATH_UPLOAD__; ?>' + url);

    }else{
        jQuery('#'+field_id).closest('.input-group').find('img').attr('src', '<?php echo __PATH_UPLOAD__; ?>' + url);
    }

    load_all_image();
}

function delete_img_product_thumbnail(field_id){
    var myJsonString = '',
        imgs_array = [],
        i = 0,
        imgs_array_tmp = '';

    if(field_id == 'fieldID'){
        myJsonString = jQuery('#all_image_child').val();
        imgs_array = [];
        if(myJsonString !== ''){
            imgs_array_tmp = JSON.parse(myJsonString);
            for (i = 0; i < imgs_array_tmp.length; i++) {
                if(imgs_array_tmp[i][0] != 'IMG_CHILD_MAIN'){
                    imgs_array.push(imgs_array_tmp[i]);
                }
            }
        }
        if(imgs_array.length > 0){
            myJsonString = JSON.stringify(imgs_array);
        }else{
            myJsonString = '';
        }
        $('#all_image_child').val(myJsonString);

    }else if(field_id.substring(0, 11) == 'IMGS_OTHER_'){
        myJsonString = jQuery('#all_image_child').val();
        imgs_array = [];
        if(myJsonString !== ''){
            imgs_array_tmp = JSON.parse(myJsonString);
            for (i = 0; i < imgs_array_tmp.length; i++) {
                if(imgs_array_tmp[i][0] != field_id){
                    imgs_array.push(imgs_array_tmp[i]);
                }
            }
        }
        if(imgs_array.length > 0){
            myJsonString = JSON.stringify(imgs_array);
        }else{
            myJsonString = '';
        }
        $('#all_image_child').val(myJsonString);

    }else if(field_id.substring(0, 12) == 'image_child_'){
        var stt = field_id.substring(12, field_id.length);
        myJsonString = jQuery('#all_image_child').val();
        imgs_array = [];
        if(myJsonString !== ''){
            imgs_array_tmp = JSON.parse(myJsonString);
            for (i = 0; i < imgs_array_tmp.length; i++) {
                if(imgs_array_tmp[i][0] != 'IMG_CHILD_'+stt){
                    imgs_array.push(imgs_array_tmp[i]);
                }
            }
        }
        if(imgs_array.length > 0){
            myJsonString = JSON.stringify(imgs_array);
        }else{
            myJsonString = '';
        }
        $('#all_image_child').val(myJsonString);

    }

    jQuery('#'+field_id).val('');
    jQuery('#'+field_id).closest('.input-group').find('img').attr('src', '<?php echo __PATH_NOIMAGE__ ?>');

    load_all_image();
}

function load_all_image(){
    var src_array = [];
    var myJsonString = jQuery('#all_image_child').val();
    if(myJsonString !== ''){
        src_array = JSON.parse(myJsonString);
    }

    var url_ajax = 'view/templates/item/item_all_image.php';
    var params = {
        action: 'LOAD_ALL_IMAGE',
        src_array: src_array
    };
    $.post(url_ajax, params, function(data) {
        $('#wrap_all_image #sortable_grid').remove();
        $('#wrap_all_image').prepend(data);
        jQuery("#sortable_grid").sortable({
            placeholder: "ui-state-highlights col-xs-12 col-sm-3",
            update: function( event, ui ) {
                //var imgs_array = jQuery(this).sortable("toArray", {attribute: 'data-src'});
                var imgs_array = [];
                jQuery(this).find('>li').each(function(){
                    var array_tmp = [$(this).attr('data-type'), $(this).attr('data-src')];
                    imgs_array.push(array_tmp);
                });
                var myJsonString = JSON.stringify(imgs_array);
                $('#all_image_child').val(myJsonString);
            }
        });
        jQuery("#sortable_grid").disableSelection();
    });
}

function sort_all_image(element, d){
    var index_current = $(element).closest('li').index();
    var total_li = $(element).closest('ul').find('li').length;

    if(d == 'UP'){
        if(index_current > 0){
            var element_before = $(element).closest('ul').find('li:eq('+ (index_current-1) +')');
            $(element).closest('li').insertBefore(element_before);
        }
    }else if(d == 'DOWN'){
        if(index_current < total_li-1){
            var element_after = $(element).closest('ul').find('li:eq('+ (index_current+1) +')');
            $(element).closest('li').insertAfter(element_after);
        }
    }


    var imgs_array = [];
    jQuery('#sortable_grid > li').each(function(){
        var array_tmp = [$(this).attr('data-type'), $(this).attr('data-src')];
        imgs_array.push(array_tmp);
    });
    var myJsonString = JSON.stringify(imgs_array);
    $('#all_image_child').val(myJsonString);

    load_all_image();
}

$(function() {
    load_all_image();
});

</script>

<script type="text/javascript">
$(function() {

    $('.countW').on('change paste keyup',function(){
        var value = $(this).val().length;
        var leng  = $(this).attr('maxlength');
        if (value > leng) {return false;}
        $(this).closest('.form-group').find('.elcount').html(value);
    });

    var value_ol1 = $('#seo_title').val().length;
    var value_ol2 = $('#seo_description').val().length;
    $('#seo_title').closest('.form-group').find('.elcount').html(value_ol1);
    $('#seo_description').closest('.form-group').find('.elcount').html(value_ol2);


    $('input[name="name"]').on('change paste keyup', function(){
        var value = $(this).val();

        $.ajax({
            url: 'ajax/ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {'value': value, 'id': '<?php echo $oldid ?>', 'table': 'tbl_item', 'cmd': 'CRE_ALIAS'},
        })
        .done(function(data) {
            console.log('ss');
            $('input[name="subject"]').val(data.subject);
            $('input[name="subject_tmp"]').val(data.subject_temp);
        })
        .fail(function(data){
            console.log(data);
        });
        
    });

    $('a[data-action="default-alias"]').on('click', function(){
        var value = $('input[name="name"]').val();

        $.ajax({
            url: 'ajax/ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {'value': value, 'id': '<?php echo $oldid ?>', 'table': 'tbl_item', 'cmd': 'DEF_ALIAS'},
        })
        .done(function(data) {
            $('input[name="subject"]').val(data.subject);
            $('input[name="subject_tmp"]').val(data.subject_temp);
        });
    });


    checkKeyword();

    $('#seo_title').on('change paste keyup', function(){
        checkKeyword();
    });
    $('#seo_description').on('change paste keyup', function(){
        checkKeyword();
    });
    $('#seo_keyword').on('change paste keyup', function(){
        checkKeyword();
    });
});

function checkKeyword() {

    var keyword = $('#seo_keyword').val(),
        count_page_title = 0,
        count_meta_description = 0;

    var seo_title = $('#seo_title').val() || "";
        if (seo_title === ''){
            seo_title = '<?php echo $name;?>';
        } else
            seo_title = bodauTiengViet(seo_title);

    var seo_description = $('#seo_description').val() || "",
        seo_meta_decription = bodauTiengViet(seo_description);

    if (keyword.length > 0) {

        var keyword = bodauTiengViet(keyword),
            arr = keyword.split(', ');

        for (var i = 0; i < arr.length; i++) { 

            count_page_title += seo_title.split(arr[i].trim()).length-1;
            count_meta_description += seo_meta_decription.split(arr[i].trim()).length-1;

        }
        
    }

    if (count_page_title > 0) {

        $('#seo_keyword').closest('div').find('.alert li.page_title b').css('color', 'green');
        $('#seo_keyword').closest('div').find('.alert li.page_title b').text('Có (' + count_page_title + ')');

    } else {

        $('#seo_keyword').closest('div').find('.alert li.page_title b').css('color', 'red');
        $('#seo_keyword').closest('div').find('.alert li.page_title b').text('Không');
    }

    if (count_meta_description > 0) {

        $('#seo_keyword').closest('div').find('.alert li.meta_description b').css('color', 'green');
        $('#seo_keyword').closest('div').find('.alert li.meta_description b').text('Có (' + count_meta_description + ')');

    } else {

        $('#seo_keyword').closest('div').find('.alert li.meta_description b').css('color', 'red');
        $('#seo_keyword').closest('div').find('.alert li.meta_description b').text('Không');

    }
}
</script>

<style type="text/css">
#tableImages > tbody >tr > td {
  vertical-align: middle;
}

.sortable-grid{
    /*display: inline-block;
    width: 100%;*/
}
.sortable-grid > li{
    margin-top: 5px;
    margin-bottom: 5px;
}
.sortable-grid > li .inner{
    background: #F5F5F5;
    padding: 3px;
    height: 143px;
}
.sortable-grid > li .inner .img-thumbnail{
    width: 122px;
    height: 97px;
    border-radius: 0;
}
.sortable-grid > li .inner .cmd{
    width: 122px;
}
.sortable-grid > li .inner .cmd > div:nth-child(1){
    padding-left: 0;
    padding-right: 3px;
}
.sortable-grid > li .inner .cmd > div:nth-child(2){
    padding-left: 3px;
    padding-right: 0;
}
.sortable-grid > li .inner .cmd > div a{
    display: block;
}
.sortable-grid > li .inner img{
    max-height: 87px;
    width: 100%;
}
.sortable-grid > li.ui-state-highlights {
    height: 143px;
}
.sortable-grid > li.ui-state-highlights:before{
    content: " ";
    display: block;
    background-color: #f9f9f9;
    border: 1px dashed #ccc;
    width: 100%;
    height: 100%;
}
</style>