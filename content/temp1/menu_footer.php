
<div class="menu_footer">

    
        <span>
        	<a href="" title="<?php echo module_keyword($mang11,$mang22,"mn_home");?>"><?php echo module_keyword($mang11,$mang22,"mn_home");?></a>    
        </span>
        <span>|</span>  
        
         <?php
        $news=get_records("tbl_item_category","status=1 and cate=2 AND idshop='{$idshop}' AND  parent=$parent_l ","sort ASC,id DESC"," "," ");
        while($row_news=mysqli_fetch_assoc($news)){
        ?>
        <span>
        	<a  href="<?php if( $row_news['link']==""){?><?php echo $row_news['subject'];?>/<?php }else {echo $row_news['link'];}?>" title=""><?php echo $row_news['name'];?></a>  
        </span>
        <span>|</span>  
		<?php }?>
        
        
        <span><a href="lien-he.html" title="<?php echo module_keyword($mang11,$mang22,"mn_contact");?>"><?php echo module_keyword($mang11,$mang22,"mn_contact");?></a></span>

</div><!-- End .menu_mau_gh -->