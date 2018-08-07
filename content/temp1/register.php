<?php 
   if (isset($_SESSION['kh_shop_login_id'])) header('Location:'.$linkroot);
   else {
?>
<div class="widget widget-static-block bg-white">
   <div class="register-wrap space-base">
      <div class="block-title">
         <div class="h3"><?=module_keyword($mang11, $mang22, 'register')?></div>
      </div>
      <div class="block-content">
         <?php if ($_REQUEST['code']==1) : ?>
         <div class="register-result text-center">
            <p class="h2">Đăng ký tài khoản thành công</p>
            <p><a href="/sua-thong-tin.html" class="direct-url">Click vào đây</a> để tiến hành cập nhật thông tin tài khoản</p>
         </div>
         <?php else : ?>
         <form id="signupForm" method="POST" class="form-horizontal" action="">
            <fieldset>
               <div class="col-md-12 col-xs-12">
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3" for="email">Email</label>
                     <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $_POST['email']; ?>" placeholder="Email" />
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-md-3 col-sm-3 control-label" for="password">Mật khẩu</label>
                     <div class="col-md-6 col-sm-6">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" />
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-md-3 col-sm-3 control-label" for="confirm_password">Xác nhận mật khẩu</label>
                     <div class="col-md-6 col-sm-6">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu" />
                     </div>
                  </div>

                  <div class="form-group">
                     <div class="col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6">
                        <button class="btn btn-success" name="btnRegister">Đăng ký</button>
                     </div>
                  </div>
               </div>
            </fieldset>
         </form>
         <?php endif; ?>
      </div>
   </div>
</div>
<?php } ?>
<script type="text/javascript">
   $.validator.setDefaults({
      submitHandler: function() {
         var email = $('input[name=email]').val(),
            password = $('input[name=password]').val();
         $.ajax({
            url: 'content/temp1/ajax.php',
            type: 'POST',
            data: {
               'email': email,
               'password': password,
               'act': 'register'
            },
         })
         .done(function(res) {
            if (res == 'ok') {
               window.location.href = '/dang-ky/';
            } else {
               $('<div class="col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6 errorMes"><div class="alert alert-info">' + res + '</div></div>').insertBefore('.form-group:first-child');
               $('<div class="clearfix"></div>').insertAfter('.errorMes');
            }
         });
      }
   });

   $(document).ready(function() {
      $("#signupForm").validate({
         rules: {
            email: {
               required: true,
               email: true
            },
            password: {
               required: true,
               minlength: 6
            },
            confirm_password: {
               required: true,
               minlength: 6,
               equalTo: "#password"
            }
         },
         messages: {
            email: "Vui lòng nhập một địa chỉ email hợp lệ",
            password: {
               required: "Vui lòng cung cấp một mật khẩu",
               minlength: "Mật khẩu của bạn phải dài ít nhất 6 ký tự"
            },
            confirm_password: {
               required: "Vui lòng cung cấp một mật khẩu",
               minlength: "Mật khẩu của bạn phải dài ít nhất 6 ký tự",
               equalTo: "Vui lòng nhập mật khẩu tương tự như trên"
            }
         },
         errorElement: "em",
         errorPlacement: function(error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");

            // Add `has-feedback` class to the parent div.form-group
            // in order to add icons to inputs
            element.parents(".col-sm-6").addClass("has-feedback");

            if (element.prop("type") === "checkbox") {
               error.insertAfter(element.parent("label"));
            } else {
               error.insertAfter(element);
            }
         },
         highlight: function(element, errorClass, validClass) {
            $(element).parents(".col-sm-6").addClass("has-error").removeClass("has-success");
         },
         unhighlight: function(element, errorClass, validClass) {
            $(element).parents(".col-sm-6").addClass("has-success").removeClass("has-error");
         }
      });
   });
</script>
<style type="text/css">
.register-result {
  padding: 0 20px 20px;
}
.register-result .h2 {
  margin-bottom: 15px;
}
.register-result .direct-url {
   color: #F90;
   text-decoration: underline;
}
</style>
