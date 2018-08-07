<?php $errMsg =''?>
<?php

if (isset($_POST['btnSave'])){
	$name   = isset($_POST['name']) ? trim($_POST['name']) : '';
	$parent = 1;
	$subject      = isset($_POST['subject']) ? trim($_POST['subject']) : '';
	$subject_temp = isset($_POST['subject_temp']) ? trim($_POST['subject_temp']) : '';
	$image  = isset($_POST['txtImage']) ? trim($_POST['txtImage']) : '';

	if ($name=="") $errMsg .= "Hãy nhập tên danh mục !<br>";

	$oldid = $_POST['id'];

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$image_ = $image;

			$sql = "UPDATE tbl_item_category SET 
			name = '$name', 
			parent = '$parent', 
			subject = '$subject', 
			subject_temp = '$subject_temp', 
			image='$image_',
			last_modified = now() 
			WHERE id = '$oldid'";
		}else{
			$image_ = $image;
			$sql = "INSERT INTO tbl_item_category 
			(idshop, name, parent, subject, subject_temp, image, hot, status, belong, pos, del, date_added, last_modified) VALUES 
			('0', '$name', '$parent', '$subject', '$subject_temp', '$image_', '1', '1', '1', '1', '0', now(), now())";
		}
		
		if (mysqli_query($conn,$sql)){
			if(empty($_POST['id'])) $oldid = mysqli_insert_id();
			$r = getRecord("tbl_item_category","id=".$oldid);
			if($parent==1) $langp=$oldid;
				$arrField = array(
				"lang"          => "'".$langp."'"
			);// ko them id vao cuoi cho dep
			$result = update("tbl_item_category",$arrField,"id=".$oldid);
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
		$sql = "select * from tbl_item_category where id='".$oldid."'";
		if ($result = mysqli_query($conn,$sql)) {
			$row           = mysqli_fetch_array($result);
			$name          = $row['name'];
			$parent        = $row['parent'];
			$subject       = $row['subject'];
			$subject_temp  = $row['subject_temp'];
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
    					<label class="col-sm-3 label-control">
    						Đường dẫn / Alias <font color="red">*</font>
    					</label>             						
 						<div class="col-sm-9">
 							<div class="input-group">
								<span class="input-group-addon" id="basic-addon3"><?php echo $linkroot; ?>/</span>
								<input type="text" name="subject" class="form-control" value="<?=$subject?>" readonly/>
								<input type="hidden" name="subject_temp" class="form-control" value="<?=$subject_temp?>"/>
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

    if(field_id == 'fieldID')
        jQuery('#'+field_id).closest('.input-group').find('img').attr('src', '<?php echo __PATH_UPLOAD__; ?>' + url);
    else
        jQuery('#'+field_id).closest('.input-group').find('img').attr('src', '<?php echo __PATH_UPLOAD__; ?>' + url);
}

function delete_img_product_thumbnail(field_id){

    jQuery('#'+field_id).val('');
    jQuery('#'+field_id).closest('.input-group').find('img').attr('src', '<?php echo __PATH_NOIMAGE__ ?>');
}
    
</script>

<script type="text/javascript">
$(function() {

	$('input[name="name"]').on('change paste keyup', function(){
		var value = $(this).val();

		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			dataType: 'json',
			data: {'value': value, 'id': '<?php echo $oldid ?>', 'table': 'tbl_item_category', 'cmd': 'CRE_ALIAS'},
		})
		.done(function(data) {
			$('input[name="subject"]').val(data.subject);
			$('input[name="subject_temp"]').val(data.subject_temp);
		});
		
	});

});

</script>