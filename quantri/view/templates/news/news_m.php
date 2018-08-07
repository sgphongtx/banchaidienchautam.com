<?php $errMsg =''; ?>
<?php

if (isset($_POST['btnSave'])) {
    $name          = isset($_POST['name']) ? trim($_POST['name']) : '';
    $parent        = $_POST['ddCat'];
    if($parent=="") $parent=$lang;

    $subject      = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $subject_temp = isset($_POST['subject_tmp']) ? trim($_POST['subject_tmp']) : '';
    $detail_short = isset($_POST['txtDetailShort']) ? addslashes($_POST['txtDetailShort']) : '';
    $detail       = isset($_POST['txtDetail']) ? addslashes($_POST['txtDetail']) : '';
    $image        = isset($_POST['txtImage']) ? trim($_POST['txtImage']) : '';
    $sort         = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
    $status       = 0;
    $title        = isset($_POST['title']) ? trim($_POST['title']) : '';
    $description  = isset($_POST['description']) ? trim($_POST['description']) : '';
    $keyword      = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';

    if ($name=="") $errMsg .= "Hãy nhập tên danh mục !<br>";

    if ($errMsg=='') {

        if (!empty($_POST['id'])){
            $oldid = $_POST['id'];
            $image_ = $image;
            $sql = "UPDATE tbl_item SET idshop = '$idshop', name = '$name', parent = '$parent', subject = '$subject', subject_temp = '$subject_temp', detail_short = '$detail_short', detail = '$detail', image='$image_', sort = '$sort', title = '$title', description = '$description', keyword = '$keyword', lang = '$lang', last_modified = now() WHERE id = '$oldid'";
        }else{
            $image_ = $image;
            $sql = "INSERT INTO tbl_item (idshop, name, cate, parent, subject, subject_temp, detail_short, detail, image, sort, title, description, keyword, status, lang, date_added, last_modified) VALUES ('$idshop', '$name', '2', '$parent', '$subject', '$subject_temp', '$detail_short', '$detail', '$image_', '$sort', '$title', '$description', '$keyword', '1', '$lang', now(), now())"; }

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
            $row           = mysqli_fetch_array($result);

            $name          = $row['name'];
            $parent        = $row['parent'];
            $subject       = $row['subject'];
            $subject_temp  = $row['subject_temp'];
            $detail_short  = stripslashes($row['detail_short']);
            $detail        = stripslashes($row['detail']);
            $image         = $row['image'];
            if ($image == '')
                $image_ = __PATH_NOIMAGE__;
            else
                $image_ = __PATH_UPLOAD__ . $image;
            $image_large   = $row['image_large'];
            $sort          = $row['sort'];
            $status        = $row['status'];
            
            $title         = $row['title'];
            $description   = $row['description'];
            $keyword       = $row['keyword'];
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
            <h1 class="page-heading">Bài viết <small>Thêm mới Bài viết</small></h1>
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
            <form method="post" name="frmForm" enctype="multipart/form-data" class="">
                <input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />
                <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
                <input type="hidden" name="page" value="<?=$_REQUEST['page']?>" />
                
                <div class="row">
                    <div class="col-sm-3">
                        <h4>Nội dung bài viết</h4>
                        <p class="text-muted">
	                        Chọn ảnh đại diện<br>
	                        Lưu ý: <br>
	                        + Kích thước tối thiểu 200x200<br>
	                        + Dung lượng tối đa 500kb
                        </p>
                        <div class="input-group">
                            <div id="img_preview_main" class="wrap-img-product-thumbnail">
                                <div class="img-thumbnail img-product-thumbnail pull-left">
                                    <img class="img-responsive" src="<?php echo $image_; ?>" style="width: 120px; height: 120px;" />
                                </div>
                                <div class="pull-left">
                                    <div style="margin: 0 10px 10px;">
                                        <a class="btn btn-info iframe-btn" href="../filemanager/dialog.php?type=1&amp;field_id=fieldID&amp;relative_url=1&amp;fldr=posts">
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
                    <div class="col-sm-9">
                    	<div class="panel panel-default panel-light">
                    		<div class="panel-body">
                    			<div class="form-group">
                    				<label class="control-label">
                    					Tên bài viết <font color="red">*</font>
                    				</label>
                    				<input type="text" name="name" class="form-control" value="<?=$name?>"/>
                    			</div>
                    			<div class="form-group">
                                    <?php 
                                        $result_menu = get_records('tbl_item_category','cate=2 and status = 1','sort asc,id asc',' ',$lang);
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
                                <div class="form-group">
                                    <label class="control-label">Tóm tắt</label>
                                    <textarea name="txtDetailShort" class="form-control" id="txtDetailShort"><?=$detail_short?></textarea>
                                </div>
                    			<div class="form-group">
                    				<label class="control-label">Nội dung bài viết</label>
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


    $('input[name="name"]').on('change paste keyup', function(){
        var value = $(this).val();
        $.ajax({
            url: 'ajax/ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {'value': value, 'id': '<?php echo $oldid ?>', 'table': 'tbl_item', 'cmd': 'CRE_ALIAS'},
        })
        .done(function(data) {
            $('input[name="subject"]').val(data.subject);
            $('input[name="subject_tmp"]').val(data.subject_temp);
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
            console.log(data);
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