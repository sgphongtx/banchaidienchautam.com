<style>
.item_hnn {
    float: left;
    width: 230px;
    height: 240px;
    margin: 19px 19px 10px 19px;
}
.item_hnn img {
    width: 100%;
    height: 150px;
    border: 1px solid rgb(204, 204, 204);
    padding: 3px;
}
.title_hnn {
    display: block;
    font: bold 12px Arial,Helvetica,sans-serif;
    color: rgb(226, 94, 21);
    height: 33px;
    overflow: hidden;
}

</style>

<div class="frame_product_mau_gh">
	<h3 class="title_f_p_m_gh">
		<?php echo module_keyword($mang11,$mang22,"home_news_new");?>
	</h3><!-- End .title_f_p_m_gh -->
    <div class="main_f_p_m_gh same-height">
        <div style="position: relative; display: block;" class="slides_container">
            <ul>
                <?php
    			$new=get_records("tbl_item","status=1 AND cate=2 AND idshop='{$idshop}'","id DESC","0,6",$lang);
    			while($row_new=mysqli_fetch_assoc($new)){
    			?>
                <li class="item_hnn product-item">
                    <a href="<?php echo $linkroot?>/<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>">
                        <img src="<?php echo $path_image;?>/<?php echo $row_new['image']?>" alt="<?php echo $row_new['name']?>" />
                    </a>
                    <a class="title_hnn" href="<?php echo $linkroot?>/<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>">
                        <?php echo $row_new['name']?>
                    </a>
                    <div class="intro-text">
                        <?php echo catchuoi_tuybien($row_new['detail_short'],15);?>
                    </div>
                </li>
                <?php }?>
            </ul>
            <div style="clear:both;"></div>
        </div>
    </div><!-- End .main_f_p_m_gh -->
    <div class="footer_f_p_m_gh"></div>
</div><!-- End .frame_product_mau_gh -->
