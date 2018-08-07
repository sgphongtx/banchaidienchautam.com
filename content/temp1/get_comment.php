<?php
include('config_ajax.php');
$id = isset($_GET['idsp']) ? $_GET['idsp'] : '';
$ids = isset($_GET['idshop']) ? $_GET['idshop'] : '';
$query_count = mysqli_query($conn,"select * from product_comment where id_product=".$id." and idshop=".$ids);
$count = mysqli_num_rows($query_count);
if($count > 10)
{
    $count2 = $count - 5;
    $query = mysqli_query($conn,"select * from product_comment where id_product=".$id." and idshop=".$ids." order by id_comment asc limit ".$count2.",".$count."");
}
else
    $query = mysqli_query($conn,"select * from product_comment where id_product=".$id." and idshop=".$ids." order by id_comment asc");
?>
<ul>
<?php
while($row = mysqli_fetch_array($query))
{
?>
        <li>
            <div class="content_comment" style="float: left;">
                <div class="comment_author"><b><?php echo $row['name']; ?></b> said :</div>
                <?php if($row['status'] == 0) echo '<em>Bình luận của bạn đang chờ duyệt</em><br />';?>
                <div class="comment_meta"><?php echo $row['date_now']; ?></div>
                <div class="content_author"><?php echo $row['content']; ?></div>
            </div>
            <div class="image_comment" style="float: right;">
                <img src="../../images/icon/Capture.png" width="60" height="60" />
            </div>
            <div class="clearfix"></div>
        </li>
<?php
}
?>
</ul>
