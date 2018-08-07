<?php 
if(get_field("tbl_module","idshop",$idshop,"id")!="") {
	$m=get_field("tbl_module","idshop",$idshop,"modulearray");
	$m=unserialize($m);
	//print_r($b);
	foreach($m as $key => $var){
		include("content/".$template."/".$key.".php");
      // echo("content/".$template."/".$key.".php");
	}
}else{
	$listmodule1=get_field("tbl_template","id",$row_shop['idtemplate'],"listmodule");
	$listmodule1=explode(",", $listmodule1);
	foreach($listmodule1 as $key => $var){
		include("content/".$template."/".$var.".php");
	}
}
?>