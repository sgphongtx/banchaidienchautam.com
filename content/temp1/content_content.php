<?php /* if($frame=="home" || $frame==""){ ?>
<style> 
.left-sidebar { display: none; }
.right-sidebar { display: none; }
#content-sidebar{width:100%;}
</style>
<?php } */?>
<?php
	$layu=get_field("tbl_module","idshop",$idshop,"layoutarray");
 	if(get_field("tbl_module","idshop",$idshop,"id")!=""){
     	$layu = get_field("tbl_module","idshop",$idshop,"layoutarray");
		$b = get_field("tbl_module","idshop",$idshop,"boxarray");
		$left = get_field("tbl_module","idshop",$idshop,"countleft");
		$b = unserialize($b);
 	}
	$col_left = $col_right = "hidden";
	$col_center = "";
 	if($layu!=1 && $layu!=3)
     	$col_left = " col-md-3";
	if($layu!=2 && $layu!=3)
		$col_right = " col-md-3";
	if($layu==0)
		$col_center = " col-md-6";
	if($layu==1 || $layu==2)
		$col_center = " col-md-9";
	if($layu==3)
		$col_center = " col-md-12";
?>

<main id="content">
	<div id="columns" class="container">
		<?php if($frame=="home" || $frame==""){ include("content/temp1/slider1.php"); }?>
		<div class="row">
         <?php
 		   	if($layu==1 || $layu==3) {}
 		   	else {
         ?>
			<aside>
			   <div id="left-sidebar" class="left-sidebar<?=$col_left?>">
		       	<?php
			       	if (get_field("tbl_module","idshop",$idshop,"id")!="") {
							$i_t=0;
							foreach($b as $key => $var){
			               if($i_t==$left || $left==0) break;
			               else $i_t++;
			               include("content/".$template."/".$key.".php");
			               //echo "content/".$template."/".$key.".php";
			           }
			       	} else {
							$listmodule=get_field("tbl_template","id",$row_shop['idtemplate'],"listname");
							$listmodule=explode(",", $listmodule);
							$tmm=1;
							foreach($listmodule as $key => $var){
			               include("content/".$template."/".$var.".php");
			               if($tmm==8) break;
			               else $tmm++;
			          	}
			       	}
			      ?>
			   </div>
			</aside>
		   <?php } ?>

			<section>
			   <div id="content-sidebar" class="content-sidebar<?=$col_center?>">
			     	<?php include("content/".$template."/processFrame.php");?>
			   </div>
			</section>

		   <?php
		   	if($layu==2 || $layu==3) {}
		   	else {
		   ?>
			<aside>
			   <div id="right-sidebar" class="right-sidebar<?=$col_right?>">
			     	<?php
				     	if(get_field("tbl_module","idshop",$idshop,"id")!="") {
				         $j=1;
				         foreach($b as $key => $var){
				            if($j>$i_t) include("content/".$template."/".$key.".php");
				            else $j++;
				            //echo "content/".$template."/".$key.".php";
				         }
				     	} else {
				         $tmm=1;
				         foreach($listmodule as $key => $var){
				            if($tmm>8) include("content/".$template."/".$var.".php");
				            else $tmm++;
				         }
						}
				   ?>
			   </div>
			</aside>
		   <?php }?>

			<div class="clearfix"></div>
		</div>
		
	</div>

</main>
