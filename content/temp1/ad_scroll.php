<div id="floating_banner_left">
    <div id="floating_banner_left_content">
    	<?php
            $rstin=get_records("tbl_ad","status=1 and cate=1 AND idshop='{$idshop}'"," "," "," ");
            while($row_quangcaoleft=mysqli_fetch_assoc($rstin)) :
            	$k=$row_quangcaoleft['image'];
            	$GT = explode(".",$k);
            	$ten=$GT[0];
            	$kieu=$GT[1];
            	if($kieu=='swf' || $kieu=='SWF') :
            	   $chuoi = explode("-",$row_quangcaoleft['ad_info']);
    	?>
    	<a href="<?php echo $row_quangcaoleft['link'] ?>" title="<?php echo $row_quangcaoleft['ten'] ?>" target="_blank">
    		<object width="<?php echo $chuoi['0']?>" height="<?php echo $chuoi['1']?>" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000">
    			<param value="sameDomain" name="allowScriptAccess" />
    			<param value="<?php echo $path_image; ?>/<?php echo $row_quangcaoleft['image']?>" name="movie" />
    			<param value="best" name="quality" />
    			<param value="transparent" name="wmode" />
    			<embed width="<?php echo $chuoi['0']?>" height="<?php echo $chuoi['1']?>" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowscriptaccess="sameDomain" name="tta" wmode="transparent" quality="best" src="<?php echo $linkroot ;?>/<?php echo $row_quangcaoleft['image']?>" />
    		</object>
    	</a>
    	<?php else : ?>
    	<a class="qcc1" href="<?php echo $row_quangcaoleft['link']?>" title="<?php echo $row_quangcaoleft['name']?>" target="_blank">
    		<img  src="<?php echo $path_image; ?>/<?php echo $row_quangcaoleft['image']?>" alt="<?=$row_quangcaoleft['name']?>" />
    	</a>
        <?php 
                endif; 
            endwhile; 
        ?>
    </div>
</div>

<div id="floating_banner_right">
	<div id="floating_banner_right_content">
        <?php
            $rstin=get_records("tbl_ad","status=1 and cate=2 AND idshop='{$idshop}'"," "," "," ");
            while($row_quangcaoleft=mysqli_fetch_assoc($rstin)) :
            	$k=$row_quangcaoleft['image'];
            	$GT = explode(".",$k);
            	$ten=$GT[0];
            	$kieu=$GT[1];
            	if($kieu=='swf' || $kieu=='SWF') :
            	   $chuoi = explode("-",$row_quangcaoleft['ad_info']);
    	?>
    	<a href="<?php echo $row_quangcaoleft['link'] ?>" title="<?php echo $row_quangcaoleft['name'] ?>" target="_blank">
    		<object width="<?php echo $chuoi['0']?>" height="<?php echo $chuoi['1']?>" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000">
    			<param value="sameDomain" name="allowScriptAccess" />
    			<param value="<?php echo $path_image; ?>/<?php echo $row_quangcaoleft['image']?>" name="movie" />
    			<param value="best" name="quality" />
    			<param value="transparent" name="wmode" />
    			<embed width="<?php echo $chuoi['0']?>" height="<?php echo $chuoi['1']?>" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowscriptaccess="sameDomain" name="tta" wmode="transparent" quality="best" src="<?php echo $linkroot ;?>/<?php echo $row_quangcaoleft['image']?>" />
    		</object>
    	</a>
    	<?php else : ?>
    	<a class="qcc2" href="<?php echo $row_quangcaoleft['link']?>" title="<?php echo $row_quangcaoleft['name']?>" target="_blank">
    		<img  src="<?php echo $path_image; ?>/<?php echo $row_quangcaoleft['image']?>" alt="<?php echo $row_quangcaoleft['name']?>" />
    	</a>
        <?php 
                endif; 
            endwhile; 
        ?>
    </div>
</div>

<script type="text/javascript">
	pepsi_floating_init();
</script>