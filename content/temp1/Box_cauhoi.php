<?php
    if(isset($_GET['danhmuc'])) {
        $subject = $_GET['danhmuc'];
        $id_category = get_one_field("tbl_item_category","subject='$subject'",$lang,"id");
    }
    if(isset($_GET['tensanpham'])) {
        $subject = $_GET['tensanpham'];
        $row = getRecord("tbl_item", "subject='$subject' and status=1");
        $id_category = $row['parent'];
    }
?>
<div class="cauhoi">
        <div class="row">
            <div class="cauhoi_cmt col-md-6" id="comments">
            <h3 class="title_f_p_m_gh">
                  Đặt câu hỏi
            </h3><!-- End .title_f_p_m_gh -->
                <?php
                $query = mysqli_query($conn,"select *, date_format(date_now, '%d-%m-%Y %H:%m') as dateAdd from product_comment where id_product=".$rowtin['id']." and idshop=".$idshop." and status=1 order by id asc");
                if (mysqli_num_rows($query) > 0) {
                ?>
                <!-- List comment -->
                <h4> Bình luận </h4>
                <ol class="comment-list">
                    <?php while($row = mysqli_fetch_array($query)) { ?>
                    <li class="comment row">
                        <div class="col-md-2 col-sm-2 hidden-xs">
                            <figure class="thumbnail">
                                <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg">
                                <figcaption class="text-center"><?=$row['name']?></figcaption>
                            </figure>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <div class="panel panel-default arrow left">
                                <div class="panel-body">
                                    <header class="text-left">
                                        <div class="comment-user">
                                            <i class="fa fa-user"></i>
                                            <?=$row['name']?>
                                        </div>
                                        <time class="comment-date" datetime="<?=$row['date_now']?>">
                                            <i class="fa fa-clock-o"></i>
                                            <?=$row['dateAdd']?>
                                        </time>
                                    </header>
                                    <div class="comment-post">
                                        <p><?=$row['noidung']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ol>
                <?php } ?>
                <div class="clearfix"></div>
                <!-- Form comment -->
                <div id="respond">
                    <div class="commentform" id="commentform">
                        <div id="comment-success"></div>
                        <div class="form-group col-md-6">
                            <input type="text" name="author" id="author" value="<?=$_SESSION['kh_shop_login_id']!='' ? get_field('tbl_customer_shop','id',$_SESSION['kh_shop_login_id'],'name'): ''?>" placeholder="<?php echo av('Tên...','Name...') ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="diachi" id="diachi" value="<?=$_SESSION['kh_shop_login_id']!='' ? get_field('tbl_customer_shop','id',$_SESSION['kh_shop_login_id'],'diachi'): ''?>" placeholder="Địa chỉ..." class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="email" id="email" value="<?=$_SESSION['kh_shop_login_id']!='' ? get_field('tbl_customer_shop','id',$_SESSION['kh_shop_login_id'],'email'): ''?>" placeholder="Email..." class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="phone" id="phone" value="<?=$_SESSION['kh_shop_login_id']!='' ? get_field('tbl_customer_shop','id',$_SESSION['kh_shop_login_id'],'phone'): ''?>" placeholder="Điện thoại..." class="form-control">
                        </div>
                       <div class="form-group col-md-12">
                            <select name="cate" id="cate" class="form-control cate">
                               <p class="col-md-6">
                                   <option value="">--Chọn danh mục--</option>
                                   <?php
                                       $rs_cate=get_result("tbl_item_category","status=1 and idshop=".$idshop." and lang=".$lang,"","");
                                       while($row_cate=mysqli_fetch_array($rs_cate))
                                       {
                                   ?>
                                   <option <?php echo $cate==$row_cate['id']?'selected="selected"':'' ?> value="<?=$row_cate['id']?>"><?=$row_cate['name']?></option>
                                   <?php
                                       }
                                   ?>
                               </p>
                           </select>
                       </div>
                        <div class="col-md-12 form-group">
                            <textarea name="comment" cols="40" rows="5" id="comment" placeholder="Câu hỏi..." class="form-control"></textarea>
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
                                <div class="comment_submit_wrap">
                                    <input type="submit" name="submit" id="submit" idsp="<?=$row['id']; ?>" value="Gửi">
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="img_question col-md-6">
                <?php
                    $row = getRecord("tbl_item","cate=3 and type=3 and lang=$lang and status=1");
                    echo stripslashes($row['detail']);
                ?>
            </div>
        </div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
$(document).ready(function() {
    $('#submit').click(function(event) {
        var name = $('#author').val(),
            diachi = $('#diachi').val(),
            email = $('#email').val(),
            phone = $('#phone').val(),
            cate = $('#cate').val(),
            comment = $('#comment').val(),
            idsp = $(this).attr('idsp'),
            idshop = <?=$idshop?>;
        var emailfilter = /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/;
        var checkemail = emailfilter.test(email)
        if(name == '') {
            alert('Vui lòng nhập "Tên"');
            $('#author').focus();
            return false;
        }
        if(diachi == '') {
            alert('Vui lòng nhập "Địa chỉ"');
            $('#diachi').focus();
            return false;
        }
        if(email == '') {
            alert('Vui lòng nhập "Email"');
            $('#email').focus();
            return false;
        }
        if (!checkemail)
        {
            alert('"Email" không đúng định dạng (example@domain.com)');
            $('#email').focus();
            return false;
        }
        if(phone == '') {
            alert('Vui lòng nhập "Điện thoại"');
            $('#phone').focus();
            return false;
        }
        if(cate == '') {
            $('#cate').focus();
            return false;
        }
        if(comment == '') {
            alert('Vui lòng nhập "Nội dung"');
            $('#comment').focus();
            return false;
        }
        $.ajax({
            url: '<?=$linkroot;?>/content/<?php echo $template ?>/Add_cauhoi_ajax.php',
            type: 'GET',
            dataType: 'html',
            data: {'name': name,'diachi': diachi,'email': email,'phone': phone,'cate': cate,'comment': comment, 'type': 'addcmt', 'idsp': idsp},
        })
        .done(function(data) {
            $('#comment-success').html(data);
        })
    });
});
</script>

<?php
    if ($id_category == '') {

    }
    else {
	$new=get_result("tbl_comment","status=1 and cate='{$id_category}'","","");
	while($row_new=mysqli_fetch_assoc($new)){
?>
<div class="phanhoi col-md-12">
	<div class="hoten"><?php echo $row_new['hoten']?></div>
    <div class="time_cmt">
        <?php echo $row_new['date_added']; ?>
    </div>
	<div class="noidung">
		<div class="hoi-question col-md-6">
			<div class="hoi">
                <?php echo $row_new['noidung']?>
            </div>
		</div>
		<div class="tl-question col-md-6">
            <div class="tl">
			     "<?php echo $row_new['traloi']?>"
            </div>
		</div>
	</div>
</div>
<?php } } ?>