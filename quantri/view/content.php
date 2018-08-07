		<div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">

			<?php require_once 'view/left_sidebar.php';?>
			<?php require_once 'view/info_user.php';?>

			<main id="main-container">
				<?php if (($_GET['act']=='home' || $_GET['act']=='') && $_SESSION['user']['level'] != 1 && $_SESSION['user']['is_update']==0) : ?>
				<div class="col-xs-12">
					<div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 15px;">
						<i class="fa fa-exclamation-circle"></i>
					  	Bạn nên thay đổi <a href="<?=url_direct('edit','user')?>" class="alert-link">thông tin &amp; mật khẩu</a> tài khoản quản trị để đảm bảo bảo mật cho trang quản trị.<br/>
					   &nbsp;&nbsp;&nbsp; Việc thay đổi thông tin sẽ giúp bạn dễ quản lý tài khoản khi quên mật khẩu quản trị.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
				</div>
				<?php endif; ?>
			   <?php require_once 'router.php';?>
			</main>

			<footer id="page-footer" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix">
				<div class="pull-right"> </div> 
				<div class="pull-left"> Copyright &copy; 2015. Create by <a href="http://webmau.vn/">Webmau.vn</a> </div>
			</footer>
	 	</div>
	</body>
</html>