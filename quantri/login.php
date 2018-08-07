<?php
if (isset($_POST['btn-login'])) {
   $username = $_POST['login-username'];
   $password = md5(md5(md5($_POST['login-password'])));

   try {
      $sql = sprintf("SELECT id, username, group_id FROM tbl_users WHERE username='%s' AND password='%s' ", $username, $password);
      $user = mysqli_query($conn,$sql);
      $count_user = mysqli_num_rows($user);
      $row_user = mysqli_fetch_assoc($user);

      if ($count_user > 0) {
         $_SESSION["user"]["id"]        = $row_user['id'];
         $_SESSION["user"]["username"]  = $row_user['username'];
         $_SESSION["user"]["level"]     = $row_user['group_id'];
         //$_SESSION["user"]["is_update"] = $row_user['is_update'];

         if ($_POST['login-remember-me'] && !$_COOKIE[md5("un")] && !$_COOKIE[md5("pw")]) {
            setcookie(md5("un"), $_POST['login-username'], time() + 60*60*24*30*6);
            setcookie(md5("pw"), md5(md5($_POST['login-password'])), time() + 60*60*24*30*6);
         }

         $token = new Csrf(true, false, false);
         header("location:/quantri/{$token->create_link()}");
      } else $error = "Tài khoản hoặc mật khẩu không đúng.";
   } catch (Exception $e) {
      $error = $e;
   }
} elseif ((isset($_COOKIE[md5("un")]) && isset($_COOKIE[md5("pw")]))) {
   try {
      $username     = $_COOKIE[md5("un")];
      $password     = md5($_COOKIE[md5("pw")]);

      $sql = sprintf("SELECT * FROM tbl_users WHERE username='%s' AND password='%s' ", $username, $password);
      $user = mysqli_query($conn,$sql);
      $count_user = mysqli_num_rows($user);
      $row_user = mysqli_fetch_assoc($user);

      if ($count_user > 0) {
         $_SESSION["user"]["id"]        = $row_user['id'];
         $_SESSION["user"]["username"]  = $row_user['username'];
         $_SESSION["user"]["level"]     = $row_user['group_id'];
         //$_SESSION["user"]["is_update"] = $row_user['is_update'];

         // ---------- Watermark Info ---------- //
         $data_array = array();
         $sql = "SELECT image AS image_watermark, wtm_position, wtm_position_ct, wtm_padding, wtm_padding FROM tbl_ad WHERE cate='11'";
         $lst_tmp = mysqli_query($conn,$sql);
         $data_array = mysqli_fetch_assoc($lst_tmp);
         $_SESSION['RF']['watermark'] = $data_array;
         // ---------- Watermark Info ---------- //

         $token = new Csrf(true, false, false); $_GET["act"] = $_GET["act"] ? $_GET["act"] : "home";
         header("location:/quantri/{$token->create_link()}&act=" . $_GET["act"]);
      } else $error = "Tài khoản không tồn tại.";
   } catch (Exception $e) {
      $error = $e;
   }
}
?>
<div class="content overflow-hidden">
   <div class="row">
      <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
         <div class="block block-themed animated fadeIn">
            <div class="tab-content">
               <div class="tab-pane fade in push-30-t push-50 active" id="simple-step1">
                  <div class="block-header bg-primary"> <h3 class="block-title">Đăng nhập hệ thống</h3> </div>
                  <div class="block-content block-content-full block-content-narrow">
                     <h1 class="h2 font-w600 push-30-t push-5"><?=$row_shop['name']?></h1>
                     <p class="help-block animated fadeInDown" style="color: #D26A5C;"> <?php echo $error?> </p>
                     <form class="js-validation-login form-horizontal push-30-t push-50" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                           <div class="col-xs-12">
                              <div class="form-material form-material-primary floating">
                                 <input id="login-username" class="form-control" type="text" name="login-username" />
                                 <label for="login-username">Tên đăng nhập</label>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-xs-12">
                              <div class="form-material form-material-primary floating">
                                 <input id="login-password" class="form-control" type="password" name="login-password" />
                                 <label for="login-password">Mật khẩu</label>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-xs-12">
                              <label class="css-input switch switch-sm switch-primary">
                                 <input type="checkbox" name="login-remember-me" id="login-remember-me" checked />
                                 <span for="login-remember-me"></span> Nhớ trạng thái đăng nhập
                              </label>
                              <a href="?act=reminder_password" title=""> | Quên mật khẩu?</a>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-xs-12 col-sm-6 col-md-5">
                              <button class="btn btn-block btn-primary btn-login" name="btn-login" type="submit">
                                 <i class="si si-login pull-right"></i> Đăng nhập
                              </button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="tab-pane fade push-30-t push-50" id="simple-step2">
                  <div class="block-header bg-primary">
                     <h3 class="block-title">Khôi phục mật khẩu</h3>
                  </div>
                  <div class="block-content block-content-full block-content-narrow">
                     <h1 class="h2 font-w600 push-30-t push-5"><?=$row_shop['name']?></h1>
                     <p class="help-block re text-danger"></p>
                     <form class="js-validation-reminder form-horizontal push-30-t push-50" method="post" novalidate="novalidate" onsubmit="return restore_password(event,1);">
                        <div class="form-group">
                           <div class="col-xs-12">
                              <div class="form-material form-material-primary floating">
                                 <input class="form-control" type="email" id="reminder-email" name="reminder-email">
                                 <label for="reminder-email">Email</label>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-xs-12">
                              <a  href="#simple-step1" data-toggle="tab">Quay về đăng nhập</a>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-xs-12 col-sm-6 col-md-5">
                              <button class="btn btn-block btn-primary" name="sendmail" type="submit"><i class="si si-envelope-open pull-right"></i> Send Mail</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="push-10-t text-center animated fadeInUp">
   <small class="text-muted font-w600"><span class="js-year-copy">2015-<?=date('Y')?></span> &copy; <a href="http://webmau.vn/">Webmau.vn</a></small>
</div>
<script type="text/javascript" src="/public/templates/quantri/plugins/oneui-fw/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/public/templates/quantri/plugins/oneui-fw/js/base_pages_login.js"></script>
<script type="text/javascript">
var busy = false;
function restore_password(event,step){
   var data = {};$(".help-block.re").removeClass("animated fadeInDown").empty();
   data.action = "RESTORE_PASSWORD";data.step = step;data.email = $("[name=reminder-email]").val();
   if(data.email == "" || busy === true) return false;

   $.post("/ajax/ajax.php",data,function(res){
      $(".help-block.re").addClass("animated fadeInDown").text(res.mess);
      if(busy) busy = false;
   },"json")
   .done(function() {console.log('done')})
   .fail(function() {console.log('fail')});

   return false;
}
</script>