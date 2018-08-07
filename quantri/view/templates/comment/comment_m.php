<? $errMsg =''?>
<?
$path = "../images/comment";
$pathdb = "images/comment";
if (isset($_POST['btnSave'])){
	$hoten          = isset($_POST['hoten']) ? trim($_POST['hoten']) : '';
    $diachi          = isset($_POST['diachi']) ? trim($_POST['diachi']) : '';
    $email          = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone          = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $cate          = isset($_POST['cate']) ? trim($_POST['cate']) : '';

	$noidung        = isset($_POST['noidung']) ? trim($_POST['noidung']) : '';
    $traloi          = isset($_POST['traloi']) ? trim($_POST['traloi']) : '';
	$sort          = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
	$status        = 0;

	if ($hoten=="") $errMsg .= "Hãy nhập tên danh mục !<br>";
	$errMsg .= checkUpload($_FILES["txtImage"],".jpg;.gif;.bmp;.png",500*1024,0);
	$errMsg .= checkUpload($_FILES["txtImageLarge"],".jpg;.gif;.bmp;.png",500*1024,0);

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "update tbl_comment set hoten='".$hoten."',diachi='".$diachi."',email='".$email."', phone='".$phone."',cate='".$cate."',noidung='".$noidung."',traloi='".$traloi."',last_modified=now() where id='".$oldid."'";
		}else{
			$sql = "insert into tbl_comment (hoten,diachi,email,phone,cate,noidung,traloi,status,date_added,last_modified) values ('".$hoten."','".$diachi."','".$email."','".$phone."','".$cate."','".$noidung."','".$traloi."',1,now(),now())";
		}
		if (mysqli_query($conn,$sql)){
			if(empty($_POST['id'])) $oldid = mysqli_insert_id();
			$r = getRecord("tbl_comment","id=".$oldid);

		}else{
			$errMsg = "Không thể cập nhật !";
		}
	}

	if ($errMsg == '') {
        $url_direct = url_direct('get',$_GET['act'],'_m','&cat='.$_REQUEST['cat'].'&pageNum='.$_REQUEST['page'].'&code=1');
        echo "<script>window.location='$url_direct'</script>";
    }
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_comment where id='".$oldid."'";
		if ($result = mysqli_query($conn,$sql)) {
			$row=mysqli_fetch_array($result);
			$hoten          = $row['hoten'];
			$diachi          = $row['diachi'];
            $email          = $row['email'];
            $phone          = $row['phone'];
            $cate         = $row['cate'];
			$noidung        = $row['noidung'];
			$traloi       = $row['traloi'];

			$date_added    = $row['date_added'];
			$last_modified = $row['last_modified'];
		}
	}
}

?>
<div class="content" style="min-height: 530px;">
    <h3>Thêm mới/chỉnh sửa ý kiến</h3>
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
                <input type="hidden" name="act" value="comment_m" />
                <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
                <input type="hidden" name="page" value="<?=$_REQUEST['page']?>" />

                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        Tên khách hàng <font color="red">*</font>
                    </label>
                    <div class="col-sm-8">
                        <input type="text" name="hoten" class="form-control" value="<?=$hoten?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        Địa chỉ
                    </label>
                    <div class="col-sm-8">
                        <input type="text" name="diachi" class="form-control" value="<?=$diachi?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        Email
                    </label>
                    <div class="col-sm-8">
                        <input type="text" name="email" class="form-control" value="<?=$email?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        Điện thoại
                    </label>
                    <div class="col-sm-8">
                        <input type="text" name="phone" class="form-control" value="<?=$phone?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        Danh mục
                    </label>
                    <select name="cate" class="ipt_txt1">
                        <option value="0">-----</option>
                        <?php
                            $rs_parent=get_result("tbl_item_category","show_box_question=1 and status=1","","");
                            while($row_parent=mysqli_fetch_array($rs_parent))
                            {
                        ?>
                        <option <?php echo $row_parent['id']==$cate?'selected="selected"':''?> value="<?=$row_parent['id']?>"><?=$row_parent['name']?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        Câu hỏi
                    </label>
                    <div class="col-sm-9">
                        <textarea name="noidung" class="form-control" id="txtDetailShort"  style="height:350px;"><?=$noidung;?></textarea>
                        <script type="text/javascript">
                            var editor = CKEDITOR.replace( 'noidung',
                            {
                                filebrowserImageBrowseUrl : '../web/assets/plugins/ckfinder/ckfinder.html?Type=Images',
                                filebrowserFlashBrowseUrl : '../web/assets/plugins/ckfinder/ckfinder.html?Type=Flash',
                                filebrowserImageUploadUrl : '../web/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                filebrowserFlashUploadUrl : '../web/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                fullPage : false
                            });
                        </script>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        Trả lời
                    </label>
                    <div class="col-sm-9">
                        <textarea name="traloi" class="form-control" id="traloi"  style="height:350px;"><?=$traloi;?></textarea>
                        <script type="text/javascript">
                            var editor = CKEDITOR.replace( 'traloi',
                            {
                                filebrowserImageBrowseUrl : '../web/assets/plugins/ckfinder/ckfinder.html?Type=Images',
                                filebrowserFlashBrowseUrl : '../web/assets/plugins/ckfinder/ckfinder.html?Type=Flash',
                                filebrowserImageUploadUrl : '../web/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                filebrowserFlashUploadUrl : '../web/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                fullPage : false
                            });
                        </script>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4 btn-gr">
                        <button type="submit" name="btnSave" class="btn btn-default">Chấp nhận</button>
                        <button onclick="goBack()" type="button" name="goback" class="btn btn-default">Quay lại</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
.Image {
    position: relative;
    float: left;
    min-height: 1px;
    padding-right: 5px;
    padding-top: 10px;
    margin-right: 15px;
    width: 20%;
}
.Image .thumbnail {
    margin-bottom: 0px;
}
.Xoa_image {
    cursor: pointer;
    color: #FFF;
    font-size: 13px;
    font-weight: bold;
    line-height: 0px;
    border-radius: 100%;
    display: inline-block;
    background: rgb(255, 0, 0) none repeat scroll 0% 0%;
    position: absolute;
    top: 3px;
    right: -3px;
}
select.ipt_txt1 {
    border-radius: 3px;
    border: 1px solid #ddd;
    padding: 4px;
    margin-left: 15px;
}
</style>