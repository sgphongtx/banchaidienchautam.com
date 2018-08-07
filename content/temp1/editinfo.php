<?php 
   if (isset($_SESSION['kh_shop_login_id'])) : 
      $idKH = $_SESSION['kh_shop_login_id'];
      $row_ctm_shop = getRecord("tbl_customer_shop","id='$idKH' and status=1");
?>
<div class="widget widget-static-block bg-white">
   <div class="register-wrap space-base">
      <div class="block-title">
         <div class="h3"><?=module_keyword($mang11, $mang22, 'changeinfo')?></div>
      </div>
      <div class="block-content">
         <form id="updateAccountForm" method="POST" class="form-horizontal" action="">
            <fieldset>
               <div class="col-md-12 col-xs-12">
                  <div class="form-group">
                     <label class="col-md-3 col-sm-3 control-label" for="fullname">Họ tên</label>
                     <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" id="fullname" name="fullname" 
                        value="<?=$_POST['fullname']!=''?$_POST['fullname']:$row_ctm_shop['name'];?>" 
                        placeholder="Họ tên" />
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-md-3 col-sm-3 control-label" for="gender">Giới tính</label>
                     <div class="col-md-6 col-sm-6">
                        <label class="radio-inline">
                           <input type="radio" name="gender" value="1" <?=$row_ctm_shop['sex']==1?'checked':''?>>Nam
                        </label>
                        <label class="radio-inline">
                           <input type="radio" name="gender" value="0" <?=$row_ctm_shop['sex']==0?'checked':''?>>Nữ
                        </label>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-md-3 col-sm-3 control-label" for="dob">Ngày sinh</label>
                     <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" id="dob" name="dob" 
                        value="<?=$_POST['dob']!=''?$_POST['dob']:date_format(date_create($row_ctm_shop['birthday']=='0000-00-00'?'1930-01-01':$row_ctm_shop['birthday']),'d-m-Y');?>" 
                        placeholder="Ngày - Tháng - Năm" />
                     </div>
                  </div>
   
                  <div class="form-group">
                     <label class="col-md-3 col-sm-3 control-label" for="address">Địa chỉ</label>
                     <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" id="address" name="address" 
                        value="<?=$_POST['address']!=''?$_POST['address']:$row_ctm_shop['address'];?>" 
                        placeholder="Địa chỉ" />
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-md-3 col-sm-3 control-label" for="tel">Số điện thoại</label>
                     <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" id="tel" name="tel" 
                        value="<?=$_POST['tel']!=''?$_POST['tel']:$row_ctm_shop['mobile'];?>" 
                        placeholder="Số điện thoại" />
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
            fullname = $('input[name=fullname]').val(),
            gender = $('input[name=gender]').val(),
            dob = $('input[name=dob]').val(),
            address = $('input[name=address]').val(),
            tel = $('input[name=tel]').val();
         $.ajax({
            url: 'content/temp1/ajax.php',
            type: 'POST',
            data: {
               'id': id,
               'fullname': fullname,
               'gender': gender,
               'dob': dob,
               'address': address,
               'tel': tel,
               'act': 'edit_info'
            },
         })
         .done(function(res) {
            if (res == 'ok') {
               alert('Cập nhật thành công!');
               window.location = '';
            } else {
               $('<div class="col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6 errorMes"><div class="alert alert-info">' + res + '</div></div>').insertBefore('.form-group:first-child');
               $('<div class="clearfix"></div>').insertAfter('.errorMes');
            }
         });
      }
   });

   $(document).ready(function() {
      $("#updateAccountForm").validate({
         rules: {
            fullname: {
               required: true,
               minlength: 2
            },
            gender: "required",
            dob: {
               required: true,
            },
            address: {
               required: true,
               minlength: 2
            },
            tel: {
               required: true,
            }
         },
         messages: {
            fullname: {
               required: "Bạn cần nhập Họ tên (từ 2-40 ký tự)",
               minlength: "Bạn cần nhập Họ tên (từ 2-40 ký tự)"
            },
            gender: "Vui lòng chọn Giới tính",
            dob: {
               required: "Vui lòng nhập Ngày sinh"
            },
            address: {
               required: "Vui lòng nhập địa chỉ (từ 2-100 ký tự)",
               minlength: "Vui lòng nhập địa chỉ (từ 2-100 ký tự)"
            },
            tel: {
               required: "Vui lòng nhập Số điện thoại của bạn"
            }
         },
         errorElement: "em",
         errorPlacement: function(error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");

            // Add `has-feedback` class to the parent div.form-group
            // in order to add icons to inputs
            element.parents(".col-sm-6").addClass("has-feedback");

            if (element.is(":radio")) {
               error.insertAfter(element.parent("label").next());
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
