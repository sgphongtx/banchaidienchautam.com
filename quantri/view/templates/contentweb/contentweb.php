<?php

	$ghinho = 0;
	$tungu = getRecord("tbl_keyword","idshop='".$idshop."'");
	if ($tungu['title_module'] != "") {

		$mang1 = get_field("tbl_template","id",$row_shop['idtemplate'],"list_title_module");
		$mang2 = $tungu['title_module'];

		$ghinho = 1;

	} else {

		$mang1 = get_field("tbl_template","id",$row_shop['idtemplate'],"list_title_module");
		$mang2 = get_field("tbl_template","id",$row_shop['idtemplate'],"title_module1");

	}
 
	$mang11=explode(",", $mang1);
	$mang22=explode(",", $mang2);

	
	function array_sort($array, $type = 'asc') {
	   $result = array();
	   foreach($array as $var => $val) {
	      $set = false;
	      foreach($result as $var2 => $val2) {
	         if ($set == false) {
	            if ($val > $val2 && $type == 'desc' || $val < $val2 && $type == 'asc') {
	               $temp = array();
	               foreach($result as $var3 => $val3) {
	                  if ($var3 == $var2) $set = true;
	                  if ($set) {
	                     $temp[$var3] = $val3;
	                     unset($result[$var3]);
	                  }
	               }
	               $result[$var] = $val;
	               foreach($temp as $var3 => $val3) {
	                  $result[$var3] = $val3;
	               }
	            }
	         }
	      }
	      if (!$set) {
	         $result[$var] = $val;
	      }
	   }
	   return $result;
	}


	function find_module_inlist($name,$list) {
		foreach ($list as $key => $var) {
			if ($key==$name) 
				if ($bien==0)
					if ($var==1 || $list['name']==0)  
						return  $var;
		}
		return 5;
	}

	function find_value_inlist($name,$list) {
		$i=1;
		foreach ($list as $key => $var) {
			if ($key==$name) 
				return $i;
			else 
				$i++;
		}
	}

	function find_value_inlist2($name,$list) {
		foreach ($list as $key => $var) {
			if ($key==$name)
				return $var;
		}
	}

	/*---------------------------------------------*/

	$id = $idshop;

	$sql = "SELECT * FROM tbl_shop WHERE id='{$id}'";
	$gt  = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($gt);

	$box   = get_field("tbl_template","id",$row['idtemplate'],"listname");
	$box   = explode(",", $box);
	$demaa = count($box);

	// echo "<pre>";
	// print_r($box);
	// echo "</pre>";

	$b = "";
	$ghinho_t = 0;


	/*----module home*/
	$module = get_field("tbl_template","id",$row['idtemplate'],"listcontent");
	$module = explode(",", $module);
	$dembb  = count($module);

	if (get_field("tbl_module","idshop",$idshop,"id") != "") {
		$c = get_field("tbl_module","idshop",$idshop,"contentarray");
		if ($c == "") $ghinho = 0;
		else $ghinho = 1;
		$c = unserialize($c);

		// echo "<pre>";
		// print_r($c);
		// echo "</pre>";		

	} else $ghinho = 0;

?>

<?php
	//isset kiem tra submit
	if (isset($_POST['them'])==true) {
		$menu = trim($_POST['mamahide']);
		$daymanhinh = trim($_POST['mamahide1']);

		/*--- module */

		$arraymodule=array();

		for ($i = 0; $i < $dembb; $i++) {
			$j = ($i+1);
			$t = $_POST['ms'.$j];
			$arraymodules[$module[$i]] = $t;

		}

		for ($i = 0; $i < $dembb; $i++) {
			$j = ($i+1);
			$t = $_POST['ma'.$j];
			$arraymodulea[$module[$i]] = $t;

		}

		for ($i = 0; $i < $dembb; $i++) {
			if ($arraymodulea[$module[$i]] == 1)
				$arraymodule[$module[$i]] = $arraymodules[$module[$i]];
		}

		$b = array_sort($arraymodule, $type='asc');
		// echo "<pre>";
		// print_r($b);
		// echo "</pre>";

		$coloi = false;
		if ($coloi == FALSE)
		{
			$chuoimang2 = serialize($b);

			$arrField = array(
				"contentarray"      => "'".$chuoimang2."'"
			);

			update("tbl_module",$arrField,"idshop=".$idshop);
			$query1 = mysqli_query($conn,"select * from dm_config where idshop=".$idshop);
			$row1 = mysqli_num_rows($query1);
			if($row1 > 0)
        	{
            if(mysqli_query($conn,"UPDATE `dm_config` SET `menu_top` = '".$menu."' WHERE idshop=".$idshop))
             	$kiemtra ++;
            if(mysqli_query($conn,"UPDATE `dm_config` SET `menu_full` = '".$daymanhinh."' WHERE idshop=".$idshop))
             	$kiemtra ++;
        	}
        	else
        	{
            if(mysqli_query($conn,"INSERT INTO `dm_config` (`menu_top`, `idshop`) VALUES ('".$menu."', ".$idshop.")"))
            {
             	$kiemtra ++;
            }
            if(mysqli_query($conn,"INSERT INTO `dm_config` (`menu_full`, `idshop`) VALUES ('".$daymanhinh."', ".$idshop.")"))
            {
             	$kiemtra ++;
            }
        	}
			echo thongbao(url_direct(),$thongbao='Bạn vừa cấu hình bố cục web thành công..!');
		}
	}
?>
<div class="content" style="min-height: 530px;">
   <form action="" method="post" accept-charset="utf-8" name="f-contentw" id="f-contentw">
      <div class="block">
         <div class="block-header">
            <h3 class="block-title">Bố cục trang</h3>
         </div>
         <div class="block-content">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th>Tên</th>
                     <th>Thứ tự</th>
                     <th>Ẩn/Hiện</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $i=1; foreach ($module as $k=>$v){ ?>
                  <tr>
                     <td class="text-left">
                        <?php echo module_keyword($mang11,$mang22,$v); ?>
                     </td>
                     <td class="text-left">
                        <input type="text" name="ms<?php echo $i;?>" id="ms<?php echo $i;?>" value="<?php if($ghinho==1 && find_module_inlist($v,$c)!=" ") echo find_value_inlist2($v,$c);else echo $i;?>" class="form-control" style="width: 70px; text-align: center" />
                     </td>
                     <td class="text-left">
                        <input type="radio" name="ma<?php echo $i;?>" id="ma<?php echo $i;?>" value="1" <?php if($ghinho==1 && find_module_inlist($v,$c)!=5) echo 'checked="checked"';elseif($ghinho==0)echo 'checked="checked"';?> /> Hiện
                        <input type="radio" name="ma<?php echo $i;?>" id="ma<?php echo $i;?>" value="0" <?php if($ghinho==1 && find_module_inlist($v,$c)==5) echo 'checked="checked"';?> /> Ẩn
                     </td>
                  </tr>
                  <?php $i++;} ?>

                  <?/*<tr>
							<?php
								$show = 0;
								$result = mysqli_query($conn,"select * from dm_config where idshop=".$idshop);
								if(mysqli_num_rows($result) > 0) {
									$row = mysqli_fetch_array($result);
									$show = $row['value'];
								}
							?>
							<td>Menu hiển thị ở đầu trang</td>
							<td>&nbsp;</td>
							<td>
								<input type="radio" value="1" name="mamahide" <?php if($show == 1) echo 'checked="checked"'; ?> /> Có
								<input type="radio" value="0" name="mamahide" <?php if($show == 0) echo 'checked="checked"'; ?>  /> Không 
							</td>
						</tr>*/?>

                  <tr>
                     <td colspan="3" class="text-center">
                        <input type="submit" name="them" class="btn btn-success nut_table" value="Chấp nhận" title="Chấp nhận hoàn thành" />
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </form>
</div>