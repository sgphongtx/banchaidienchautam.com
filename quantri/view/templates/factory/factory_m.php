<?php if($_GET["id"] && !mysqli_num_rows(mysqli_query($conn,"SELECT id FROM Manufacturer WHERE id = {$_GET['id']}")))  header("location: " . url_direct('get'));

	 $errMsg ='';
	 if($_GET["id"])$result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM Manufacturer WHERE id = {$_GET['id']}"));

	 if(isset($_POST["save"])){
			 if(!$_POST["txtName"]) $errMsg = "Vui lòng điền tên thương hiệu.";
			 if(!$errMsg){
				$fields = array("name","name_show","sort","img","status","date_modified");
				$sql = "";
				$data = array();$arrField = array();
				foreach ($_POST as $key => $value) {
					if(!in_array(strtolower(str_replace(array("txt", "dr"), "", $key)), $fields)) continue;
					$field = strtolower(str_replace(array("txt", "dr"), "", $key));
					$value = mysqli_escape_string(strip_tags($value));
					$data[$field] = $value;
					$arrField[] = $field . "='$value'";
				}
				if($_GET["id"]){
					 $sql = "UPDATE Manufacturer SET " . implode(",", $arrField) . " WHERE id = {$_GET['id']} ";
				}else $sql = "INSERT INTO Manufacturer (".implode(",",array_keys($data)).") VALUES ('".implode("','",$data)."')";

				if(mysqli_query($conn,$sql)) {$result = $data;$sucMsg = "<div class=\"alert alert-success\">Đã lưu</div>";
				$url_direct = url_direct('get',$_GET['act'],'_m','&cat='.$_REQUEST['cat'].'&pageNum='.$_REQUEST['page'].'&code=1');
        		echo "<script>window.location='$url_direct'</script>";
			}
				else $errMsg = "Lỗi truy vấn";
			 }
	 }
?>
<div class="content bg-gray-lighter">
		<div class="row items-push">
				<div class="col-sm-7">
						<h1 class="page-heading">Thương hiệu</h1>
				</div>
				<div class="col-sm-5 text-right hidden-xs">
						<ol class="breadcrumb push-10-t">
								<li><a href="<?=url_direct()?>">Quản trị</a></li>
								<li><a href="<?=url_direct('get')?>">Danh sách thương hiệu</a></li>
								<li>Thêm mới</li>
						</ol>
				</div>
		</div>
</div>
<div class="content" style="min-height: 530px;">
		<div class="bs-example bs-example-bg-classes">
				<?php if($errMsg != '') : ?>
				<p class="bg-warning"><?php echo $errMsg; ?></p>
				<?php else: ?>
				<p class="bg-warning">Lưu ý: Những ô có dấu (<font color="red">*</font>) là bắt buộc</p>
				<?php endif; ?>
		</div><?=$sucMsg?>
		<div class="block">
				<div class="block-content">
						<form method="POST" name="frmForm" action="">
								<input type="hidden" name="txtPage" value="<?=$_REQUEST['page']?>" />
								<input type="hidden" name="txtDate_modified" value="<?=date("Y-m-d H:i:s")?>" />

								<div class="row">
									<div class="col-sm-3">
										<h4>Ảnh đại diện</h4>
										<p class="text-muted">
											Lưu ý: <br>+ Kích thước tối thiểu 200x200<br>+ Dung lượng tối đa 500kb
										</p>
										<div class="input-group">
											<div id="img_preview_main" class="wrap-img-product-thumbnail">
												<div class="img-thumbnail img-product-thumbnail pull-left">
													<img class="img-responsive" src="<?php echo $result['img']; ?>" style="width: 120px; height: 120px;" />
												</div>
												<div class="pull-left">
													<div style="margin: 0 10px 10px;">
														<a class="btn btn-info iframe-btn" href="../filemanager/dialog.php?type=1&amp;field_id=fieldID&amp;relative_url=1&amp;fldr=manufacturer">
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

											<input id="fieldID" type="hidden" name="txtImg" value="<?php echo $result["img"]; ?>" class="form-control">
										</div>
									</div>
										<div class="col-sm-9">
											<div class="panel panel-default panel-light">
												<div class="panel-body">
													<div class="form-group">
														<label class="control-label">
															Tên thương hiệu <font color="red">*</font>
														</label>
														<input type="text" name="txtName" class="form-control" value="<?=$result["name"]?>"/>
													</div>
                                                    <!-- <div class="form-group">
                                                        <label class="control-label">
                                                            Tên hiển thị
                                                        </label>
                                                        <input type="text" name="txtName_Show" class="form-control" value="<?=$result["name_show"]?>"/>
                                                    </div> -->
													<div class="form-group">
															<label class="control-label">Sắp xếp vị trí <small class="text-muted">Không bắt buộc</small></label>
															<input type="text" name="txtSort" class="form-control" value="<?=$result["sort"]?$result["sort"]:0?>"/>
													</div>
													<div class="form-group">
															<label class="control-label">Trạng thái</label>
															<select name="drStatus" class="form-control">
																	<option value="1" <?=$result["status"]==1?"selected":""?>>Hiện</option>
																	<option value="0" <?=($_GET["id"] && $result["status"]==0) ? "selected":""?>>Ẩn</option>
															</select>
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
														<button type="submit" name="save" class="btn btn-sm btn-primary">Lưu</button>
														<button onclick="goBack()" type="button" name="goback" class="btn btn-sm btn-danger">Quay lại</button>
												</div>
										</div>
									</div>
								</div>
						</form>
				</div>
		</div>
</div>