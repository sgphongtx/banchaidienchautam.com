<div class="page-video">
        <?php
            $rs_video = get_result("tbl_video", "status=1", "", "0,5");
            $arr_video = array();
            while($row_video = mysqli_fetch_assoc($rs_video)) :
                $arr_video[] = $row_video;
            endwhile;
        ?>
        <div class="container">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="page-single-widget facebook-plugin-widget">
                   <div class="title-page">
                      <?php echo module_keyword($mang11,$mang22,"box_likefacebook");?>
                   </div>
                   <div class="content-widget no-padding">
                        <div class="fb-page" data-href="<?php echo $row_config["box_face"]; ?>" data-tabs="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="<?php echo $row_config["box_face"]; ?>" class="fb-xfbml-parse-ignore"><a href="<?php echo $row_config["box_face"]; ?>">Webmau.vn</a></blockquote>
                        </div>
                   </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="page-single-widget news-widget">
                    <div class="title-page">
                        <?php echo module_keyword($mang11,$mang22,"box_news");?>
                    </div>
                    <div class="content-widget">
                        <ul class="list-post" id="scroller"> 
                            <?php
                                $result = get_records("tbl_item","cate=2 and status=1 and parent=20","id DESC","0,10",$lang);
                                while ($row = mysqli_fetch_assoc($result)) :
                            ?>
                            <li class="post-item">
                                <div class="ma-item">
                                    <div class="item-content">
                                        <div class="pull-left post-images col-md-4 col-sm-4 col-xs-4" style="padding: 0;">
                                            <a class="post-image" href="/<?php echo $row['subject']; ?>.html" title="<?php echo $row['name']; ?>">
                                                <img src="<?php echo $path_image.$row['image']; ?>" alt="<?php echo $row['name']; ?>">
                                            </a>
                                        </div>
                                        <div class="post-des col-md-8 col-sm-7 col-xs-7" style="padding: 0;">
                                            <h4 class="post-name">
                                                <a class="post-image" href="/<?php echo $row['subject']; ?>.html" title="<?php echo $row['name']; ?>">
                                                    <?php echo $row['name']; ?>
                                                </a>
                                            </h4>
                                            <p><?php echo catchuoi_tuybien($row['detail_short'],18); ?></p>

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                </div
                            </li>
                            <?php endwhile; ?>
                        </ul>        
                    </div>
                </div>
            </div>
            <div class="product-page col-md-4 col-sm-4 col-xs-12">
                <?/* <div class="page-single-widget">
                    <div class="title-page">
                        Video-Clip
                    </div>
                    <div class="category-products">
                        <div class="products-grid">
                        <?php if(count($arr_video) > 0) : ?>
                            <div class=" video-container">
                                <div class="video-content video-first">
                                    <div class="embed-responsive embed-responsive-4by3">
                                        <iframe class="embed-responsive-item" src="<?php echo get_video_youtobe($arr_video[0]['link']); ?>?autoplay=0"></iframe>
                                    </div>
                                </div>
                                <div class="video-more clearfix margin-0-xs-o">
                                    <?php
                                        $c = 0;
                                        foreach($arr_video as $row_video) :
                                    ?>
                                    <div class="padding-5 video-thumb same-height clearfix" data-video="<?php echo get_video_youtobe($row_video['link']); ?>?autoplay=0">
                                       
                                        <div class="video-thumb-info " style="margin-top:5px; cursor: pointer;">
                                            <div><a><?php echo $row_video['name'] ?></a></div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $('.video-thumb').click(function(){
                                        var video = $(this).data('video');
                                        $(this).closest('.video-container').find('.video-first .embed-responsive-item').attr('src', video);
                                    })
                                })
                            </script>
                        <?php endif; ?>
                        </div>
                    </div>
                </div> */?>
                <?php include("content/temp1/box_video1.php"); ?>
            </div>
        </div>
</div>

<script type="text/javascript">
(function($) {
	$(function() {
		$("#scroller").simplyScroll({orientation:'vertical',customClass:'vert'});
	});
})(jQuery);
</script>