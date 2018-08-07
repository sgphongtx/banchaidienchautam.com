 
 <?php
 //if(!shoppermiss ($row_shop['permiss'],2)) header("Location:".$linkroot."/quantri/"); 
$id=$idshop;

$sql="SELECT * FROM tbl_module WHERE idshop='{$id}'";
$gt=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($gt); 
if (isset($_POST['them'])==true)//isset kiem tra submit
	{
		
		$listquanly = $_POST['cauhinh'];
		$ddk='';
			foreach ($listquanly as $k=>$v){
				$ddk=$ddk.",".$v;
			}
		$ddk=substr($ddk,1);
		$ddk; 
		
		if($ddk=="") $coloi=true;
		
		$coloi=false;
		if($coloi==FALSE) 
		{	
			$chuoimang=serialize($a);
			$chuoimang2=serialize($b);
			
			if(get_field("tbl_module","idshop",$idshop,"id")!=""){
				$arrField = array(
				"listnation"        => "'".$ddk."'"
				);  
				update("tbl_module",$arrField,"idshop=".$idshop);
			}
			
					
			echo thongbao(url_direct(),$thongbao='Bạn vừa cấu hình ngôn ngữ của module ngôn ngữ web thành công..!');
			
		}
	}
?>
<div class="cauhinh_tt" style=" height:530px;">
<form action="" method="post" enctype="multipart/form-data" name=formdk id=formdk>
 <table>
    <tr>
      <th width="30">&nbsp;</th>
      <th width="131">&nbsp;</th>
      <td width="800">&nbsp;</td>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>List quốc gia</th>
      <td>
      <div class="tinh" style="width:800px;">
        <?php
     
            $lap_quyen=get_records('tbl_nation'," ",'name ASC',' ',' ');
            while ($row_lap_quyen=mysqli_fetch_assoc($lap_quyen)){
        ?>  
        
            <p style="width:150px; float:left;"><input <?php if(char_in_list($row['listnation'],$row_lap_quyen['id'])){ ?> checked="checked" <?php } ?> name="cauhinh[]" class="check_md" type="checkbox" value="<?php echo $row_lap_quyen['id'] ?>" />
            <?php echo $row_lap_quyen['name'] ?> </p>
        <?php 
            }
          
          ?> 
      </div>
      </td>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <td align="center"> <input type="submit" name="them" class="nut_table" value="Chấp nhận" title="Chấp nhận hoàn thành "  style="z-index:9999;"/></td>
    </tr>
 </table>
</form>
</div>
 
