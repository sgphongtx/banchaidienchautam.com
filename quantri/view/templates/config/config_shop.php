<?php 
$errMsg ='';

$idshop=$row_shop['id'];

if(get_field("tbl_seo","idshop",$idshop,"id")!="") {
	$b=getRecord("tbl_seo", "idshop='".$idshop."'");
	$magoogle  = $b['googleverify'];
	$uagoogle  = $b['uagoogle'];
    $client_id = $b['client_id'];
	$maalexa   = $b['alexaVerifyID'];
	$codealexa = $b['alexacode'];
	$button    = $b['button'];
	$buttonpo  = $b['buttonpo'];
}

if(get_field("dm_config","idshop",$idshop,"id")!="") {
    $rb=getRecord("dm_config", "idshop='".$idshop."'");
    $shareface     = $rb['shareface'];
    $btn_add_cart  = $rb['btn_add_cart'];
    $adv_scroll    = $rb['adv_scroll'];
    $cmt_prod      = $rb['cmt_prod'];
    $cmt_post      = $rb['cmt_post'];
    $cmt_dis_style = $rb['cmt_dis_style'];
}


if (isset($_POST['btnSave'])){
    $logo          = isset($_POST['txtLogo']) ? trim($_POST['txtLogo']) : '';
    $icon          = isset($_POST['txtIcon']) ? trim($_POST['txtIcon']) : '';
    $name          = isset($_POST['name']) ? trim($_POST['name']) : '';
    $multi_lang    = isset($_POST['multi_lang']) ? trim($_POST['multi_lang']) : '';
    $default_lang  = isset($_POST['default_lang']) ? trim($_POST['default_lang']) : '';
    $domain        = isset($_POST['domain']) ? trim($_POST['domain']) : '';
    $address       = isset($_POST['address']) ? trim($_POST['address']) : '';
    $telephone     = isset($_POST['telephone']) ? trim($_POST['telephone']) : '';
    $hotline       = isset($_POST['hotline']) ? trim($_POST['hotline']) : '';
    $fax           = isset($_POST['fax']) ? trim($_POST['fax']) : '';
    $email         = isset($_POST['email']) ? trim($_POST['email']) : '';

    $u_mail_server = isset($_POST['cauhinh_mail_ten']) ? trim($_POST['cauhinh_mail_ten']) : 'webmailt@vanphuco.com';
    $p_mail_server = isset($_POST['cauhinh_mail_mk']) ? trim($_POST['cauhinh_mail_mk']) : 'qqq11123';

    $iconyahoo     = isset($_POST['iconyahoo']) ? trim($_POST['iconyahoo']) : '';
    $tooltip       = isset($_POST['tooltip']) ? trim($_POST['tooltip']) : '';

    $isMobile      = $_SESSION['user']['level']==1 ? $_POST['isMobile'] : $row_shop['is_mobile'];
    $button        = $_POST['button'];
    $buttonpo      = $_POST['buttonpo'];
    $shareface     = $_POST['shareface'];
    $btn_add_cart  = $_POST['btn_add_cart'];
    $adv_scroll    = $_POST['adv_scroll'];
    $cmt_prod      = isset($_POST['cmt_prod']) ? trim($_POST['cmt_prod']) : 0;
    $cmt_post      = isset($_POST['cmt_post']) ? trim($_POST['cmt_post']) : 0;
    $cmt_dis_style = $_POST['cmt_dis_style'];
    
    $codechat      = isset($_POST['codechat']) ? trim($_POST['codechat']) : '';
    $tiente        = isset($_POST['tiente']) ? trim($_POST['tiente']) : '';
    $title         = isset($_POST['title']) ? trim($_POST['title']) : '';
    $description   = isset($_POST['description']) ? trim($_POST['description']) : '';
    $keyword       = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';

	/* tool seo */
    $magoogle  = trim($_POST['magoogle']);
    $uagoogle  = trim($_POST['uagoogle']);
    $maalexa   = trim($_POST['maalexa']);
    $codealexa = trim($_POST['codealexa']);

	if ($name=="") $errMsg .= "Hãy nhập tên website !<br>";
	if ($errMsg==''){
		$oldid = $idshop;
		$sql = "UPDATE tbl_shop SET 
        logo='".$logo."', 
        icon='".$icon."', 
        name='".$name."', 
        name_shop='".$name."', 
        domain='".$domain."',  
        address='".$address."',
        telephone='".$telephone."',
        fax='".$fax."',
        email='".$email."',
        hotline='".$hotline."',
        tiente='".$tiente."',
        cauhinh_mail_ten='".$u_mail_server."', 
        cauhinh_mail_mk='".$p_mail_server."', 
        title='".$title."',
        description='".$description."',
        keyword='".$keyword."', 
        zopim='".$codechat."',
        tooltip='".$tooltip."', 
        last_modified=now(),
        is_mobile='".$isMobile ."',
        multi_lang='".$multi_lang."',
        default_lang='".$default_lang."'
        where id='".$oldid."'";
        // echo $sql; return;
		if (mysqli_query($conn,$sql)){

            $_SESSION['luu_lang_x'] = $default_lang;
            $_SESSION['setting']['currency'] = $tiente;

			if(get_field("tbl_seo","idshop",$idshop,"id")==""){
				$arrField = array(
    				"idshop"                    => "'".$idshop."'",
    				"googleverify"              => "'".$magoogle."'",
    				"uagoogle"                  => "'".$uagoogle."'",
                    "client_id"                 => "'".$client_id."'",
    				"alexaVerifyID"             => "'".$maalexa."'",
    				"alexacode"                 => "'".$codealexa."'",
    				"button"                    => "'".$button."'",
    				"buttonpo"                  => "'".$buttonpo."'"
				);
				insert("tbl_seo",$arrField);
			} else {
				$arrField = array(
    				"googleverify"              => "'".$magoogle."'",
    				"uagoogle"                  => "'".$uagoogle."'",
                    "client_id"                 => "'".$client_id."'",
    				"alexaVerifyID"             => "'".$maalexa."'",
    				"alexacode"                 => "'".$codealexa."'",
    				"button"                    => "'".$button."'",
    				"buttonpo"                  => "'".$buttonpo."'"
				);
				update("tbl_seo",$arrField,"idshop='".$idshop."'");
			}

            if(get_field("dm_config","idshop",$idshop,"id")!="") {
                $arrField = array(
                "shareface"     => "'".$shareface."'",
                "btn_add_cart"  => "'".$btn_add_cart."'",
                "adv_scroll"    => "'".$adv_scroll."'",
                "cmt_prod"      => "'".$cmt_prod."'",
                "cmt_post"      => "'".$cmt_post."'",
                "cmt_dis_style" => "'".$cmt_dis_style."'"
                );
                update("dm_config",$arrField,"idshop='".$idshop."'");
            }
            echo thongbao(url_direct(),$thongbao='Bạn đã thực hiện thành công..!');
		} else {
			$errMsg = "Không thể cập nhật !";
		}
	}
		
} else {
	$oldid = $idshop;
	$page = $_GET['page'];
	$sql = "SELECT * FROM tbl_shop WHERE id='".$oldid."'";
	if ($result = mysqli_query($conn,$sql)) {
		$row=mysqli_fetch_array($result);
        $logo         = $row['logo'];
            if ($logo == '')
                $logo_ = __PATH_NOIMAGE__;
            else
                $logo_ = __PATH_UPLOAD__ . $logo;
        $icon         = $row['icon'];
            if ($icon == '')
                $icon_ = __PATH_NOIMAGE__;
            else
                $icon_ = __PATH_UPLOAD__ . $icon;
        $name          = $row['name'];
        $multi_lang    = $row['multi_lang'];
        $default_lang  = $row['default_lang'];
        $domain       = $row['domain'];
        
        $codechat      = $row['zopim'];
        $address       = $row['address'];
        $telephone     = $row['telephone'];
        $fax           = $row['fax'];
        $email         = $row['email'];
        $hotline       = $row['hotline'];
        $tiente        = $row['tiente'];
        $u_mail_server = $row['cauhinh_mail_ten'];
        $p_mail_server = $row['cauhinh_mail_mk'];
        $iconyahoo     = $row['iconyahoo'];
        $tooltip       = $row['tooltip'];
        $isMobile      = $row['is_mobile'];
        $title         = $row['title'];
        $description   = $row['description'];
        $keyword       = $row['keyword'];
        $date_added    = $row['date_added'];
        $last_modified = $row['last_modified'];
	}
}
if ($logo_ == '') 
    $logo_ = __PATH_NOIMAGE__;
if ($icon_ == '') 
    $icon_ = __PATH_NOIMAGE__;
?>
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Cấu hình website</h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li><a href="<?=url_direct('get')?>">Cấu hình website</a></li>
            </ol>
        </div>
    </div>
</div>
<div class="content" style="min-height: 530px;">
    <div class="bs-example bs-example-bg-classes">
        <?php if($errMsg != '') { ?>
        <p class="bg-warning"><?php echo $errMsg; ?></p>
        <?php } else { ?>
        <p class="bg-warning">Lưu ý: Những ô có dấu (<font color="red">*</font>) là bắt buộc</p>
        <?php } ?>
    </div>
    <div class="">
         <form method="post" name="frmForm" enctype="multipart/form-data" class="">
            <input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />
            <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />

            <div class="block">
                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
                    <li class="active">
                        <a href="#btabs-animated-fade-general">Tổng quan</a></li>
                    <li>
                        <a href="#btabs-animated-fade-email">Email</a></li>
                    <li>
                        <a href="#btabs-animated-fade-contact">Liên hệ</a></li>
                    <li>
                        <a href="#btabs-animated-fade-diff">Khác</a></li>
                    <li>
                        <a href="#btabs-animated-fade-server">Thông tin server</a></li>
                </ul>

                <div class="tab-content block-content">
                    <div class="tab-pane fade in active" id="btabs-animated-fade-general">
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Logo</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="text" name="txtLogo" id="txtLogo" class="form-control" value="<?=$logo?>" data-target="#review-logo" onchange="ShowReview(event)">
                                    <span class="input-group-addon" style="background-color: #3c7ac9; border-color: #295995;">
                                        <a class="iframe-btn" href="../filemanager/dialog.php?type=1&amp;field_id=txtLogo&amp;relative_url=1&amp;fldr=Banner" style="color: #fff;">
                                            <i class="fa fa-folder-open"></i> Browse...
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="thumbnail" style="max-width: 200px;">
                                    <img id="review-logo" src="<?=$logo_?>">
                                </div>
                            </div>
                        </div>
                         <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Favicon</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="text" name="txtIcon" id="txtIcon" class="form-control" value="<?=$icon?>" data-target="#review-icon" onchange="ShowReview(event)">
                                    <span class="input-group-addon" style="background-color: #3c7ac9; border-color: #295995;">
                                        <a class="iframe-btn" href="../filemanager/dialog.php?type=1&amp;field_id=txtIcon&amp;relative_url=1&amp;fldr=Banner" style="color: #fff;">
                                            <i class="fa fa-folder-open"></i> Browse...
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="thumbnail">
                                    <img id="review-icon" src="<?=$icon_?>" width="45" height="45">
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Tên website (<font color="red">*</font>)</label>
                            <div class="col-sm-4">
                                <input type="text" name="name" class="form-control" value="<?=$name?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Tên miền (<font color="red">*</font>)</label>
                            <div class="col-sm-4">
                                <input type="text" name="domain" class="form-control" value="<?=$domain?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Đa ngôn ngữ</label>
                            <div class="col-sm-4">
                                <select name="multi_lang" class="form-control">
                                    <option value="0"<?=$multi_lang==0?' selected':''?>>Không</option>
                                    <option value="1"<?=$multi_lang==1?' selected':''?>>Có</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Ngôn ngữ mặc định</label>
                            <div class="col-sm-4">
                                <select name="default_lang" class="form-control">
                                    <?php
                                        $lang_result = get_records("tbl_language","1=1 and status=1","id asc"," "," ");
                                        while ($row_lang = mysqli_fetch_assoc($lang_result)) :
                                    ?>
                                    <option value="<?=$row_lang['id']?>"<?=$row_lang['id']==$default_lang?' selected':''?>><?=$row_lang['name']?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Tiền tệ mặc định</label>
                            <div class="col-sm-4">
                                <input type="text" name="tiente" class="form-control" value="<?=$tiente?>"/>
                                <!-- <select name="tiente" class="form-control">
                                    <?php $crcs = mysqli_query($conn,"SELECT id, title FROM tbl_currency WHERE status=1 ORDER BY id ASC");
                                    while ($crc = mysqli_fetch_assoc($crcs)) {
                                    ?>
                                    <option value="<?=$crc['id']?>"<?=$crc['id']==$tiente?' selected':''?>><?=$crc['title']?></option>
                                    <?php } ?>
                                </select> -->
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Title trang chủ</label>
                            <div class="col-sm-7">
                                <input type="text" name="title" class="form-control" id="name12" value="<?=$title?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Description mặc định</label>
                            <div class="col-sm-7">
                                <input type="text" name="description" class="form-control" id="name13" value="<?=$description?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Keyword mặc định</label>
                            <div class="col-sm-7">
                                <input type="text" name="keyword" class="form-control" id="name14" value="<?=$keyword?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Mã chứng thực Google</label>
                            <div class="col-sm-4">
                                <input type="text" name="magoogle" class="form-control" value="<?php if($magoogle!="") echo $magoogle;?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label"> UA Google<br/><p class="text-muted">Ví dụ: UA-79595125-1</p></label>
                            <div class="col-sm-4">
                                <input type="text" name="uagoogle" class="form-control" value="<?php if($uagoogle!="") echo $uagoogle;?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">OAuth client IDs<br/><p class="text-muted">Mã tạo thống kê truy cập từ google<br/>(chỉ trang quản trị)</p></label>
                            <div class="col-sm-4">
                                <input type="text" name="client_id" class="form-control" value="<?php if($client_id!="") echo $client_id;?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label"> Script live chat </label>
                            <div class="col-sm-7">
                                <textarea name="codechat" rows="10" class="form-control" id="codechat" placeholder="Nhập Script live chat code ở đây"><?=$codechat?></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- #btabs-animated-fade-general -->
                    <div class="tab-pane fade" id="btabs-animated-fade-email">
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Mail server</label>
                            <div class="col-sm-4">
                                <input type="text" name="cauhinh_mail_ten" class="form-control" value="<?=$u_mail_server?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-4">
                                <input type="password" name="cauhinh_mail_mk" class="form-control" value="<?=$p_mail_server?>"/>
                            </div>
                        </div>
                    </div>
                    <!-- #btabs-animated-fade-email -->
                    <div class="tab-pane fade" id="btabs-animated-fade-contact">
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Điện thoại</label>
                            <div class="col-sm-4">
                                <input type="text" name="telephone" class="form-control" value="<?=$telephone?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Fax</label>
                            <div class="col-sm-4">
                                <input type="text" name="fax" class="form-control" value="<?=$fax?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Hotline</label>
                            <div class="col-sm-4">
                                <input type="text" name="hotline" class="form-control" value="<?=$hotline?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-4">
                                <input type="text" name="email" class="form-control" value="<?=$email?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Địa chỉ</label>
                            <div class="col-sm-4">
                                <textarea name="address" rows="5" class="form-control"><?=$address?></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- #btabs-animated-fade-contact -->
                    <div class="tab-pane fade" id="btabs-animated-fade-diff">
                        <?php if ($_SESSION['user']['level'] == 1) : ?>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Sử dụng giao diện mobile</label>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="isMobile" value="0" <?php if($isMobile==0) echo 'checked="checked"';?> /> Không
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="isMobile" value="1" <?php if($isMobile==1) echo 'checked="checked"';?> /> Có
                                </label>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Chia sẻ mạng xã hội <br/> (lề trái web)</label>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="button" value="0" <?php if($button==0) echo 'checked="checked"';?> /> Ẩn
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="button" value="1" <?php if($button==1) echo 'checked="checked"';?> /> Hiện
                                </label>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Sử dụng chia sẻ mạng xã hội <br/> (trang chi tiết sản phẩm/bài viết)</label>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="shareface" value="0" <?php if($shareface==0) echo 'checked="checked"';?> /> Ẩn
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="shareface" value="1" <?php if($shareface==1) echo 'checked="checked"';?> /> Hiện
                                </label>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Sử dụng nút mua hàng</label>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="btn_add_cart" value="0" <?php if($btn_add_cart==0) echo 'checked="checked"';?> /> Ẩn
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="btn_add_cart" value="1" <?php if($btn_add_cart==1) echo 'checked="checked"';?> /> Hiện
                                </label>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Sử dụng quảng cáo trượt</label>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="adv_scroll" value="0" <?php if($adv_scroll==0) echo 'checked="checked"';?> /> Ẩn
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="adv_scroll" value="1" <?php if($adv_scroll==1) echo 'checked="checked"';?> /> Hiện
                                </label>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Bình luận/Đánh giá<br/>sản phẩm/bài viết</label>
                            <div class="col-sm-4">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="cmt_prod" value="1" <?php if($cmt_prod==1) echo 'checked="checked"';?> /> Sản phẩm
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="cmt_post" value="1" <?php if($cmt_post==1) echo 'checked="checked"';?> /> Bài viết
                                </label>
                                <div class="clearfix"></div>
                                <p style="margin: 10px 0 5px;">Kiểu bình luận</p>
                                <label class="radio-inline">
                                    <input type="radio" name="cmt_dis_style" value="0" <?php if($cmt_dis_style==0) echo 'checked="checked"';?>  /> Mặc định
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="cmt_dis_style" value="1" <?php if($cmt_dis_style==1) echo 'checked="checked"';?> /> Facebook Comments Plugin
                                </label>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Tooltip</label>
                            <div class="col-sm-4">
                                <select name="tooltip" class="form-control" id="tooltip">
                                    <option value="0" <?php if($tooltip==0) echo 'selected="selected"';?>> Có hiện </option>
                                    <option value="1" <?php if($tooltip==1) echo 'selected="selected"';?>> Không hiện </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- #btabs-animated-fade-diff -->
                    <div class="tab-pane fade" id="btabs-animated-fade-server">
                        <div class="list-group">
                            <a href="javascript:;" class="list-group-item">
                                <strong>Server OS</strong>
                                <span class="pull-right"><?php echo PHP_OS; ?></span>
                            </a>
                            <a href="javascript:;" class="list-group-item">
                                <strong>Browser</strong>
                                <span class="pull-right">
                                <?php
                                    $ua=getBrowser();
                                    $yourbrowser=  $ua['name'] . " " . $ua['version'];
                                    print_r($yourbrowser);
                                ?>
                                </span>
                            </a>
                            <a href="javascript:;" class="list-group-item">
                                <strong>PHP version</strong>
                                <span class="pull-right"><?php echo phpversion(); ?></span>
                            </a>
                            <a href="javascript:;" class="list-group-item">
                                <strong>MySQL version</strong>
                                <span class="pull-right"><?php echo mysqli_get_server_info(); ?></span>
                            </a>
                        </div>
                    </div>
                    <!-- #btabs-animated-fade-server -->
                    <div class="form-group clearfix">
                        <div class="col-sm-offset-3 col-sm-4 btn-gr">
                            <button type="submit" name="btnSave" class="btn btn-default">Chấp nhận</button>
                            <button onclick="goBack()" type="button" name="goback" class="btn btn-default">Quay lại</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
function ShowReview(e){
    var val = $(e.target).val(),
        target = $(e.target).attr('data-target');
    console.log(val);
    if(val != ""){
        $(target).attr('src',val);
    }
}
</script>