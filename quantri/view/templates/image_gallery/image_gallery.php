<?php if (isset($_POST['btnSave'])){
 	for($im = 1; $im <= 10; $im ++) {
	  	if(isset($_POST['txtImage'.$im.'']) && $_POST['txtImage'.$im.'']!='') {
			$sql = "INSERT INTO tbl_image_gallery (name, image, date_added) VALUES ('".$_POST["txtname" . $im]."','".$_POST['txtImage'.$im.'']."', now())";
			mysqli_query($conn,$sql);
	  	}
 	}
} ?>
<div class="content bg-gray-lighter">
 	<div class="row items-push">
	  	<div class="col-sm-7">
			<h1 class="page-heading">Image Album <small>Thêm mới hình ảnh</small></h1>
	  	</div>
	  	<div class="col-sm-5 text-right hidden-xs">
			<ol class="breadcrumb push-10-t">
				<li><a href="<?=url_direct()?>">Quản trị</a></li>
				<li><a href="<?=url_direct('get')?>">Album</a></li>
				<li>Thêm mới hình ảnh</li>
			</ol>
	  	</div>
 	</div>
</div>

<div class="content" style="min-height: 530px;">
 	<div class="block">
	  	<div class="block-content">
			<form method="post" name="frmForm" enctype="multipart/form-data">
				<input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />
				<input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
				<input type="hidden" name="page" value="<?=$_REQUEST['page']?>" />

			 	<div class="form-group"> <div class="btn btn-primary btn-file clearfix" id="AddImage"> <i class="fa fa-plus"> </i> Thêm ảnh </div> </div>
			 	<div class="form-group">
			  		<div id="addButton" class="clearfix" style="margin: 0 0 20px;"></div>
				 	<div class="form-group action hidden clearfix">
					  	<div class="col-sm-6 col-sm-offset-2 btn-gr">
							<button type="submit" name="btnSave" class="btn btn-sm btn-primary">Lưu</button>
							<button onclick="goBack()" type="button" name="goback" class="btn btn-sm btn-danger">Quay lại</button>
					  	</div>
				 	</div>
				  	<div id="listImage">
						<div class="row items-push js-gallery-advanced">
							<?php $gall_s = mysqli_query($conn,"SELECT * FROM tbl_image_gallery");
								while ($gall_ = mysqli_fetch_assoc($gall_s)) { ?>

						 	<div id="img-<?=$gall_['id']?>" class="col-sm-6 col-md-4 col-lg-3" style="height: 255px;margin-bottom: 15px;">
							  	<div class="img-container fx-img-rotate-r" style="display: table;width: 100%;height: 100%;overflow: hidden;">
									<a class="img-link img-thumb" href="javascript:void(0);" style="display: table-cell;vertical-align: middle;background: #ddd;height: 100%">
									 	<img class="img-responsive" src="<?=$gall_['image']?>">
									</a>
									<div class="img-options">
									 	<div class="img-options-content">
									 		<h3 class="font-w400 text-white push-5"><?php echo $gall_["name"] ?></h3>
									 		<h4 class="h6 font-w400 text-white-op push-15">&nbsp;</h4>
										  	<div class="btn-group btn-group-sm">
												<a class="btn btn-default" href="javascript:void(0)" onclick="del_img(<?=$gall_['id']?>)"><i class="fa fa-times"></i> Xóa</a>
										  	</div>
									 	</div>
									</div>
							  	</div>
						 	</div>
							<?php } ?>
						</div>
				  	</div>
			 	</div>
			</form>
	  	</div>
 	</div>
</div>
<script type="text/javascript">
$(function() {
 	var i = 1;
	$('#AddImage').click(function(){
		var html = '';
	  	if(i <= 10) {
			html += '<br/><div class="col-md-6"><label>Tiêu đề</label><input name="txtname'+i+'" class="form-control" required/></div><div class="col-md-6"><label>Hình ảnh</label><div class="input-group">';
			html += '<input type="text" name="txtImage'+i+'" id="field_'+i+'" class="form-control" value="">';
			html += '<span class="input-group-addon" style="background-color: #3c7ac9; border-color: #295995;">';
			html += '<a class="iframe-btn" href="../filemanager/dialog.php?type=1&amp;field_id=field_'+i+'&amp;relative_url=1" style="color: #fff;">';
			html += '<i class="fa fa-folder-open"></i> Browse...</a></span>';
			html += '<span class="input-group-addon" style="background-color: #c94d3c; border-color: #953629;">';
			html += '<a onclick="delete_file_document(\'field_'+i+'\')" href="javascript:void(0)" title="Xóa file có sẵn" style="color: #fff;">';
			html += '<i class="fa fa-trash"></i> </a> </span> </div></div><br>';
			$('#addButton').append(html);
	  	}
		i++;
		if($("#addButton").html()) $(".action").removeClass('hidden');
 	});
});
</script>

<script type="text/javascript">
function delete_file_document(field_id){ jQuery('#'+field_id).val(''); }
function del_img(id) {
 	if (id!='') {
	  	$.ajax({
			url: 'ajax/ajax.php',
			type: 'POST',
			data: {'id': id, 'cmd': 'DEL_IMG_GAL'},
	  	})
		.done(function(_res) {
			if (_res==0) {
			 	$("#img-"+id).css('display', 'none');
			} else {
			 	alert('Không thể xóa');
			}
		});
 	}
}
</script>
<style type="text/css">
.img-link:hover {
	-webkit-transform: rotate(1deg);
	-ms-transform: rotate(1deg);
	transform: rotate(1deg);
}
.img-options {
	position: absolute;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	z-index: 1;
	content: "";
	background-color: rgba(0,0,0,0.6);
	opacity: 0;
	visibility: none;
	-webkit-transition: all .25s ease-out;
	transition: all .25s ease-out;
}
.img-options-content {
	position: absolute;
	top: 50%;
	-webkit-transform: translateY(-50%);
	-ms-transform: translateY(-50%);
	transform: translateY(-50%);
	right: 0;
	left: 0;
	text-align: center;
}
.img-link:hover .img-options {
	opacity: 1;
	visibility: visible;
}
a.img-thumb img {
	/* max-width: 222px; */
	/* max-height: 222px; */
}
</style>