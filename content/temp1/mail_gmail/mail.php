<?php
    include "content/temp1/mail_gmail/class.phpmailer.php";
    include "content/temp1/mail_gmail/class.smtp.php";

    $noidung_AltBody='
    Chào bạn! <br>
    Email này là do khách hàng của bạn gửi liên hệ thông qua website <a href="'.$linkroot.'"> '.str_replace('http://', '', $linkroot).'</a>  <br />';
    
    if (isset($_POST['btnSubmit'])==true)//isset kiem tra submit
    {
        $contactname    = $_POST['contactname'];
        $contactphone   = $_POST['contactphone'];
        $contactemail   = $_POST['contactemail'];
        $contactsubject   = $_POST['contactsubject'];
        $message        = $_POST['message'];
        $capcha_code    = $_POST['protectcode'];

        $contactname    = trim(strip_tags($contactname));
        $contactphone   = trim(strip_tags($contactphone));
        $contactemail   = trim(strip_tags($contactemail));
        $contactsubject = trim(strip_tags($contactsubject));
        $message        = trim(strip_tags($message));

        if (get_magic_quotes_gpc()==false)
        {
            $contactname     = mysqli_real_escape_string($contactname);
            $contactphone    = mysqli_real_escape_string($contactphone);
            $contactemail   = mysqli_real_escape_string($contactemail);
            $contactsubject = trim(strip_tags($contactsubject));
            $message        = mysqli_real_escape_string($message);
        }

        $err = false;

        if(!$contactname) {
            $err = true;
            $err_n = '<span class="alert alert-danger"><em>Vui lòng nhập Họ tên</em></span>';
        }
        if(!$contactemail) {
            $err = true;
            $err_e = '<span class="alert alert-danger"><em>Vui lòng nhập Email</em></span>';
        } else {
            if (!filter_var($contactemail, FILTER_VALIDATE_EMAIL)) {
                $err = true;
                $err_e = '<span class="alert alert-danger"><em>Email không đúng định dạng (example@domain.com)</em></span>';
            }
        }
        if(!$contactsubject) {
            $err = true;
            $err_s = '<span class="alert alert-danger"><em>Vui lòng nhập Tiêu đề thư</em></span>';
        }
        if(!$message) {
            $err = true;
            $err_m = '<span class="alert alert-danger"><em>Vui lòng nhập Nội dung thư</em></span>';
        }
        if(!$capcha_code) {
            $err = true;
            $err_c = '<span class="alert alert-danger col-md-offset-2"><em>Vui lòng nhập Mã bảo vệ</em></span>';
        } else {
            if ($_SESSION['captcha_code'] != $capcha_code)
            {
                $err = true;
                $err_c = '<span class="alert alert-danger col-md-offset-2">Mã bảo vệ không đúng</span>';
            }
        }

        if($err == false)
        {
            $content_mail = $noidung_AltBody
            .'<strong>Thông tin khách hàng như sau:  </strong> <br />'
            .'<strong>Người gửi : </strong>'.$contactname.'<br />'
            .'<strong>Email : </strong>'.$contactemail.'<br />'
            .'<strong>Tiêu đề : </strong> <br>  '.$contactsubject.'<br />'
            .'<strong>Nội dung : </strong> <br>  '.$message.'<br />'
            .'<br> <br><hr>
            Chúng tôi mong bạn thực hiện giao dịch thành công, chúc công việc kinh doanh của bạn ngày càng thuận lợi." vào trong Email. <br>';

            $ng_ten = $contactname;
            $ng_email = $contactemail;

            $ch_email = $row_shop['cauhinh_mail_ten'];
            $ch_pass = $row_shop['cauhinh_mail_mk'];

            $nn_ten = $row_shop['name'];
            $nn_email = $row_shop['email'];

            $noidung = $content_mail;
            $tieude = $contactsubject;

            $kq = @guimail($ng_ten,$ch_email,$ch_email,$ch_pass,$nn_ten,$nn_email,$tieude,$noidung);

            if($kq == 0)
            {
                $errMsg = '<div class="alert alert-warning"><strong>Gửi mail không thành công..!</strong></div>' . $mail->ErrorInfo;
            }
            else
            {
                $errMsg = '<div class="alert alert-success"><strong>Gửi mail thành công ! Chúng tôi sẽ liên hệ với quý vị trong thời gian sớm nhất.</strong></div>';
                $contactname    = '';
                $contactphone   = '';
                $contactemail   = '';
                $contactsubject = '';
                $message        = '';
                $capcha_code    = '';
            }
        }
    }
?>
<div class="row">
    <form onsubmit="return check_form()" name="form_contact" id="form_contact" method="post">
        <?=$errMsg?>
        <div class="clearfix">
            <p class="col-md-6">
                <span class="form-control-wrap fc-name">
                    <input type="text" name="contactname" value="<?php echo $contactname ?>" class="form-control" placeholder="<?php echo module_keyword($mang11, $mang22, 'name_c')?> *">
                </span>
                <?php echo $err_n ?>
            </p>
        </div>
        <div class="clearfix">
            <p class="col-md-6">
                <span class="form-control-wrap fc-email">
                    <input type="email" name="contactemail" value="<?php echo $contactemail ?>" class="form-control" placeholder="Email *">
                </span>
                <?php echo $err_e ?>
            </p>
        </div>
        <div class="clearfix">
            <p class="col-md-6">
                <span class="form-control-wrap fc-subject">
                    <input type="text" name="contactsubject" value="<?php echo $contactsubject ?>" class="form-control" placeholder="<?php echo module_keyword($mang11, $mang22, 'subject')?> *">
                </span>
                <?php echo $err_s ?>
            </p>
        </div>
        <div class="clearfix">
            <p class="col-md-9">
                <span class="form-control-wrap fc-message">
                    <textarea name="message" cols="40" rows="5" class="form-control fc-textarea" placeholder="<?php echo module_keyword($mang11, $mang22, 'contentmail')?> *"><?php echo $message ?></textarea>
                </span>
                <?php echo $err_m ?>
            </p>
        </div>
        <div class="clearfix">
            <p class="col-md-6 captcha-test">
                <img src="/public/templates/content/plugins/capcha/dongian.php" alt="captcha">
                <span class="form-control-wrap fc-captcha">
                    <input type="text" name="protectcode" value="" class="form-control" placeholder="<?php echo module_keyword($mang11, $mang22, 'secutitycode')?> *">
                </span>
                <?php echo $err_c ?>
            </p>
            <p class="col-md-3">
                <input type="submit" name="btnSubmit" value="<?php echo module_keyword($mang11,$mang22,"send");?>" title="<?php echo module_keyword($mang11,$mang22,"send");?>" class="pull-right" />
            </p>
        </div>
    </form>
</div>
<style type="text/css">
.contact-form span {
  display: block;
  min-height: 22px;
  line-height: 22px;
  font-size: 12px;
}
.contact-form span.alert {
  display: inline-block;
  padding: 3px 15px;
  margin-top: 5px;
  margin-bottom: 5px;
}
.captcha-test img {
  float: left;
  margin-right: 10px;
  height: 30px;
}
.form-control-wrap.fc-captcha input[type="text"] {
  width: 75%;
  float: left;
}
.contact-form input[type="submit"] {
  padding: 0 34px;
  height: 34px;
  border: none;
  font-weight: bold;
  color: #ffffff;
  border-radius: 2px;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  background-color: #006db7;
}
</style>