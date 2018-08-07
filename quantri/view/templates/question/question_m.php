<? $errMsg =''?>
<?
$path = "../images/item";
$pathdb = "images/item";
if (isset($_POST['btnSave'])){
	$cauhoi         = isset($_POST['cauhoi']) ? trim($_POST['cauhoi']) : '';
	$traloi  = isset($_POST['traloi']) ? trim($_POST['traloi']) : '';
    $name  = isset($_POST['name']) ? trim($_POST['name']) : '';
    $address  = isset($_POST['address']) ? trim($_POST['address']) : '';
    $phone  = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $email  = isset($_POST['email']) ? trim($_POST['email']) : '';
	$sort          = isset($_POST['sort']) ? trim($_POST['sort']) : 0;
    
	if ($cauhoi=="") $errMsg .= "Hãy nhập câu hỏi !<br>";
	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "update tbl_hoi_dap set name='".$name."',address='".$address."',phone='".$phone."',email='".$email."',cauhoi='".$cauhoi."', traloi='".$traloi."', sort='".$sort."',last_modified=now() where id='".$oldid."'";
		}else{
			$sql = "insert into tbl_hoi_dap (name,address,phone,email,cauhoi, traloi,sort,status , date_added, last_modified) values ('".$name."','".$address."','".$phone."','".$email."','".$cauhoi."','".$traloi."','".$sort."','1',now(),now())";
		}
		if (mysqli_query($conn,$sql)){
			if(empty($_POST['id'])) $oldid = mysqli_insert_id();
			$r = getRecord("tbl_hoi_dap","id=".$oldid);
		
			$arrField = array(
            
            "subject"          => "'".cat_kytu_dacbiet($cauhoi,1,1,0,1,1)."-".$oldid."'"
			);// ko them id vao cuoi cho dep
			$result = update("tbl_hoi_dap",$arrField,"id=".$oldid);
			
			
			$dem1=count($listimage);
			if($dem1>0){
				foreach ($listimage as $k=>$v){
					$arrField = array(
					"iditem"          => "'".$oldid."'",
					);
					
					$result = update("tbl_ad",$arrField,"id='".$v."'");
				}
			}
			
			$sqlUpdateField = "";
			
			if ($_POST['chkClearImg']==''){
				$extsmall=getFileExtention($_FILES['txtImage']['name']);
				if (makeUpload($_FILES['txtImage'],"$path/item_s$oldid$extsmall")){
					@chmod("$path/item_s$oldid$extsmall", 0777);
					$sqlUpdateField = " image='$pathdb/item_s$oldid$extsmall' ";
				}
			}else{
				if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
				$sqlUpdateField = " image='' ";
			}
			
			if ($_POST['chkClearImgLarge']==''){
				$extlarge=getFileExtention($_FILES['txtImageLarge']['name']);
				if (makeUpload($_FILES['txtImageLarge'],"$path/item_category_l$oldid$extlarge")){
					@chmod("$path/item_l$oldid$extlarge", 0777);
					if($sqlUpdateField != "") $sqlUpdateField .= ",";
					$sqlUpdateField .= " image_large='$pathdb/item_category_l$oldid$extlarge' ";
				}
			}else{
				if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
				if($sqlUpdateField != "") $sqlUpdateField .= ",";
				$sqlUpdateField .= " image_large='' ";
			}
			
			if($sqlUpdateField!='')	{
				$sqlUpdate = "update tbl_hoi_dap set $sqlUpdateField where id='".$oldid."'";
				mysqli_query($conn,$sqlUpdate);
			}
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	}
	if ($errMsg == '')
		echo '<script>window.location="./?act=question&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_hoi_dap where id='".$oldid."'";
		if ($result = mysqli_query($conn,$sql)) {
			$row=mysqli_fetch_array($result);
			      $cauhoi          = $row['cauhoi'];
            $name          = $row['name'];
            $address          = $row['address'];
            $phone          = $row['phone'];
            $email          = $row['email'];
            $parent         = $row['parent'];
			$traloi        = $row['traloi'];
			$sort          = $row['sort'];
			$status        = $row['status'];
            
			$date_added    = $row['date_added'];
			$last_modified = $row['last_modified'];
		}
	}
}
?>
<script>
$(document).ready(function() {	
		//dao trang thai an hien
	$("#addimage").click(function(){
	id=$(this).attr("value");
	obj = this;
		$.ajax({
		   url:'status.php',
		   data: 'id='+ id +'&table=tbl_hoi_dap',
		   cache: false,
		   success: function(data){ //alert(idvnexpres);
			obj.src=data;
			if (data=="images/anhien_1.png") obj.title="Nhắp vào để ẩn";
			else obj.title="Nhắp vào để hiện";
		  }
		});
	});
	
});
</script>
<div class="main_cont_body">
    
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">Câu hỏi <small>Thêm mới câu hỏi</small></h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li><a href="<?=url_direct()?>">Quản trị</a></li>
                    <li><a href="<?=url_direct('get')?>">Danh sách câu hỏi</a></li>
                    <li>Thêm mới</li>
                </ol>
            </div>
        </div>
    </div>
    
    <div class="frame_cont_body">    
    
        <div class="note">Lưu ý: Những ô có dấu * là bắt buộc</div>                
    
    
        <div class="frm_tbl">
        <form method="post" name="frmForm" enctype="multipart/form-data">   
          <input type="hidden" name="act" value="question_m">
            <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
            <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
          <div> <? if($errMsg!=''){echo '<p align=center class="err">'.$errMsg.'<br></p>';}?>  </div>
            <table>
            <tr>
                  <th height="38">Câu hỏi</th>
                  <td>
                  <input name="cauhoi" type="text" class="ipt_txt1" id="cauhoi" value="<?=$cauhoi?>" />
                  </td>
              </tr>
              
               <tr>
                  <th height="38">Danh mục</th>
                  <td>
                    <select name="parent" class="ipt_txt1">
                        <option value="0">-----</option>
                        <?php
                            $rs_parent=get_result("tbl_item_category","show_box_question=1 and status=1","","");
                            while($row_parent=mysqli_fetch_array($rs_parent))
                            {
                        ?>
                        <option <?php echo $row_parent['id']==$parent?'selected="selected"':''?> value="<?=$row_parent['id']?>"><?=$row_parent['name']?></option>
                        <?php
                            }
                        ?>
                    </select>
                  </td>
              </tr>
              <tr>
                  <th height="38">Tên người gửi</th>
                  <td>
                  <input name="name" type="text" class="ipt_txt1" id="name" value="<?=$name?>" />
                  </td>
              </tr>
              <tr>
                  <th height="38">Địa chỉ người gửi</th>
                  <td>
                  <input name="address" type="text" class="ipt_txt1" id="address" value="<?=$address?>" />
                  </td>
              </tr>
              <tr>
                  <th height="38">Điện thoại người gửi</th>
                  <td>
                  <input name="phone" type="text" class="ipt_txt1" id="phone" value="<?=$phone?>" />
                  </td>
              </tr>
                <tr>
                  <th height="38">Email người gửi</th>
                  <td>
                  <input name="email" type="text" class="ipt_txt1" id="email" value="<?=$email?>" />
                  </td>
              </tr>
                <tr>
                  <th height="31">
                   
                 
                  Trả lời <br />
                 
                  
                  </th>
                  <td>
                  <div class="pdd1">
                    <textarea name="traloi" class="teare_editor" id="traloi" style="height:300px;"><?=$traloi;?>
                    </textarea>
                    <script type="text/javascript">
                         var editor = CKEDITOR.replace( 'traloi');
                    </script> 
                    <script>	  		  	
                        setTimeout("HienDuLieu2()", 1000);		
                        function HienDuLieu2(){
                            var str= "<?=$traloi;?>";			
                            var oEditor = CKEDITOR.instances.noidung;			
                            oEditor.setData( str);				
                        }
                    </script>   
                  </div>
                  </td>
              </tr>
                <tr>
                  <th>Thứ tự</th>
                  <td><div class="pdd1">
                    <input name="sort" type="text" class="ipt_txt1" id="name12" value="<?=$sort?>"/>
                  </div></td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>
                        <div class="pdd1">
                            <input id="btnSave"  name="btnSave" class="sub_txt1" type="submit" value="Chấp nhận"/>
                            &nbsp;
                            <input class="sub_txt1" type="submit" value="Quay lại"/>
                        </div>
                    </td>
                </tr>
                                             
            </table>
         </form>   
        </div><!-- End .frm_tbl -->
    
    </div><!-- End .frame_cont_body -->
    
</div>