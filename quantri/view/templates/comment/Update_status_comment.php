<?php
include 'config_ajax.php';
if(isset($_GET['status']) && isset($_GET['idsp']))
{
    mysqli_query($conn,"update product_comment set status=".$_GET['status']." where id_comment=".$_GET['idsp']);

}


?>