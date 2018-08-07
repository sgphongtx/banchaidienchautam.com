<?php 
if(!shoppermiss ($row_shop['permiss'],6)) header("Location:".$linkroot."/quantri/");
$ttt=getRecord("tbl_module","idshop='".$idshop."'");

$layoutarray=$ttt['layoutarray'];

if($ttt['id']=="") {
	// tao mot cau hinh module co ban
	$arrField = array(
		"idshop"          => "'".$idshop."'",
		"boxarray"        => "'".$chuoimang."'",
		"countleft"       => "'".$left."'",
		"modulearray"     => "'".$chuoimang2."'",
		"sl1"             => "'".$sl1."'",
		"sl2"             => "'".$sl2."'",
		"sl3"             => "'".$sl3."'",
		"sl4"             => "'".$sl5."'",
		"heso"             => "'".$heso."'"
	
	); 
	insert("tbl_module",$arrField);
	$ttt=getRecord("tbl_module","idshop='".$idshop."'");
	$layoutarray=$ttt['layoutarray'];
}


?>
<?php 
if (isset($_POST['them'])==true)//isset kiem tra submit
	{
		$khung=trim($_POST['khung']);
	
		
		$coloi=false;
		if($coloi==FALSE) 
		{			
         // https://docs.google.com/spreadsheet/ccc?key=0AvD4DJp688U_dDVFMVZyYjVuMFJZZXZSb1czMkotT2c&usp=drive_web#gid=15
         $arrField = array(
         	"layoutarray"      => "'".$khung."'"
         );  
         
         update("tbl_module",$arrField,"idshop='".$idshop."'");
         
         echo thongbao(url_direct(),$thongbao='Bạn vừa cấu hình khung web thành công..!');
			
		}
	}
?>
<div class="content" style="min-height:530px;">
    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">Kiểu hiển thị</label>
            <div class="col-sm-3">
                <select name="khung" class="form-control">
                    <option value="0" <?php if($layoutarlayoutarrayray==0) echo 'selected="selected"'?> > Hiện 3 cột</option>
                    <option value="1" <?php if($layoutarray==1) echo 'selected="selected"'?> > Ẩn cột trái</option>
                    <option value="2" <?php if($layoutarray==2) echo 'selected="selected"'?> > Ẩn cột phải</option>
                    <option value="3" <?php if($layoutarray==3) echo 'selected="selected"'?> > Ẩn cột trái và cột phải</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4 btn-gr">
                <button type="submit" name="them" class="btn btn-default">Chấp nhận</button>
                <button onclick="goBack()" type="button" name="goback" class="btn btn-default">Quay lại</button>
            </div>
        </div>
    </form>
</div>
 
