


<?php
$so=1;
    $row_video_1=get_one_row("tbl_video","status=1 and idshop='".$idshop."'","");
    if($row_video_1['id']!=''){
        $rs_video=get_records("tbl_video","status=1 AND idshop='{$idshop}' and id<>".$row_video_1['id']," "," "," ");
        $LK1 = explode("=",$row_video_1['link']);
            $ls1=$LK1[1];
        $LK2 = explode("&",$ls1);
            $kq_video=$LK2[0];
?>
<div class="single-widget page-single-widget">
   <div class="title-page">
      Video-Clip
  </div>
   <div class="video-widget">
      <div class="vide_mau_gh">
            <iframe class="embed-responsive-item" id="iframe_video" width="100%" height="260px" src="https://www.youtube.com/embed/<?php echo $kq_video; ?>" frameborder="0" allowfullscreen></iframe>
            <select class="select_video" style="width: 100%; height: 25px; display: block; margin-top:10px;">
                <option>---chọn Video---</option>
                <option value="https://www.youtube.com/embed/<?php echo $kq_video; ?>"><?=$row_video_1['name']?></option>
            <?php
                $dem=0;
                while($row_video=mysqli_fetch_assoc($rs_video)){
                    $LK1 = explode("=",$row_video['link']);
                        $ls1=$LK1[1];
                    $LK2 = explode("&",$ls1);
                        $kq_video=$LK2[0];
            ?>
                <option value="https://www.youtube.com/embed/<?php echo $kq_video; ?>"><?=$row_video['name']?></option>
            <?php } ?>
            </select>
        <?php } ?>

        </div><!-- End .vide_mau_gh -->
   </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select_video').change(function(event) {
            var link=$(this).val();
            $('#iframe_video').attr('src',link);
        });
    });
</script>
