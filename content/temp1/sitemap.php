<style>
    .treeview, .treeview ul { 
    	padding: 0;
    	margin: 0;
    	list-style: none;
    }
    
    .treeview ul {
    	background-color: white;
    	margin-top: 4px;
    }
    .treeview li { 
    	margin: 0;
    	padding: 3px 0pt 3px 16px;
    }
    .treeview li { 
        background: url(images/treeview-default-line.gif) 0 0 no-repeat; 
    }
    .treeview li.last {
        background-position: 0 -1766px;    
    }
    .treeview li a {
        color: #515151;
        font-weight: bold;
        font-family: Tahoma, Arial, Helvetica, sans-serif;
        font-size: 11px;
    }
    .treeview li a:hover {
        color: #f00;
    }
    .treeview .hitarea {
        background: url(images/treeview-default.gif) no-repeat scroll -80px -3px transparent;
        height: 16px;
        width: 16px;
        margin-left: -16px;
        float: left;
        cursor: pointer;
    }
</style>
<div id="sidetree" style="margin-left:50px;">
    <ul id="tree" class="treeview">  
        <!-- li home -->
        <li>
            <div class="hitarea"></div>
        	<a href="" title="Trang chủ"><?php echo module_keyword($mang11,$mang22,"mn_home");?></a> 
        </li>
        <!-- li news and pos=1 -->
        <?
        $cate = get_records("tbl_item_category","status=1 and pos=1 and cate=2 AND idshop='{$idshop}' AND  parent=$parent_l","sort ASC,id DESC"," "," ");
        if($sl = mysqli_num_rows($cate)>0){
        ?>
        <ul>
     		<?php
			    while($row_cate=mysqli_fetch_assoc($cate)){
			        $cate1=get_records("tbl_item_category","status=1 AND cate=2 AND idshop='".$idshop."' AND  parent=".$row_cate['id'],"sort ASC,id DESC"," "," ");
                    $sl1 = mysqli_num_rows($cate1);
			?>	 
            <li class="<? echo $sl1>0?"":"last" ?>">
                <? echo $sl1<=0?'':'<div class="hitarea"></div>'; ?>
            	<a <?php if(trim($row_cate['link']) != '') echo 'target="_blank"'; ?> href="<?php if( $row_cate['link']==""){?><?php echo $row_cate['subject'];?>/<?php }else {echo $row_cate['link'];}?>" title="<?php echo $row_cate['name'];?>"><?php echo $row_cate['name'];?></a>                    
            	<ul>
             		<?php
    				    while($row_cate1=mysqli_fetch_assoc($cate1)){
            				$cate2=get_records("tbl_item_category","status=1 AND cate=2 AND idshop='".$idshop."' AND  parent=".$row_cate1['id'],"sort ASC,id DESC"," "," ");
                            $sl2 = mysqli_num_rows($cate2);
    				?>	 
                    <li class="<? echo $sl2>0?"":"last" ?>">
                        <? echo $sl2<=0?'':'<div class="hitarea"></div>'; ?>
                    	<a <?php if(trim($row_cate1['link']) != '') echo 'target="_blank"'; ?> href="<?php if( $row_cate1['link']==""){?><?php echo $row_cate1['subject'];?>/<?php }else {echo $row_cate1['link'];}?>" title="<?php echo $row_cate1['name'];?>"><?php echo $row_cate1['name'];?></a>
                    	<ul>
                     		<?php
            				    while($row_cate2=mysqli_fetch_assoc($cate2)){
            				        $cate3=get_records("tbl_item_category","status=1 AND cate=2 AND idshop='".$idshop."' AND  parent=".$row_cate2['id'],"sort ASC,id DESC"," "," ");
                                    $sl3 = mysqli_num_rows($cate3);
            				?>	 
                            <li class="<? echo $sl3>0?"":"last" ?>">
                                <? echo $sl3<=0?'':'<div class="hitarea"></div>'; ?>
                            	<a <?php if(trim($row_cate2['link']) != '') echo 'target="_blank"'; ?> href="<?php if( $row_cate2['link']==""){?><?php echo $row_cate2['subject'];?>/<?php }else {echo $row_cate2['link'];}?>" title="<?php echo $row_cate2['name'];?>"><?php echo $row_cate2['name'];?></a>                                	
                            </li>
                   			<?php } ?>	
                        </ul>
                    </li>
           			<?php } ?>	
                </ul>
            </li>
   			<?php } ?>	
        </ul>
        <?php } ?>
        
        <!-- li products -->
        <li>
            <div class="hitarea"></div>
            <a href="view-all/" title="<?php echo module_keyword($mang11,$mang22,"mn_sanpham");?>"><?php echo module_keyword($mang11,$mang22,"mn_sanpham");?></a>
            <?php
				$cate=get_records("tbl_item_category","status=1 AND cate=1 AND idshop='".$idshop."' AND  parent=$parent_l","sort ASC,id DESC"," "," ");
                if($sl = mysqli_num_rows($cate)>0){
            ?>
            <ul>
         		<?php
				    while($row_cate=mysqli_fetch_assoc($cate)){
				        $cate1=get_records("tbl_item_category","status=1 AND cate=1 AND idshop='".$idshop."' AND  parent=".$row_cate['id'],"sort ASC,id DESC"," "," ");
                        $sl1 = mysqli_num_rows($cate1);
				?>	 
                <li class="<? echo $sl1>0?"":"last" ?>">
                    <? echo $sl1<=0?'':'<div class="hitarea"></div>' ?>
                	<a <?php if(trim($row_cate['link']) != '') echo 'target="_blank"'; ?> href="<?php if( $row_cate['link']==""){?><?php echo $row_cate['subject'];?>/<?php }else {echo $row_cate['link'];}?>" title="<?php echo $row_cate['name'];?>"><?php echo $row_cate['name'];?></a>                    
                	<ul>
                 		<?php
        				    while($row_cate1=mysqli_fetch_assoc($cate1)){
                				$cate2=get_records("tbl_item_category","status=1 AND cate=1 AND idshop='".$idshop."' AND  parent=".$row_cate1['id'],"sort ASC,id DESC"," "," ");
                                $sl2 = mysqli_num_rows($cate2);
        				?>	 
                        <li class="<? echo $sl2>0?"":"last" ?>">
                            <? echo $sl2<=0?'':'<div class="hitarea"></div>' ?>
                        	<a <?php if(trim($row_cate1['link']) != '') echo 'target="_blank"'; ?> href="<?php if( $row_cate1['link']==""){?><?php echo $row_cate1['subject'];?>/<?php }else {echo $row_cate1['link'];}?>" title="<?php echo $row_cate1['name'];?>"><?php echo $row_cate1['name'];?></a>
                        	<ul>
                         		<?php
                				    while($row_cate2=mysqli_fetch_assoc($cate2)){
                				        $cate3=get_records("tbl_item_category","status=1 AND cate=1 AND idshop='".$idshop."' AND  parent=".$row_cate2['id'],"sort ASC,id DESC"," "," ");
                                        $sl3 = mysqli_num_rows($cate3);
                				?>	 
                                <li class="<? echo $sl3>0?"":"last" ?>">
                                    <? echo $sl3<=0?'':'<div class="hitarea"></div>' ?>
                                	<a <?php if(trim($row_cate2['link']) != '') echo 'target="_blank"'; ?> href="<?php if( $row_cate2['link']==""){?><?php echo $row_cate2['subject'];?>/<?php }else {echo $row_cate2['link'];}?>" title="<?php echo $row_cate2['name'];?>"><?php echo $row_cate2['name'];?></a>                                	
                                </li>
                       			<?php } ?>	
                            </ul>
                        </li>
               			<?php } ?>	
                    </ul>
                </li>
       			<?php } ?>	
            </ul>
            <?php } ?>
        </li>
        
        <!-- li product and hot=1 -->
        <?php
			$cate=get_records("tbl_item_category","status=1 AND cate=1 AND idshop='".$idshop."' AND  parent=$parent_l and hot=1","sort ASC,id DESC"," "," ");
            if($sl = mysqli_num_rows($cate)>0){
        ?>
        <ul>
     		<?php
			    while($row_cate=mysqli_fetch_assoc($cate)){
			        $cate1=get_records("tbl_item_category","status=1 AND cate=1 AND idshop='".$idshop."' AND  parent=".$row_cate['id'],"sort ASC,id DESC"," "," ");
                    $sl1 = mysqli_num_rows($cate1);
			?>	 
            <li class="<? echo $sl1>0?"":"last" ?>">
                <? echo $sl1<=0?'':'<div class="hitarea"></div>' ?>
            	<a <?php if(trim($row_cate['link']) != '') echo 'target="_blank"'; ?> href="<?php if( $row_cate['link']==""){?><?php echo $row_cate['subject'];?>/<?php }else {echo $row_cate['link'];}?>" title="<?php echo $row_cate['name'];?>"><?php echo $row_cate['name'];?></a>                    
            	<ul>
             		<?php
    				    while($row_cate1=mysqli_fetch_assoc($cate1)){
            				$cate2=get_records("tbl_item_category","status=1 AND cate=1 AND idshop='".$idshop."' AND  parent=".$row_cate1['id'],"sort ASC,id DESC"," "," ");
                            $sl2 = mysqli_num_rows($cate2);
    				?>	 
                    <li class="<? echo $sl2>0?"":"last" ?>">
                        <? echo $sl2<=0?'':'<div class="hitarea"></div>' ?>
                    	<a <?php if(trim($row_cate1['link']) != '') echo 'target="_blank"'; ?> href="<?php if( $row_cate1['link']==""){?><?php echo $row_cate1['subject'];?>/<?php }else {echo $row_cate1['link'];}?>" title="<?php echo $row_cate1['name'];?>"><?php echo $row_cate1['name'];?></a>
                    	<ul>
                     		<?php
            				    while($row_cate2=mysqli_fetch_assoc($cate2)){
            				        $cate3=get_records("tbl_item_category","status=1 AND cate=1 AND idshop='".$idshop."' AND  parent=".$row_cate2['id'],"sort ASC,id DESC"," "," ");
                                    $sl3 = mysqli_num_rows($cate3);
            				?>	 
                            <li class="<? echo $sl3>0?"":"last" ?>">
                                <? echo $sl3<=0?'':'<div class="hitarea"></div>' ?>
                            	<a <?php if(trim($row_cate2['link']) != '') echo 'target="_blank"'; ?> href="<?php if( $row_cate2['link']==""){?><?php echo $row_cate2['subject'];?>/<?php }else {echo $row_cate2['link'];}?>" title="<?php echo $row_cate2['name'];?>"><?php echo $row_cate2['name'];?></a>                                	
                            </li>
                   			<?php } ?>	
                        </ul>
                    </li>
           			<?php } ?>	
                </ul>
            </li>
   			<?php } ?>	
        </ul>
        <?php } ?>
        
        <!-- li news and hot=1 -->
        <?php
			$cate=get_records("tbl_item_category","status=1 AND cate=2 AND idshop='".$idshop."' AND  parent=$parent_l and hot=1","sort ASC,id DESC"," "," ");
            if($sl = mysqli_num_rows($cate)>0){
        ?>
        <ul>
     		<?php
			    while($row_cate=mysqli_fetch_assoc($cate)){
			        $cate1=get_records("tbl_item_category","status=1 AND cate=2 AND idshop='".$idshop."' AND  parent=".$row_cate['id'],"sort ASC,id DESC"," "," ");
                    $sl1 = mysqli_num_rows($cate1);
			?>	 
            <li class="<? echo $sl1>0?"":"last" ?>">
                <? echo $sl1<=0?'':'<div class="hitarea"></div>' ?>
            	<a <?php if(trim($row_cate['link']) != '') echo 'target="_blank"'; ?> href="<?php if( $row_cate['link']==""){?><?php echo $row_cate['subject'];?>/<?php }else {echo $row_cate['link'];}?>" title="<?php echo $row_cate['name'];?>"><?php echo $row_cate['name'];?></a>                    
            	<ul>
             		<?php
    				    while($row_cate1=mysqli_fetch_assoc($cate1)){
            				$cate2=get_records("tbl_item_category","status=1 AND cate=2 AND idshop='".$idshop."' AND  parent=".$row_cate1['id'],"sort ASC,id DESC"," "," ");
                            $sl2 = mysqli_num_rows($cate2);
    				?>	 
                    <li class="<? echo $sl2>0?"":"last" ?>">
                        <? echo $sl2<=0?'':'<div class="hitarea"></div>' ?>
                    	<a <?php if(trim($row_cate1['link']) != '') echo 'target="_blank"'; ?> href="<?php if( $row_cate1['link']==""){?><?php echo $row_cate1['subject'];?>/<?php }else {echo $row_cate1['link'];}?>" title="<?php echo $row_cate1['name'];?>"><?php echo $row_cate1['name'];?></a>
                    	<ul>
                     		<?php
            				    while($row_cate2=mysqli_fetch_assoc($cate2)){
            				        $cate3=get_records("tbl_item_category","status=1 AND cate=2 AND idshop='".$idshop."' AND  parent=".$row_cate2['id'],"sort ASC,id DESC"," "," ");
                                    $sl3 = mysqli_num_rows($cate3);
            				?>	 
                            <li class="<? echo $sl3>0?"":"last" ?>">
                                <? echo $sl3<=0?'':'<div class="hitarea"></div>' ?>
                            	<a <?php if(trim($row_cate2['link']) != '') echo 'target="_blank"'; ?> href="<?php if( $row_cate2['link']==""){?><?php echo $row_cate2['subject'];?>/<?php }else {echo $row_cate2['link'];}?>" title="<?php echo $row_cate2['name'];?>"><?php echo $row_cate2['name'];?></a>                                	
                            </li>
                   			<?php } ?>	
                        </ul>
                    </li>
           			<?php } ?>	
                </ul>
            </li>
   			<?php } ?>	
        </ul>
        <?php } ?>
        
        <!-- li contact -->
        <li class="last" <?php if($frame=="contact") echo 'class="curren"';?> ><a href="lien-he.html" title="<?php echo module_keyword($mang11,$mang22,"mn_contact");?>"><?php echo module_keyword($mang11,$mang22,"mn_contact");?></a></li>
    </ul>
</div>

<script>
    $(document).ready(function(){
        $('.treeview .hitarea').parent().children("ul").hide();
        $('.treeview .hitarea').click(function(){
            $(this).parent().children("ul").toggle(200);
        })
    })
</script>