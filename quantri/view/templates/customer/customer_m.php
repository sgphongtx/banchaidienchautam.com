<?php
$id_user = $_GET['id'];
$row_user = getRecord("tbl_customer_shop","id=$id_user");
$errMsg = '';

if (isset($_POST['submit'])) {
    $name            = $_POST['profile-name'];
    $mobile          = $_POST['profile-mobile'];
    $address         = $_POST['profile-address'];
    $password_new    = $_POST['profile-password-new'];
    $password_new_cf = $_POST['profile-password-new-confirm'];

    if ($password_new!='' || $password_new_cf!='') {
        if (strlen($password_new)>=6 || strlen($password_new_cf)>=6) {
            if ($password_new != $password_new_cf) {
                $errMsg = 'Mật khẩu không trùng khớp.';
            }
        } else {
            $errMsg = 'Mật khẩu ít nhất phải từ 6 kí tự';
        }
    } else {
        $errMsg = 'Nhập vào mật khẩu mới & mật khẩu xác nhận';
    }

    if ($errMsg == '') {
        $sql = "UPDATE tbl_customer_shop SET name='$name', mobile='$mobile', address='$address', password='".md5(md5(md5($password_new)))."' WHERE id='$id_user'";

        if (mysqli_query($conn,$sql)) {
            $url_direct = url_direct('get',$_GET['act'],'_m','&pageNum='.$_REQUEST['page'].'&code=1');
            echo "<script>window.location='$url_direct'</script>";
        } else {
            $errMsg = 'Lỗi cập nhật';
        }
    }

}
?>

<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Thành viên <small><?=isset($_GET['id'])?'Chỉnh sửa thông tin':'Thêm mới'?> thành viên</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li><a href="<?=url_direct('get')?>">Danh sách thành viên</a></li>
                <li><?=isset($_GET['id'])?'Chỉnh sửa thông tin':'Thêm mới'?></li>
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
    <div class="block">
        <div class="block-content">
            <form method="post" name="frmForm" enctype="multipart/form-data" class="form-horizontal">
                <input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />
                <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
                <input type="hidden" name="page" value="<?=$_REQUEST['page']?>" />
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a data-toggle="tab" href="#profile" aria-expanded="true">Thông tin thành viên</a></li>
                    <li role="presentation" class=""><a data-toggle="tab" href="#history-order" aria-expanded="false">Lịch sử giao dịch</a></li>
                </ul>
                <div class="tab-content" style="padding:20px">
                    <div role="tabpanel" class="tab-pane fade active in" id="profile">
                        <div class="form-group">
                            <label for="profile-email" class="col-sm-2 control-label">Email đăng nhập</label>
                            <div class="col-sm-6 form-control-static font-w700"><?=$row_user['email']?></div>
                        </div>
                        <div class="form-group">
                            <label for="profile-date-create" class="col-sm-2 control-label">Ngày đăng ký</label>
                            <div class="col-sm-6 form-control-static font-w700"><?=$row_user['date_added']?></div>
                        </div>
                        <div class="form-group">
                            <label for="profile-last-modified" class="col-sm-2 control-label">Cập nhật sau cùng</label>
                            <div class="col-sm-6 form-control-static font-w700"><?=$row_user['last_modified']?></div>
                        </div>
                        <div class="form-group">
                            <label for="profile-name" class="col-sm-2 control-label">Họ và tên</label>
                            <div class="col-sm-6"><input class="form-control input-lg" type="text" id="profile-name" name="profile-name" value="<?=$row_user['name']?>"></div>
                        </div>
                        <div class="form-group">
                            <label for="profile-mobile" class="col-sm-2 control-label">Điện thoại</label>
                            <div class="col-sm-6"><input class="form-control input-lg" type="text" id="profile-mobile" name="profile-mobile" value="<?=$row_user['mobile']?>"></div>
                        </div>
                        <div class="form-group">
                            <label for="profile-address" class="col-sm-2 control-label">Địa chỉ</label>
                            <div class="col-sm-6"><input class="form-control input-lg" type="text" id="profile-address" name="profile-address" value="<?=$row_user['address']?>"></div>
                        </div>
                        <div class="form-group">
                            <label for="profile-password-new" class="col-sm-2 control-label">Mật khẩu mới</label>
                            <div class="col-sm-6"><input class="form-control input-lg" type="password" id="profile-password-new" name="profile-password-new"></div>
                        </div>
                        <div class="form-group">
                            <label for="profile-password-new-confirm" class="col-sm-2 control-label">Xác nhận mật khẩu</label>
                            <div class="col-sm-6"><input class="form-control input-lg" type="password" id="profile-password-new-confirm" name="profile-password-new-confirm"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <button class="btn btn-sm btn-primary" type="submit" name="submit"><i class="fa fa-check push-5-r"></i> Lưu thay đổi</button>
                            </div>
                        </div>
                    </div>
                    <!-- end #profile -->
                    <div role="tabpanel" class="tab-pane fade" id="history-order">
                        <div class="row">
                            <div class="col-sm-10">
                                <table class="ui striped table">
                                    <thead>
                                        <tr>
                                            <td class="text-center">#</td>
                                            <td class="text-center">Thời gian đặt hàng</td>
                                            <td class="text-center">Phương thức</td>
                                            <td class="text-center">Tổng tiền</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $result = get_records("tbl_donhang", "idshop='$idshop' and idKH='".$_SESSION['kh_shop_login_id']."'", "id desc", " ", " ");
                                        while ($row = mysqli_fetch_assoc($result)) : ?>
                                        <tr>
                                            <td class="text-center"><?php echo $row['id']; ?></td>
                                            <td class="text-center"><?php echo date_format(date_create($row['ThoiDiemDatHang']),'d-m-Y H:i:s'); ?></td>
                                            <td class="text-center">Thanh toán khi nhận hàng</td>
                                            <td class="text-center"><?php echo number_format($row['price'],0).' '.$row_shop['tiente']; ?></td>                                           
                                        </tr>
                                        <?php endwhile ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end #history-order -->
                </div>
                <!-- end .tab-content -->
            </form>
        </div>
    </div>
</div>