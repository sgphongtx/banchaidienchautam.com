<?php    
    $query_face = mysqli_query($conn,"select * from dm_config where idshop=".$idshop);
    if($query_face) {
        $row_face = mysqli_fetch_array($query_face);
        $linkface = $row_face['box_face'];
    }
    
    if (isset($_POST['btnSave'])) {
        if(mysqli_query($conn,"UPDATE  dm_config SET  `box_face` =  '".$_POST['txtlinkface']."' WHERE idshop=".$idshop)) {
            $url_direct = url_direct('get',$_GET['act']);
            echo "<script>alert('Cập nhật thành công');window.location='$url_direct'</script>";
		}
    }
?>
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Facebok <small>Add link fanpage, page group</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?=url_direct()?>">Quản trị</a></li>
                <li>Add link fanpage, page group</li>
            </ol>
        </div>
    </div>
</div>
<div class="content" style="min-height: 530px;">
    <div class="block">
        <div class="block-content">
            <form method="post" name="frmForm" enctype="multipart/form-data" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        Tên quảng cáo <font color="red">*</font>
                    </label>
                    <div class="col-sm-6">
                        <input type="text" name="txtlinkface" class="form-control" value="<?=$linkface?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <div class="fb-page" 
                            data-href="<?php echo $linkface;  ?>" 
                            data-small-header="false" 
                            data-adapt-container-width="true" 
                            data-hide-cover="false" 
                            data-show-facepile="true" 
                            data-show-posts="false">
                        </div>
                        <script>
                        (function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
                        fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                        <!-- Load Facebook SDK for JavaScript -->
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 btn-gr">
                        <button type="submit" name="btnSave" class="btn btn-sm btn-primary">Lưu</button>
                        <button onclick="goBack()" type="button" name="goback" class="btn btn-sm btn-danger">Quay lại</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>