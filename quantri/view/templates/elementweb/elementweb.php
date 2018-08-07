<?php 

$queryconfig = mysqli_query($conn,"select * from dm_config where idshop=".$idshop);
$count_new = mysqli_fetch_array($queryconfig);
$comment = 0;

$ghinho = 0;
$tungu = getRecord("tbl_keyword", "idshop='".$idshop.
   "'");

if ($tungu['title_module'] != "") {
   $mang1 = get_field("tbl_template", "id", $row_shop['idtemplate'], "list_title_module");
   $mang2 = $tungu['title_module'];
   if ($mang1 == "") {
      $mang1 = get_field("tbl_template", "id", $row_shop['idtemplate'], "list_title_module");
      $mang2 = get_field("tbl_template", "id", $row_shop['idtemplate'], "title_module1");
   }
} else {
   $mang1 = get_field("tbl_template", "id", $row_shop['idtemplate'], "list_title_module");
   $mang2 = get_field("tbl_template", "id", $row_shop['idtemplate'], "title_module1");
}

$mang11 = explode(",", $mang1);
$mang22 = explode(",", $mang2);

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

function find_module_inlist($name, $list) {
   foreach($list as $key => $var) {
      if ($key == $name)
         if ($bien == 0)
            if ($var == 1 || $list['name'] == 0) return $var;

   }
   return -1;
}

function find_value_inlist($name, $list) {
   $i = 1;
   foreach($list as $key => $var) {
      if ($key == $name) {
         return $i;
      } else $i++;

   }
}

function find_value_inlist2($name, $list) {
   foreach($list as $key => $var) {
      if ($key == $name) return $var;
   }
}

/*---------------------------------------------*/

$id = $idshop;

$sql = "SELECT * FROM tbl_shop WHERE id='{$id}'";
$gt = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($gt);

if ($row['css'] == "") $content = get_field("tbl_template", "id", $row['idtemplate'], "content");
else $content = $row['css'];

$box = get_field("tbl_template", "id", $row['idtemplate'], "listname");
$box = explode(",", $box);
$demaa = count($box);
//print_r($box);
$b = "";
$ghinho_t = 0;
if (get_field("tbl_module", "idshop", $idshop, "id") != "") {
   $b = get_field("tbl_module", "idshop", $idshop, "boxarray");
   $b = unserialize($b);
   /*print_r($b);*/
   $ghinho_t = 1;
   $ghinho = 1;
}

/*----module home*/
$module = get_field("tbl_template", "id", $row['idtemplate'], "listmodule");
$module = explode(",", $module);
$dembb = count($module);

if (get_field("tbl_module", "idshop", $idshop, "id") != "") {
   $c = get_field("tbl_module", "idshop", $idshop, "modulearray");
   $c = unserialize($c);
   /*print_r($c);*/
}

$ttt = getRecord("tbl_module", "idshop='".$idshop."'");
$sl1 = $ttt['sl1'];
$sl2 = $ttt['sl2'];
$sl3 = $ttt['sl3'];
$sl4 = $ttt['sl4'];
$sl5 = $ttt['sl5'];
$sl6 = $ttt['sl6'];
$heso = $ttt['heso'];

$total = get_field("tbl_count", "idshop", $idshop, "total");

?>

<?php
if (isset($_POST['them']) == true) //isset kiem tra submit
{
   $sl1 = trim($_POST['sl1']);
   $sl2 = trim($_POST['sl2']);
   $sl3 = trim($_POST['sl3']);
   $sl4 = trim($_POST['sl4']);
   $sl5 = trim($_POST['sl5']);
   $sl6 = trim($_POST['sl6']);
   $heso = trim($_POST['heso']);
   $total = trim($_POST['total']);
   $comment = $_POST['ckanhien'];

   $arrayboxs = array();
   $arrayboxa = array();
   $arrayboxv = array();
   $arraybox = array();

   for ($i = 0; $i < $demaa; $i++) {
      $j = ($i + 1);
      $t = $_POST['bs'.$j];
      $arrayboxs[$box[$i]] = $t;

   }

   for ($i = 0; $i < $demaa; $i++) {
      $j = ($i + 1);
      $t = $_POST['ba'.$j];
      $arrayboxa[$box[$i]] = $t;
   }

   for ($i = 0; $i < $demaa; $i++) {
      $j = ($i + 1);
      $t = $_POST['bv'.$j];
      $arrayboxv[$box[$i]] = $t;
   }

   for ($i = 0; $i < $demaa; $i++) {
      if ($arrayboxa[$box[$i]] == 1) $arraybox[$box[$i]] = $arrayboxs[$box[$i]];
   }


   $a = array_sort($arraybox, $type = 'asc');

   foreach($a as $key => $var) {
      $a[$key] = $arrayboxv[$key];
   }


   $a = array_sort($a, $type = 'desc');

   $left = 0; // so box ben trai
   foreach($a as $key => $var) {
      if ($a[$key] == 1) $left++;
   }

   //echo "Có ".$left." bên trái";

   /*--- module */

   $arraymodule = array();

   for ($i = 0; $i < $dembb; $i++) {
      $j = ($i + 1);
      $t = $_POST['ms'.$j];
      $arraymodules[$module[$i]] = $t;

   }

   for ($i = 0; $i < $dembb; $i++) {
      $j = ($i + 1);
      $t = $_POST['ma'.$j];
      $arraymodulea[$module[$i]] = $t;

   }

   for ($i = 0; $i < $dembb; $i++) {
      if ($arraymodulea[$module[$i]] == 1) $arraymodule[$module[$i]] = $arraymodules[$module[$i]];
   }

   $b = array_sort($arraymodule, $type = 'asc');
   //print_r($b);

   $coloi = false;
   if ($coloi == FALSE) {
      $chuoimang = serialize($a);
      $chuoimang2 = serialize($b);

      if (get_field("tbl_module", "idshop", $idshop, "id") == "") {
         $arrField = array(
            "idshop" => "'".$idshop."'",
            "boxarray" => "'".$chuoimang."'",
            "countleft" => "'".$left."'",
            "modulearray" => "'".$chuoimang2."'",
            "sl1" => "'".$sl1."'",
            "sl2" => "'".$sl2."'",
            "sl3" => "'".$sl3."'",
            "sl4" => "'".$sl4."'",
            "sl5" => "'".$sl5."'",
            "sl6" => "'".$sl6."'",
            "heso" => "'".$heso."'"
         );
         insert("tbl_module", $arrField);
      } else {
         $arrField = array(
            "boxarray" => "'".$chuoimang."'",
            "countleft" => "'".$left."'",
            "modulearray" => "'".$chuoimang2."'",
            "sl1" => "'".$sl1."'",
            "sl2" => "'".$sl2."'",
            "sl3" => "'".$sl3."'",
            "sl4" => "'".$sl4."'",
            "sl5" => "'".$sl5."'",
            "sl6" => "'".$sl6."'",
            "heso" => "'".$heso."'"
         );
         update("tbl_module", $arrField, "idshop=".$idshop);
      }

      if (get_field("tbl_count", "idshop", $idshop, "id") == "") {
         $arrField = array(
            "total" => "'".$total."'",
            "datenow" => "now()"
         );
         insert("tbl_count", $arrField);
      } else {
         $arrField = array(
            "total" => "'".$total."'",
         );
         update("tbl_count", $arrField, "idshop=".$idshop);
      }

      echo thongbao(url_direct(), $thongbao = 'Bạn vừa cấu hình thành phần của web thành công..!');

   }
}
?>
<div class="content" style="min-height: 530px;">
	<form action="" method="post" accept-charset="utf-8" name="f-module" id="f-module">
		<div class="col-lg-6">
			<div class="block">
				<div class="block-header">
					<h3 class="block-title">Box trái - phải</h3>
				</div><!-- /.block-header -->
				<div class="block-content">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Tên</th>
								<th>Vị trí</th>
								<th>Thứ tự</th>
								<th>Trạng thái</th>
							</tr>
						</thead>
						<tbody>
						<?php
						  	$i=1;
							$dem=count($box);
				          	foreach ($box as $k=>$v){
								$ddk=$ddk.",".$v;
					  	?>
					  		<tr>
					  			<td class="text-left">
					  				<?php if($v=="box_auto") echo "Phần tự soạn thảo";else echo module_keyword($mang11,$mang22,$v); ?>
					  			</td>
					  			<td class="text-left">
					  				<input type="radio" name="bv<?php echo $i;?>" id="bv<?php echo $i;?>" value="1" <?php if($ghinho==1 && find_module_inlist($v,$b)==1) echo 'checked="checked"';elseif($ghinho==0) echo 'checked="checked"';?> />
					  				Trái
					  				<br />
					  				<input type="radio" name="bv<?php echo $i;?>" id="bv<?php echo $i;?>" value="0" <?php if($ghinho==1 && find_module_inlist($v,$b)==0) echo 'checked="checked"';?>  />
					  				Phải
					  			</td>
					  			<td class="text-center">
					  				<input type="text" name="bs<?php echo $i;?>" id="bs<?php echo $i;?>" class="form-control" value="<?php if($ghinho==1 && (find_module_inlist($v,$b)==1 || find_module_inlist($v,$b)==0)) echo find_value_inlist($v,$b);else echo $i;?>" style="width: 70px; text-align: center" />
					  			</td>
					  			<td class="text-left">
					  				<input type="radio" name="ba<?php echo $i;?>" id="ba<?php echo $i;?>" value="1" <?php if($ghinho==1 && find_module_inlist($v,$b)!=-1) echo 'checked="checked"'; elseif($ghinho==0)echo 'checked="checked"'; ?> />
					  				Hiện
					  				<br />
					  				<input type="radio" name="ba<?php echo $i;?>" id="ba<?php echo $i;?>" value="0" <?php if($ghinho==1 && find_module_inlist($v,$b)==-1) echo 'checked="checked"';?>  />
					  				Ẩn
					  			</td>
					  		</tr>
					  	<?php $i++;} ?>
						</tbody>
					</table><!-- /.table -->
				</div><!-- /.block-content -->
			</div>
		</div><!-- /-module box trái - phải -->
		<div class="col-lg-6">
			<div class="block">
				<div class="block-header">
					<h3 class="block-title">Module trang chủ</h3>
				</div><!-- /.block-header -->
				<div class="block-content">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Tên</th>
								<th>Thứ tự</th>
								<th>Trạng thái</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i=1;
	          					foreach ($module as $k=>$v){ 
	          				?>
							<tr>
          					<td class="text-left">
          						<?php if($v=="auto") echo "Phần tự soạn thảo";else echo module_keyword($mang11,$mang22,$v); ?>
          					</td>
          					<td class="text-left">
          						<input type="text" name="ms<?php echo $i;?>" id="ms<?php echo $i;?>" class="form-control" value="<?php if($ghinho==1 && find_module_inlist($v,$c)!="") echo find_value_inlist2($v,$c);else echo $i;?>" style="width: 70px; text-align: center;" />
          					</td>
          					<td class="text-left">
          						<input type="radio" name="ma<?php echo $i;?>" id="ma<?php echo $i;?>" value="1" <?php if($ghinho==1 && find_module_inlist($v,$c)!=-1) echo 'checked="checked"';elseif($ghinho==0)echo 'checked="checked"';?> />
          						Hiện
          						<br />
          						<input type="radio" name="ma<?php echo $i;?>" id="ma<?php echo $i;?>" value="0" <?php if($ghinho==1 && find_module_inlist($v,$c)==-1) echo 'checked="checked"';?>  />
          						Ẩn
          					</td>
							</tr>
	          				<?php $i++;} ?>
						</tbody>
					</table>
				</div><!-- /.block-content -->
			</div>
		</div><!-- /-module trang chủ -->
		<div class="col-lg-6">
			<div class="block">
				<div class="block-header">
					<h3 class="block-title">
						Số lượng sản phẩm - bài viết được hiển thị
					</h3>
				</div><!-- /.block-header -->
				<div class="block-content">
					<table class="table table-hover">
						<tr>
							<td class="text-left">Trang chủ</td>
							<td class="text-left">
								<input type="text" name="sl1" id="sl1" class="form-control" value="<?php if($sl1!="") echo $sl1;else echo "10";?>" style="width: 70px; text-align: center;" />
							</td>
						</tr>
						<tr>
							<td class="text-left">Danh mục sản phẩm</td>
							<td class="text-left">
								<input type="text" name="sl2" id="sl2" class="form-control" value="<?php if($sl2!="") echo $sl2;else echo "10";?>" style="width: 70px; text-align: center;" />
							</td>
						</tr>
						<tr>
							<td class="text-left">Sản phẩm xem nhiều</td>
							<td class="text-left">
								<input type="text" name="sl3" id="sl3" class="form-control" class="form-control" value="<?php if($sl3!="") echo $sl3;else echo "3";?>" style="width: 70px; text-align: center;" />
							</td>
						</tr>
						<tr>
							<td class="text-left">Sản phẩm bán chạy</td>
							<td class="text-left">
								<input type="text" name="sl4" id="sl4" class="form-control" value="<?php if($sl4!="") echo $sl4;else echo "3";?>" style="width: 70px; text-align: center;" />
							</td>
						</tr>
						<tr>
							<td class="text-left">Danh mục tin tức</td>
							<td class="text-left">
								<input type="text" name="sl5" id="sl5" class="form-control" value="<?php if($sl5!="") echo $sl5;else echo "10";?>" style="width: 70px; text-align: center;" />
							</td>
						</tr>
						<tr>
							<td class="text-left">Tin tức mới</td>
							<td class="text-left">
								<input type="text" name="sl6" id="sl6" class="form-control" value="<?php if($sl6!="") echo $sl6;else echo "5";?>" style="width: 70px; text-align: center;" />
							</td>
						</tr>
					</table>
				</div><!-- /.block-content -->
			</div>
		</div><!-- /-Số lượng sản phẩm - bài viết được hiển thị -->
		<div class="col-lg-6">
			<div class="block">
				<div class="block-header">
					<h3 class="block-title">
						Hệ số nhân truy cập web - Tổng lượt truy cập
					</h3>
				</div><!-- /.block-header -->
				<div class="block-content">
					<table class="table table-hover">						
						<tr>
							<td class="text-left">Hệ số nhân truy cập web</td>
							<td class="text-left">
								<input type="text" name="heso" id="heso" class="form-control" value="<?php if($heso!="") echo $heso;else echo "";?>" style="width: 70px; text-align: center;" />
							</td>
						</tr>
						<tr>
							<td class="text-left">Tổng lượt truy cập</td>
							<td class="text-left">
								<input type="text" name="total" id="total" class="form-control" value="<?php if($total!="") echo $total;else echo "0";?>" style="width: 70px; text-align: center;" />
							</td>
						</tr>
					</table>
				</div><!-- /.block-content -->
			</div>
		</div><!-- /-Hệ số nhân truy cập web - Tổng lượt truy cập -->
		<div class="clearfix"></div>
		<div class="col-lg-12 text-center">
			<input type="submit" name="them" class="btn btn-success nut_table" value="Chấp nhận" title="Chấp nhận hoàn thành" />
		</div>
	</form>
</div>