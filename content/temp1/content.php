<?php if($frame=='' || $frame=='home' || $frame=='contact') {?>
<div class="hidden">
   <h1><?=$row_shop['name']?></h1>
   <h2><?=$row_shop['title']?></h2>
   <h3><?=$row_shop['description']?></h3>
</div>
<?php } ?>
<div id="wrapper" style="position:relative;">
	<?php
    if(get_field("tbl_module","idshop",$idshop,"id")!="" && get_field("tbl_module","idshop",$idshop,"contentarray")!="" ) {
        $layout=get_field("tbl_module","idshop",$idshop,"contentarray");
        $layout=unserialize($layout);
        //print_r($b);
        foreach($layout as $key => $var){
            include("content/".$template."/".$key.".php");
            // echo("content/".$template."/".$key.".php");
        }
    }else{
        $listmodule1=get_field("tbl_template","id",$row_shop['idtemplate'],"listcontent");
        $listmodule1=explode(",", $listmodule1);
        foreach($listmodule1 as $key => $var){
            include("content/".$template."/".$var.".php");
        }
    }
    ?>
</div>
<?php if($seo['button'] == 1) include ("content/".$template."/box_social.php");?>
<?php if($row_config['adv_scroll'] != 0) include("content/".$template."/ad_scroll.php");?>
<?php
    if (count_record("tbl_ad","cate=3 and status=1","","","") > 0)
        include("content/ad_footer.php");
?>

<?php if($frame=="" || $frame=="home")
	include('content/'.$template.'/popup_adv.php');
?>
<?php include('content/scripts.php'); ?>