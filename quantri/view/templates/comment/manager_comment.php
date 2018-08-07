<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Bình luận <small>Danh sách các bình luận</small></h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?php echo $linkroot ?>/quantri">Quản trị</a></li>
                <li>Danh sách các bình luận</li>
            </ol>
        </div>
    </div>
</div>
<div class="content" style="min-height: 530px;">
    <div class="block">
        <div class="block-header bg-gray-lighter">
            <span class="block-title">Danh sách</span>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-bordered table-hover btl-list-bbli bg-white">
                    <thead>
                        <tr>
                            <td class="text-center" style="width: 1px;">ID</td>
                            <td class="text-left">Họ tên</td>
                            <td class="text-left">Email</td>
                            <td class="text-left">Nội dung</td>
                            <td class="text-center" style="width: 80px;">ID Sản phẩm/Bài viết</td>
                            <td class="text-center" style="width: 80px;">Thời gian</td>
                            <td class="text-center" style="width: 80px;">Trạng thái</td>
                            <td class="text-center" style="width: 50px;">Tùy chọn</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query_comment = mysqli_query($conn,"select * from product_comment where idshop=".$idshop);
                            while($row_comment = mysqli_fetch_array($query_comment)) :
                        ?>
                        <tr>
                            <td class="text-center">
                                <?php echo $row_comment['id_comment']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $row_comment['name']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $row_comment['email']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $row_comment['content']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $row_comment['id_product']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $row_comment['date_now']; ?>
                            </td>
                            <td class="text-center">
                                <?php 
                                    if($row_comment['status'] == 0) echo '<img class="status_com" status="1" title="Xác nhận" idsp='.$row_comment['id_comment'].' src="../public/templates/quantri/images/icon/Deny.png" height="20" width="20" style="bottom:0px;" />';
                                    else  echo '<img class="status_com" title="Huỷ xác nhận" status="0" idsp='.$row_comment['id_comment'].' src="../public/templates/quantri/images/icon/Accept.png" height="20" width="20" style="bottom:0px;" />';
                                ?>
                            </td>
                            <td class="text-center">
                                <img class="delete_com" idsp="<?php echo $row_comment['id_comment']?>" src="../public/templates/quantri/images/icon/xoa.png" height="20" width="20" style="bottom:0px;" />
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script language='javascript'>
    $(document).ready(function(){
        $('.status_com').on('click', function(){
            var status = $(this).attr('status');
            var idsp   = $(this).attr('idsp');
            $.ajax({
                url: 'ajax/ajax.php',
                type: 'POST',
                data: {'cmd': 'CMT_ON', 'status': status, 'idsp': idsp},
            })
            .done(function(dt) {
                console.log("success");
            });    
            if ($(this).attr('src') ==  "../public/templates/quantri/images/icon/Deny.png")
                $(this).attr('src','../public/templates/quantri/images/icon/Accept.png');
            else
                $(this).attr('src','../public/templates/quantri/images/icon/Deny.png');        
        });
        $('.delete_com').on('click', function(){
            var idsp   = $(this).attr('idsp');
            var check = confirm("Bạn có muốn xoá bình luận này");
            if (check) {
                $.ajax({
                    url: 'ajax/ajax.php',
                    type: 'POST',
                    data: {'cmd': 'CMT_OFF', 'idsp': idsp},
                })
                .done(function() {
                    console.log("success");
                });
                $(this).parent().parent().css('display','none');
            }
        });
        $('#btn_delete_selected').on('click', function(){
            var idsp   = $(this).attr('idsp');
            var check = confirm("bạn có thực sự muốn xoá");
            if (check) {
                var i = 0;
                $('#ckxoa_com').each(function(){
                    if($('#ckxoa_com').eq(i).is(':checked') == true) {
                        $.ajax({
                            url: 'ajax/ajax.php',
                            type: 'POST',
                            data: {'cmd': 'CMT_DEL', 'idsp': idsp},
                        })
                        .done(function() {
                            console.log("success");
                        });
                        $(this).parent().parent().css('display','none');
                    }
                    i++;
                });
            }
        });
    });
</script>