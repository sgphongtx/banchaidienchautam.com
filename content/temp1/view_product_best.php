<?php
$news1=get_records("tbl_item_category","status=1 AND idshop='{$idshop}' AND  parent=$parent_l","sort ASC,id DESC"," "," ");
while($row_news1=mysqli_fetch_assoc($news1)){
$parent=getParent("tbl_item_category",$row_news1['id']);
$parent=str_replace(",,", ",", $parent);
$new=get_records("tbl_item","status=1 AND idshop='{$idshop}' and hot=1 AND parent in ({$parent}) ","id DESC","0,5"," ");
if(mysqli_num_rows($new)>0){
?>
<div class="frame_product_mau_gh">
	<h2 class="title_f_p_m_gh">
       
	   <?php echo $row_news1['name']?>
    </h2><!-- End .title_f_m_gh -->
    <div class="main_f_m_gh">
                            
         <div class="main_row_news1" style="text-align:center;">
            <script type="text/javascript">
                $(function(){
                    $('#row_news1').bxSlider({
                        displaySlideQty: 4,
						auto:true,
                        moveSlideQty: 1
                    });
                });
            </script>
            <ul id="row_news1">
            <?php
			$sl=get_field("tbl_module","idshop",$row_shop['id'],"sl4");
			if($sl>0) $sl=$sl;
			else $sl=3;
            $new=get_records("tbl_item","status=1 AND idshop='{$idshop}'","view DESC","0,".$sl,$lang);
            while($row_new=mysqli_fetch_assoc($new)){
            ?>
                <li>
                    <div class="row_news1">
                        <span>
                            <table>
                                <tr>
                                    <td>
                                        <?php
										if($row_new['image']=="") $hinh="web/assets/stylesheet/images/noimage.png";
										else $hinh=$row_new['image'];
										?>
										<a href="chi-tiet/<?php echo $row_new['subject']?>.html" title="<?=$row_new['name']?>">
											<img src="<?php echo $linkroot ;?>/<?php echo $hinh?>" alt="<?=$row_new['name']?>"/>
										</a> 
                                    </td>
                                </tr>
                            </table>
                        </span>
                    </div><!-- End .space_sptb -->
                    <h4>
                            <a href="<?php echo $row_new['subject']?>.html" title=""><?php echo $row_new['name']?></a>
                    </h4>
                    <div class="price_prod_mau_gh" title="<?php echo $row_new['name'];?>">
                        <?php echo getPrice($row_new['price'],$row_new['pricekm']); ?>
                    </div>
                </li>
                <?php }?>                 
            </ul>
            <div class="clear"></div>
        </div>        
    </div><!-- End .main_f_m_gh -->
	<div class="footer_f_p_m_gh"></div>
</div>
<?php } } ?>