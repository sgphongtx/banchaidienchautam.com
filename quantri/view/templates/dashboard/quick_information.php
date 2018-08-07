<!--**** product information ****-->
<div class="col-sm-3">
    <div class="dash-tile dash-tile-leaf animated flipInX">
        <div class="dash-tile-header">
            <div class="dash-tile-options">
                <div class="btn-group">
                    <a href="javascript:void(0)" class="btn btn-default" title=""><i class="fa fa-bar-chart-o"></i></a>
                </div>
            </div>
            Sản phẩm
        </div>
        <div class="dash-tile-icon"><i class="fa fa-archive"></i></div>
        <div class="dash-tile-text">
            <div class="w-meta-info">
                <span class="w-meta-title">Tổng số danh mục</span>
                <span class="w-meta-value number-animate">
                    <?php echo countRecord("tbl_item_category","cate=1 and idshop=".$idshop);?>
                </span>
            </div>
            <div class="w-meta-info">
                <span class="w-meta-title">Tổng số sản phẩm</span>
                <span class="w-meta-value number-animate">
                    <?php echo countRecord("tbl_item","cate=1 and idshop=".$idshop);?>
                </span>
            </div>
        </div>
    </div>
</div>

<!--**** news information ****-->
<div class="col-sm-3">
    <div class="dash-tile dash-tile-ocean animated flipInX">
        <div class="dash-tile-header">
            <div class="dash-tile-options">
                <div class="btn-group">
                    <a href="javascript:void(0)" class="btn btn-default" title=""><i class="fa fa-bar-chart-o"></i></a>
                </div>
            </div>
            Tin tức
        </div>
        <div class="dash-tile-icon"><i class="fa fa-newspaper-o"></i></div>
        <div class="dash-tile-text">
            <div class="w-meta-info">
                <span class="w-meta-title">Tổng số danh mục</span>
                <span class="w-meta-value number-animate">
                    <?php echo countRecord("tbl_item_category","cate=2 and idshop=".$idshop);?>
                </span>
            </div>
            <div class="w-meta-info">
                <span class="w-meta-title">Tổng số tin tức</span>
                <span class="w-meta-value number-animate">
                    <?php echo countRecord("tbl_item","cate=2 and idshop=".$idshop);?>
                </span>
            </div>
        </div>
    </div>
</div>

<!--**** orders information ****-->
<div class="col-sm-3">
    <div class="dash-tile dash-tile-flower animated flipInX">
        <div class="dash-tile-header">
            <div class="dash-tile-options">
                <div class="btn-group">
                    <a href="javascript:void(0)" class="btn btn-default" title=""><i class="fa fa-bar-chart-o"></i></a>
                </div>
            </div>
            Đơn hàng
        </div>
        <div class="dash-tile-icon"><i class="fa fa-shopping-cart"></i></div>
        <div class="dash-tile-text">
            <div class="w-meta-info">
                <span class="w-meta-title">Tổng đơn hàng</span>
                <span class="w-meta-value number-animate">
                    0
                </span>
            </div>
            <div class="w-meta-info">
                <span class="w-meta-title">Hoàn thành</span>
                <span class="w-meta-value number-animate">
                    <?php echo countRecord("tbl_donhang"," idshop=".$idshop." and status=7");?>
                </span>
            </div>
        </div>
    </div>
</div>

<!--**** others information ****-->
<div class="col-sm-3">
    <div class="dash-tile dash-tile-balloon animated flipInX">
        <div class="dash-tile-header">
            <div class="dash-tile-options">
                <div class="btn-group">
                    <a href="javascript:void(0)" class="btn btn-default" title=""><i class="fa fa-bar-chart-o"></i></a>
                </div>
            </div>
            Khác
        </div>
        <div class="user">
        <div class="dash-tile-icon"><i class="fa fa-users"></i></div>
            <div class="dash-tile-text">
                <div class="w-meta-info">
                    <span class="w-meta-title">Thành viên</span>
                    <span class="w-meta-value number-animate">
                        <?php $dh= countRecord("tbl_customer_shop"," idshop=".$idshop);if($dh>0) echo $dh;else echo "0";?>
                    </span>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="email">
            <div class="dash-tile-icon"><i class="fa fa-envelope"></i></div>
            <div class="dash-tile-text">
                <div class="w-meta-info">
                    <span class="w-meta-title">Email khuyến mãi</span>
                    <span class="w-meta-value number-animate">
                        0
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ***** style css ***** -->
<style type="text/css">
.dash-tile {
    min-height: 190px;
    background-color: #E9E9E9;
    margin: 0px 0px 20px;
    padding: 0px 20px;
}
.dash-tile-ocean {
    background-color: #3991DB;
}
.dash-tile-leaf {
    background-color: #C2DB39;
}
.dash-tile-flower {
    background-color: #9139DB;
}
.dash-tile-balloon {
    background-color: #F76C51;
}
.dash-tile-header {
    margin: 0px -20px;
    padding: 0px 4px 0px 7px;
    min-height: 38px;
    line-height: 45px;
    font-weight: 700;
    border-bottom: 2px solid #DDD;
    background-color: #EEE;
}
.dash-tile-balloon .dash-tile-header, .dash-tile-flower .dash-tile-header, .dash-tile-leaf .dash-tile-header, .dash-tile-ocean .dash-tile-header {
    border-bottom: 2px solid #F9F9F9;
    background-color: #EEE;
    opacity: 0.75;
}
.dash-tile-options {
    float: right;
    height: 38px;
    line-height: 41px;
}
.dash-tile-icon, .dash-tile-text {
    line-height: normal;
    color: #FFF;
}
.dash-tile-icon {
    float: left;
    padding: 40px 20px 0px 0px;
    font-size: 48px;
    text-align: left;
}
.dash-tile-text {
    padding-top: 20px;
}
.user .dash-tile-icon, .email .dash-tile-icon {
    padding-top: 10px;
    font-size: 40px;
}
.user .dash-tile-text, .email .dash-tile-text {
    padding-top: 10px;
}
.w-meta-info > span {
    display: block;
    text-align: center;
    font-weight: 700;
}
.w-meta-title {
    color: #FFF;
    text-shadow: 0px 1px 0px rgba(0, 0, 0, 0.2);
    font-size: 14px;
}
.w-meta-value {
    font-size: 28px;
}
</style>