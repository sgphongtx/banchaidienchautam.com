<?php $errMsg =''?>
<?php 
	
	$id=$idshop;
	
	$sql="SELECT * FROM tbl_shop WHERE id='{$id}'";
	$gt=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($gt);
	
	if($row['css']=="") $content=get_field("tbl_template","id",$row['idtemplate'],"content");
	else $content=$row['css'];
	
	$box=get_field("tbl_template","id",$row['idtemplate'],"listname");
	$box=explode(",", $box);
	$demaa=count($box);
	
	$ttt=getRecord("tbl_module","idshop='".$idshop."'");
	$content=$ttt['list_title_module'];
	//$content1=$ttt['title_module1'];
 
	if($content=="" ) $content=get_field("tbl_template","id",$row['idtemplate'],"list_title_module");
	$content1=get_field("tbl_template","id",$row['idtemplate'],"title_module1");
	
	if($lang==2) $mangmd=explode(",",get_field("tbl_template","id",$row['idtemplate'],"title_module1")); 
	elseif($lang==3) $mangmd=explode(",",get_field("tbl_template","id",$row['idtemplate'],"title_module2"));
	else $mangmd=explode(",",get_field("tbl_template","id",$row['idtemplate'],"title_module1")); 
	
    $mangmd_c=explode(",",get_field("tbl_template","id",$row['idtemplate'],"title_module1"));
	
	$mang1=explode(",",get_field("tbl_template","id",$row['idtemplate'],"list_title_module")); 
	//$mang2=explode(",",$content1);
?>

<?php
if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = isset($_POST['name']) ? trim($_POST['name']) : '';
	$link          = isset($_POST['link']) ? trim($_POST['link']) : '';
	$parent        = $_POST['ddCat'];
	
 	
	/*$content=trim($_POST['content']);*/
	$title=trim($_POST['tieude']);
	
	$listquanly = $_POST['tit'];
	$ddk='';
		foreach ($listquanly as $k=>$v){
			$ddk=$ddk.",".$v;
		}
	$ddk=substr($ddk,1);
	$ddk;
	
	$a=explode(",",$ddk);
	foreach($a as $key => $var){ 
		if($var=="") $a[$key]=$mangmd[$key];
	}
	
	foreach ($a as $k=>$v){
		$ddkk=$ddkk.",".$v;
	}
	$ddkk=substr($ddkk,1);
	$ddkk;
	
	
	$content1=$ddkk;
	$title1=trim($_POST['tieude1']);
	
	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "update tbl_keyword set idshop='".$idshop."', parent ='".$parent."', title_module='".$content1."' , last_modified=now() where id='".$oldid."'";
		}else{
			$sql = "insert into tbl_keyword ( idshop , parent , title_module ,date_added, last_modified ) values ('".$idshop."','".$parent."','".$content1."', now() , now()  )";
		}
		if (mysqli_query($conn,$sql)){
			if(empty($_POST['id'])) $oldid = mysqli_insert_id();
			$r = getRecord("tbl_keyword","id=".$oldid);
		
			
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	}
	if ($errMsg == '') {
		$url_direct = url_direct('get',$_REQUEST['act'],'_m','&pageNum='.$_REQUEST['page'].'&code=1');
		echo "<script>window.location='$url_direct'</script>";
	}
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_keyword where id='".$oldid."' and idshop='".$idshop."' ";
		if ($result = mysqli_query($conn,$sql)) {
			$row=mysqli_fetch_array($result);
			$code          = $row['code'];
			$name          = $row['name'];
			$parent        = $row['parent'];
			 
			
			if($row['title_module']==""){ 
				$mang2=get_field("tbl_template","id",$row_shop['idtemplate'],"title_module1");	
			}else{
				$mang2=explode(",",$row['title_module']);
			}
			$date_added    = $row['date_added'];
			$last_modified = $row['last_modified'];
			
		}
	}
}
?>
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Từ ngữ web <small>Tùy chỉnh Từ ngữ web</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li><a href="<?=url_direct('get')?>">Từ ngữ web</a></li>
                <li>Tùy chỉnh</li>
            </ol>
        </div>
    </div>
</div>
<div class="content" style="min-height: 530px;">
	<div class="block">
		<div class="block-content">
			<form method="post" name="frmForm" enctype="multipart/form-data" action="" class="form-horizontal">
                <input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />
                <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
                <input type="hidden" name="page" value="<?=$_REQUEST['page']?>" />

                <div class="form-group">
                    <label class="col-sm-2 control-label">Ngôn ngữ</label>
                    <div class="col-sm-4">
                        <select name="ddCat" class="form-control">
                        	<?php $rl = getRecord("tbl_language","id='$lang' and status=1") ?>
                        	<option value="<?=$rl['id']?>"><?=$rl['name']?></option>
                        </select>
                    </div>
                </div>
                
                <div class="col-sm-6"> 
                    <?php
                        $dem = count($mang1)/2;
                        $i = 1;
                        foreach($mang1 as $key => $var){
                            if($i > $dem) {
                                echo '</div><div class="col-sm-6">';
                                $i = 1;
                            }
                    ?>            
                    <div class="form-group">
                        <label class="col-sm-6 control-label">
                            <?php echo $mangmd_c[$key]; ?>
                        </label>
                        <div class="col-sm-6">
                        	<input type="text" name="tit[]" id="tit[]" class="form-control" value="<?php if($mang2[$key]) echo $mang2[$key];else echo $mangmd[$key];?>" />
                        </div>
                    </div>
                    <?php $i++;} ?>
                </div>                
                <div class="clearfix"></div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4 btn-gr">
                        <button type="submit" name="btnSave" class="btn btn-sm btn-primary">Lưu</button>
                        <button onclick="goBack()" type="button" name="goback" class="btn btn-sm btn-danger">Quay lại</button>
                    </div>
                </div>
            </form>
		</div>
	</div>
</div>