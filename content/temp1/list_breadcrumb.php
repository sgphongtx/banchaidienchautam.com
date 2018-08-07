<div class="container">
    <div class="row">
        <div class="gr-table-cell breadcrumb-list">
            <ul class="clearfix">
                <li class="home">
                    <a href="<?=$linkroot?>"><i class="fa fa-home"></i></a>
                </li> <!-- /home -->
        
                <?php
                if($frame=='products') {
                    if (isset($_GET['danhmuc'])) {
                        $subject = $_GET['danhmuc'];
                        $row = getRecord("tbl_item_category","subject='$subject'");
                        $arr_temp = get_list_parent1('tbl_item_category',$row['parent']);
                        $arr=explode(",",$arr_temp);
                        if(count($arr) > 0) {
                            for($i=0;$i < count($arr); $i++) {
                                $pro = getRecord('tbl_item_category',"status = 1 and lang=$lang and id=".$arr[$i]);
                                if($pro['parent'] != 1 && trim($pro['name'] != '')) {
                ?>
                <li><a href="<?=$linkroot?>/<?=$pro['subject']?>/"><i class="fa fa-chevron-right"></i><?=$pro['name']?></a></li>                    
                <?php 
                                } // endif
                            } // endfor
                        } // endif
                ?>
                <li class="current-p"><a><i class="fa fa-chevron-right"></i><?=$row['name']?></a></li>
                <?php 
                    } else { 
                ?>
                <li class="current-p"><a><i class="fa fa-chevron-right"></i><?php echo module_keyword($mang11,$mang22,"mn_sanpham")?></a></li>
                <?php 
                    } // endif
                } // endif
                ?>
        
                <?php
                if ($frame=='product_detail') {
                    if (isset($_GET['tensanpham'])) {
                        $subject_ite = $_GET['tensanpham'];
                        $row = getRecord('tbl_item',"subject='$subject_ite'");
                        $arr_temp = get_list_parent1('tbl_item_category',$row['parent']);
                        $arr=explode(",",$arr_temp);
                        if(count($arr) > 0) {
                            for($i=0;$i < count($arr); $i++) {
                                $pro = getRecord('tbl_item_category',"status = 1 and lang=$lang and id=".$arr[$i]);
                                if($pro['parent'] != 1 && trim($pro['name'] != '')) {
                ?>
                <li><a href="<?=$linkroot?>/<?=$pro['subject']?>/"><i class="fa fa-chevron-right"></i><?=$pro['name']?></a></li>
                <?php 
                                } // endif
                            } // endfor
                        } // endif
                ?>
                <li class="current-p"><a><i class="fa fa-chevron-right"></i><?=$row['name']?></a></li>
                <?php 
                    } // endif
                } // endif
                ?>
        
                <?php if ($frame == 'viewcart') { ?>
                <li class="current-p"><a><i class="fa fa-chevron-right"></i><?php echo module_keyword($mang11,$mang22,"viewcart");?></a></li>
                <?php } ?>
        
                <?php if ($frame == 'order') { ?>
                <li class="current-p"><a><i class="fa fa-chevron-right"></i><?php echo module_keyword($mang11,$mang22,"order");?></a></li>
                <?php } ?>
        
                <?php if($frame=='contact') { ?>
                <li class="current-p"><a><i class="fa fa-chevron-right"></i><?php echo module_keyword($mang11,$mang22,"mn_contact")?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<style type="text/css">
.gr-table-cell {
    vertical-align: top;
    margin-bottom: 15px;
    padding: 0 15px;
}
.gr-breadcrumb-style-1 .breadcrumb-list {
    background: rgba(55, 68, 86, 0.75) none repeat scroll 0% 0%;
    padding-left: 30px;
}
.gr-table.align-middle .gr-table-cell {
    vertical-align: middle;
}
.clearfix::before {
    display: table;
    content: " ";
    }
.clearfix::after {
    display: table;
    content: " ";
    clear: both;
}
.breadcrumb-list ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.breadcrumb-list ul > li {
    position: relative;
    line-height: 30px;
    float: left;
}
.breadcrumb-list ul > li, .breadcrumb-list ul > li a {
    color: #000;
    font-size: 14px;
    font-weight: lighter;
}
.breadcrumb-list ul > li.home {
    height: 30px;
    line-height: 30px;
    margin-right: 5px;
}
.breadcrumb-list ul > li.home a {
    font-size: 18px;
}
.breadcrumb-list ul > li:not(:last-child):not(.home) {
    padding-right: 5px;
    /* margin-right: 17px; */
}
/* .breadcrumb-list ul > li:not(:last-child):not(.home)::after {
    content: "/";
    position: absolute;
    top: 50%;
    right: 0px;
    bottom: auto;
    left: auto;
    transform: translate(0px, -50%);
} */
.breadcrumb-list ul > li.current-p a {
    color: #01954B;
    cursor: default;
}
.breadcrumb-list ul li .fa {
    margin-right: 5px;
}
.breadcrumb-list ul li:not(.home) .fa {
    font-size: 12px;
}
</style>