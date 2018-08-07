<?php 
   if (isset($_SESSION['kh_shop_login_id'])) header('Location:'.$linkroot.'/sua-thong-tin.html');
   else {
?>
<div class="widget widget-static-block bg-white">
   <div class="login-wrap space-base">
      <div class="block-title">
         <div class="h3"><?=module_keyword($mang11, $mang22, 'login')?></div>
      </div>
      <div class="block-content">
         <form id="signinForm" method="POST" class="form-horizontal" action="">
            <fieldset>
               <div class="col-md-12 col-xs-12">
                  <div class="form-group">
                     <label class="col-md-3 col-sm-3 control-label" for="email">Email</label>
                     <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" id="email" name="email" value="" placeholder="Email" />
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-md-3 col-sm-3 control-label" for="password">Mật khẩu</label>
                     <div class="col-md-6 col-sm-6">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" />
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6">
                        <button class="btn btn-success">Đăng nhập</button>
                     </div>
                  </div>
               </div>
            </fieldset>
         </form>
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
               'act': 'login'
            },
         })
         .done(function(res) {
            if (res == 'ok') {
               alert('Đăng nhập thành công!');
               window.location = '/';
            } else {
               $('<div class="col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6 errorMes"><div class="alert alert-info">' + res + '</div></div>').insertBefore('.form-group:first-child');
               $('<div class="clearfix"></div>').insertAfter('.errorMes');
            }
         });
      }
   });

   $(document).ready(function() {
      $("#signinForm").validate({
         rules: {
            email: {
               required: true,
               email: true
            },
            password: {
               required: true,
               minlength: 6
            }
         },
         messages: {
            email: "Vui lòng nhập một địa chỉ email hợp lệ",
            password: {
               required: "Vui lòng cung cấp một mật khẩu",
               minlength: "Mật khẩu của bạn phải dài ít nhất 6 ký tự"
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
