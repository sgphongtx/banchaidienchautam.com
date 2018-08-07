<?php
include('../config/.php');

$action = $_POST['action'];
switch($action){
    case 'LOAD_ALL_IMAGE':
        $src_array = $_POST['src_array'];

        break;
}
?>

<ul id="sortable_grid" class="list-inline sortable-grid">
    <?php
    $index_tmp = 0;
    foreach ($src_array as $value) {
        $disabled_sortup = '';
        if($index_tmp == 0){
            $disabled_sortup = 'disabled';
        }

        $disabled_sortdown = '';
        if($index_tmp == count($src_array)-1){
            $disabled_sortdown = 'disabled';
        }
    ?>
        <li data-src="<?php echo $value[1] ?>" data-type="<?php echo $value[0] ?>" class="col-xs-12 col-sm-3">
            <div class="inner">
                <div class="pull-left">
                    <div class="img-thumbnail">
                        <img class="img-responsive" src="<?php echo $img_path . $value[1] ?>">
                    </div>
                    <div class="cmd">

                        <?php
                        if($value[0] == 'IMG_CHILD_MAIN'){
                        ?>
                            <div class="col-xs-12" style="padding-right: 0">
                                <button type="button" class="btn btn-minw btn-success" style="width: 100%;" disabled>SP chính</button>
                            </div>
                        <?php
                        }elseif(substr($value[0], 0, 10) == 'IMG_CHILD_'){
                        ?>
                            <div class="col-xs-12" style="padding-right: 0">
                                <button type="button" class="btn btn-minw" style="width: 100%;" disabled>Phiên bản</button>
                            </div>
                        <?php
                        }else{
                        ?>
                            <div class="col-xs-6">
                                <a href="../filemanager/dialog.php?type=1&amp;field_id=<?php echo $value[0] ?>&amp;relative_url=1&amp;fldr=product" class="iframe-btn btn btn-info">Đổi</a>
                                <input id="<?php echo $value[0] ?>" type="hidden" value="">
                            </div>
                            <div class="col-xs-6">
                                <a href="javascript:;" onclick="delete_img_product_thumbnail('<?php echo $value[0] ?>')" class="btn btn-danger">Xóa</a>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="pull-right" style="width: calc(100% - 122px); padding-left: 3px; height: 100%;">
                    <button type="button" class="btn btn-default" onclick="<?php echo $disabled_sortup == '' ? 'sort_all_image(this, \'UP\')' : '' ?>" style="width: 100%; margin-bottom: 3px" <?php echo $disabled_sortup ?>>
                        <i class="fa fa-chevron-left hidden-xs"></i>
                        <i class="fa fa-chevron-up hidden-sm hidden-md hidden-lg"></i>
                    </button>
                    <button type="button" class="btn btn-default" onclick="<?php echo $disabled_sortdown == '' ? 'sort_all_image(this, \'DOWN\')' : '' ?>" style="width: 100%" <?php echo $disabled_sortdown ?>>
                        <i class="fa fa-chevron-right hidden-xs"></i>
                        <i class="fa fa-chevron-down hidden-sm hidden-md hidden-lg"></i>
                    </button>
                </div>
            </div>
        </li>
    <?php
        $index_tmp++;
    }
    ?>
</ul>