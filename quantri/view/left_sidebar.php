<nav id="sidebar">
    <div id="sidebar-scroll">
        <div class="sidebar-content">
            <div class="side-header side-content bg-white-op">
                <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times"></i>
                </button>
                <a class="h5 text-white" href="<?=url_direct()?>">
                    <img src="<?=$row_shop['logo']?>" class="img-responsive" style="max-width: 155px; min-height: 36px" />
                </a>
            </div>
            <div class="side-content">
                <ul class="nav-main">
                    <!-- home -->
                    <li>
                        <a href="<?=url_direct();?>">
                            <i class="si si-speedometer"></i>
                            <span class="sidebar-mini-hide">Quản lý chung</span>
                        </a>
                    </li>
                    <li class="hidden">
                        <a href="#" class="nav-submenu" data-toggle="nav-submenu">
                            <i class="si si-badge"></i>
                            <span class="sidebar-mini-hide">
                                <?php echo get_field("tbl_language","id",$lang,"name");?>
                            </span>
                        </a>
                        <ul>
                            <?php
                            $nlang=get_records("tbl_language","status=1","id ASC"," "," ");
                			while($row_lang=mysqli_fetch_assoc($nlang)):
                			?>
                            <li>
                                <a href="<?=url_direct('get','nlang',null,'&lang='.$row_lang['id'])?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span><?=$row_lang['name']?></span>
                                </a>
                            </li>
                            <?php endwhile; ?>
                        </ul>
                    </li>
                    <!-- layouts -->
                    <li>
                        <a href="#" class="nav-submenu" data-toggle="nav-submenu">
                            <i class="si si-magic-wand"></i>
                            <span class="sidebar-mini-hide">Giao diện</span>
                        </a>
                        <ul>
                            <li>
                                <a href="<?=url_direct('get','layout_web');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Layouts</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url_direct('get','styleweb');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Edit CSS</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url_direct('get','banner');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Banner - Background</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url_direct('get','icons');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Icons</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- manage orders -->
                    <!-- produtcs -->
                    <li>
                        <a href="#" class="nav-submenu" data-toggle="nav-submenu">
                            <i class="si si-bag"></i>
                            <span class="sidebar-mini-hide">Sản phẩm</span>
                        </a>
                        <ul>
                            <li>
                                <a href="<?=url_direct('get','item_category');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Danh mục</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url_direct('get','item');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Sản phẩm</span>
                                </a>
                            </li>
                            <li class="hidden">
                                <a href="<?=url_direct('get','manufacturer');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Thương hiệu</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url_direct('get','manage_orders');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span class="sidebar-mini-hide">Quản lý đơn hàng</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- news -->
                    <li>
                        <a href="#" class="nav-submenu" data-toggle="nav-submenu">
                            <i class="si si-note"></i>
                            <span class="sidebar-mini-hide">Bài viết</span>
                        </a>
                        <ul>
                            <li>
                                <a href="<?=url_direct('get','news_category');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Danh mục</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url_direct('get','news');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Bài viết</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- application -->
                    <li>
                        <a href="#" class="nav-submenu" data-toggle="nav-submenu">
                            <i class="si si-drawer"></i>
                            <span class="sidebar-mini-hide">Tính năng</span>
                        </a>
                        <ul>
                            <?php if ($_SESSION['user']['level']==1) : ?>
                            <li>
                                <a href="<?=url_direct('get','elementweb');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Modules</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?=url_direct('get','slider');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Slide ảnh chạy</span>
                                </a>
                            </li>
                            <li class="hidden">
                                <a href="<?=url_direct('get','adv');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Quảng cáo</span>
                                </a>
                            </li>
                            <li class="hidden">
                                <a href="<?=url_direct('get','support');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Hỗ trợ</span>
                                </a>
                            </li>
                            <li class="hidden">
                                <a href="<?=url_direct('get','partner');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Đối tác</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url_direct('get','video');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Video</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url_direct('get','map');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Bản đồ</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url_direct('get','facebook');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Facebook</span>
                                </a>
                            </li>
                            <li class="hidden">
                                <a href="<?=url_direct('get','link');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Liên kết</span>
                                </a>
                            </li>
                            <li class="hidden">
                                <a href="<?=url_direct('get','document');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Upload tài liệu</span>
                                </a>
                            </li>
                            <li class="hidden">
                                <a href="<?=url_direct('get','email');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Email</span>
                                </a>
                            </li>
                            <?php
                                $row_config = getRecord("dm_config","idshop='$idshop'");
                                if ($row_config['cmt_prod']==1 && $row_config['cmt_dis_style']==0) :
                            ?>
                            <!-- manage comment -->
                            <li>
                                <a href="<?=url_direct('get','manage_comment');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span class="sidebar-mini-hide">Quản lý bình luận</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="hidden">
                                <a href="<?=url_direct('get','image_gallery');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Thư viện ảnh</span>
                                </a>
                            </li>
                            <li class="hidden">
                                <a href="<?=url_direct('get','watermark');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Watermark</span>
                                </a>
                            </li>
                            <li class="hidden">
                                <a href="<?=url_direct('get','multi_lang_trans');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Đa Ngôn ngữ Tự Dịch</span>
                                </a>
                            </li>
                        </ul>
                    </li> 
                     <li class="hidden">
                        <a href="<?=url_direct('get','comment');?>">
                            <i class="si si-speech"></i>
                            <span class="sidebar-mini-hide">Câu hỏi</span>
                        </a>
                    </li>                     
                    <li class="hidden">
                        <a href="<?=url_direct('get','customer');?>">
                            <i class="si si-users"></i>
                            <span>Tài khoản khách hàng</span>
                        </a>
                    </li>
                    <!-- config website -->
                    <li>
                        <a href="<?=url_direct('get','auto');?>">
                            <i class="si si-doc"></i>
                            <span class="sidebar-mini-hide">Tự soạn thảo</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=url_direct('get','footer');?>">
                            <i class="si si-doc"></i>
                            <span class="sidebar-mini-hide">Thông tin footer</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=url_direct('get','contact');?>">
                            <i class="si si-doc"></i>
                            <span class="sidebar-mini-hide">Thông tin trang liên hệ</span>
                        </a>
                    </li>
                    <li>
                        <a class="iframe-btn-mnl" href="../filemanager/dialog.php?type=0">
                            <i class="si si-speech"></i>
                            <span class="sidebar-mini-hide">Image, Media</span>
                        </a>
                        <script type="text/javascript">
                            $(function() {
                                $('.iframe-btn-mnl').fancybox({
                                    'width'   : 880,
                                    'height'  : 570,
                                    'type'    : 'iframe',
                                    'autoScale'   : false
                                });
                            });
                        </script>
                    </li>
                    <li>
                        <a href="#" class="nav-submenu" data-toggle="nav-submenu">
                            <i class="si si-settings"></i>
                            <span class="sidebar-settings">Cấu hình website</span>
                        </a>
                        <ul>
                            <li>
                                <a href="<?=url_direct('get','config_shop');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Cài đặt chung</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url_direct('get','language');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Ngôn ngữ</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url_direct('get','keyword');?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span>Từ ngữ web</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- end .nav-main -->
            </div>
            <!-- end .side-content -->
        </div>
        <!-- end .sidebar-content -->
    </div>
    <!-- end #sidebar-scroll -->
</nav>

<script type="text/javascript">
window.$_GET = {};
if (document.location.toString().indexOf('?') !== -1) {
   var query = document.location.toString().replace(/^.*?\?/, '').replace(/#.*$/, '').split('&');
   for (var i = 0, l = query.length; i < l; i++) {
      var aux = decodeURIComponent(query[i]).split('=');
      $_GET[aux[0]] = aux[1];
   }
}
$el_active = $("#sidebar .nav-main li a[href$=" + $_GET["act"] + "]");
$el_active.addClass("active");
if (!$el_active.parent().parent().hasClass("nav-main")) $el_active.parent().parent().parent().addClass("open");
</script>
