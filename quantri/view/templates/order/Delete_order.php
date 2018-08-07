<?php

include('../../../../systems/database/database.php');

if($_GET['iddonhang'])
{
    if(mysqli_query($conn,"delete from tbl_donhang where id=".$_GET['iddonhang']))
        echo 'Xoá thành công';
    else
        echo 'Xoá không thành công';
}
?>