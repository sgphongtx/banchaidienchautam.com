<?php
include('../../../../systems/database/database.php');

if(isset($_GET['status']) && isset($_GET['iddonhang']))
{
	if(mysqli_query($conn,"UPDATE `tbl_donhang` SET  `status` =  ".$_GET['status']." WHERE  `tbl_donhang`.`id` =".$_GET['iddonhang']))
	{
	  echo "Cập nhật thành công";
	}
	else
	{
	  echo "Cập nhật không thành công";
	}
}
?>