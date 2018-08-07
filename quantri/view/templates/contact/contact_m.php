<?php $errMsg =''?>
<?php
if (isset($_POST['btnSave'])){

	$name          = isset($_POST['name']) ? trim($_POST['name']) : '';
	$parent        = $_POST['ddCat'];
	$detail        = isset($_POST['txtDetail']) ? addslashes($_POST['txtDetail']) : '';
    $status        = 0;

	if ($detail=="") $errMsg .= "Hãy nhập nội dung !<br>";

    if ($errMsg==''){ 
        if (!empty($_POST['id'])){
            $oldid = $_POST['id'];
            $sql = "UPDATE tbl_item SET idshop='$idshop', name='$name', parent='$parent', detail='$detail', last_modified=now(), lang='$lang' WHERE id='$oldid'";
        } else {
            $sql = "INSERT INTO tbl_item (idshop, cate, name, parent, detail, status , date_added, last_modified, lang) VALUES ('$idshop','5','$name', '$parent','$detail','1',now(),now(),'$lang')";
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
		$sql = "select * from tbl_item where id='".$oldid."'";
		if ($result = mysqli_query($conn,$sql)) {
			$row=mysqli_fetch_array($result);
			$name          = $row['name'];
			$parent        = $row['parent'];
			$detail        = stripslashes($row['detail']);
			$status        = $row['status'];
		}
	}
}
?>
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Liên hệ <small>Thêm mới Thông tin liên hệ</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li><a href="<?=url_direct('get')?>">Thông tin liên hệ</a></li>
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
            <form method="post" name="frmForm" enctype="multipart/form-data" class="">
                <input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />
                <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
                <input type="hidden" name="page" value="<?=$_REQUEST['page']?>" />

                <div class="row">
                    <div class="col-sm-3">
                        <h4>Nội dung trang liên hệ</h4>
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
                                                <option value="<?=$lang?>"><?=get_field("tbl_language","id",$lang,"name")?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                    			<div class="form-group">
                    				<label class="control-label">Nội dung</label>
                    				<textarea name="txtDetail" class="form-control tinymce-editor" id="txtDetail"><?=$detail;?></textarea>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                	<div class="col-sm-3">
                		<h4>Tối ưu SEO</h4>
                		<p class="text-muted">
                			Thiết lập thẻ tiêu đề, thẻ mô tả, đường dẫn. Những thông tin này xác định cách danh mục xuất hiện trên công cụ tìm kiếm.
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
                			</div>
                		</div>
                	</div>
                </div>
                <!-- row -->
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