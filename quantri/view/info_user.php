<header id="header-navbar" class="content-mini content-mini-full">
    <ul class="nav-header pull-right">
        <li>
            <div class="btn-group">
                <button class="btn btn-default btn-image">
                    <img src="images/no-avatar.png" alt="avatar" />
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li> <a href="<?=url_direct('edit','user')?>" title=""> <i class="si si-user pull-right"></i> Thông tin cá nhân </a>
                    </li>
                    <li> <a href="?act=logout" title=""> <i class="si si-logout pull-right"></i> Thoát </a> 
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    
    <ul class="nav-header pull-left">
        <li class="hidden-md hidden-lg">
            <button class="btn btn-default" data-toggle="layout" data-action="sidebar_toggle" type="button">
                <i class="fa fa-navicon"></i>
            </button>
        </li>
        <li class="hidden-xs hidden-sm">
            <button class="btn btn-default" data-toggle="layout" data-action="sidebar_mini_toggle" type="button">
                <i class="fa fa-ellipsis-v"></i>
            </button>
        </li>
        <li class="quick-login-website">
            <a class="btn btn-info" href="/" target="_blank"> Truy cập nhanh website <i class="fa fa-external-link"></i> </a>
        </li>
    </ul>
</header>
<style>.quick-login-website a {color: #FFF}</style>