<?php
    require("../config.php");
    require("../systems/startup.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
    <style type="text/css">
    	.title_tls{color:#333; padding:7px 0;}
    	.price_tls{color:#C00; padding-top:7px;}
    	.tomtat_tls{padding:4px 0 7px 0;}
    	.main_img_tls{text-align:center;}
    	.main_img_tls img{max-width:100%; max-height:550px;}
    	.clear{clear:both; float:none;}
    </style>
</head>

<body>

    <?php
	$idsp = $_GET['idsp'];
	$sql ="SELECT * FROM tbl_item WHERE id='{$idsp}'";
	$tin_ajax=mysqli_query($conn,$sql) or die(mysqli_error());
	$row_tin_ajax=mysqli_fetch_assoc($tin_ajax);
    ?>
    <div class="frame_tooltip">
        <h3 class="title_tls"><?php echo $row_tin_ajax['name'] ?></h3>

        <div class="main_img_tls">
        	<?php if($row_tin_ajax['image']==true){?>
            <img src="<?php echo $path_image.$row_tin_ajax['image'] ?>" alt="<?php echo $row_tin_ajax['name'] ?>"/>
            <?php }?>
        </div><!-- End .main_img_tls -->

        <div class="main_tls">

        	<?php if($row_tin_ajax['price']!=""){?>
        	<div class="price_tls">
                <?php echo getPrice($row_tin_ajax['price'],$row_tin_ajax['pricekm']); ?>
            </div>
            <?php } ?>
            <div class="tomtat_tls">
                <?php echo catchuoi_tuybien(strip_tags(addslashes($row_tin_ajax['detail_short'])),55)?>
            </div>
        </div><!-- End .main_tls -->
    </div><!-- End .frame_tooltip -->

    </body>
</html>