<?php 
	if (isset($_SESSION['kh_shop_login_id'])) :
		$idKH = $_SESSION['kh_shop_login_id'];
?>
<div class="widget widget-static-block bg-white">
   <div class="register-wrap space-base">
      <div class="block-title">
         <div class="h3"><?=module_keyword($mang11, $mang22, 'changepass')?></div>
      </div>
      <div class="block-content">
			<form id="editPassForm" method="POST" class="form-horizontal" action="">
				<fieldset>
               <div class="col-md-12 col-xs-12">
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
                        <button class="btn btn-success" name="btnSubmit">Cập nhật</button>
                     </div>
                  </div>
               </div>
            </fieldset>
			</form>
     	</div>
   </div>
</div>
<?php endif; ?>
<script type="text/javascript">
   $.validator.setDefaults({
      submitHandler: function() {
         var id = <?=$_SESSION['kh_shop_login_id']?>,
            password = $('input[name=password]').val();
         $.ajax({
            url: 'content/temp1/ajax.php',
            type: 'POST',
            data: {
               'id': id,
               'password': password,
               'act': 'edit_pass'
            },
         })
         .done(function(res) {
            if (res == 'ok') {
               alert('Thay đổi mật khẩu thành công!');
               window.location = '';
            } else {
               $('<div class="col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6 errorMes"><div class="alert alert-info">' + res + '</div></div>').insertBefore('.form-group:first-child');
               $('<div class="clearfix"></div>').insertAfter('.errorMes');
            }
         });
      }
   });

   $(document).ready(function() {
      $("#editPassForm").validate({
         rules: {
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

            error.insertAfter(element);
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
