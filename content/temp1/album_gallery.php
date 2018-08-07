<div class="widget widget-static-block bg_slider_images" >
  <div class="slide-news-wrap space-base container">
    <div class="block-title1">
      <div class="h3" style="padding-left:0px;"><a href="">Hình ảnh</a></div>
    </div>
    <div class="block-content">
      <div class="products-grid">
        <div data-owl="slide" data-desksmall="4" data-tabletsmall="2" data-mobile="1" data-tablet="3" data-margin="0" data-item-slide="4" data-ow-rtl="false" data-nav-text="true" data-loop="false" class="owl-carousel owl-theme products-slide product-items same-height clearfix">
          <?php
        $galls = mysqli_query($conn,"SELECT * FROM tbl_image_gallery");
        while ($gall = mysqli_fetch_assoc($galls)) {
      ?>
      <div class="col-xs-12 col-sm-12 col-md-12 royal_2p grid-item branding web-design">
        <div class="gallery-item">
          <div class="gallery-desc">
            <div class="adjust-block">
              <!-- <h4 class="project-title"><?=$gall['name']?></h4> -->
              <a href="<?=$gall['image']?>" class="icon img-popup-page"><i class="fa fa-search-plus"></i></a>
            </div>
          </div>
          <div class="gallery-img">
            <img src="<?=$gall['image']?>" alt="<?=$gall['name']?>">
          </div>
        </div>
      </div>
      <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .gallery-item {
  margin: 0 0 30px 0;
  padding: 0;
  position: relative;
  overflow: hidden;
}
.gallery-item .gallery-desc {
  margin: 0;
  padding: 0;
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  top: 0;
  left: 0;
  z-index: 1;
  opacity: 0;
  overflow: hidden;
  -webkit-transition: all .3s ease;
  -moz-transition: all .3s ease;
  -o-transition: all .3s ease;
  transition: all .3s ease;
}
.gallery-item:hover .gallery-desc, .post-list .product-item:hover .block-post-content {
  opacity: 1;
}
.gallery-item .gallery-desc .adjust-block {
  position: absolute;
  left: 0;
  top: 50%;
  width: 100%;
  text-align: center;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}
.gallery-item .gallery-desc h4.project-title {
  margin: 0 0 20px 0;
  color: #fff;
  -webkit-transform: translateY(0);
  -moz-transform: translateY(0);
  -o-transform: translateY(0);
  -ms-transform: translateY(0);
  transform: translateY(0);
  -webkit-transition: all .5s ease;
  -moz-transition: all .5s ease;
  -o-transition: all .5s ease;
  transition: all .5s ease;
}
.gallery-item .gallery-desc a.icon {
  margin: 0 5px;
  display: inline-block;
  width: 40px;
  height: 40px;
  line-height: 40px;
  font-size: 18px;
  background-color: #eee;
  color: #505050;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  -moz-background-clip: padding-box;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  -webkit-transform: translateY(0);
  -moz-transform: translateY(0);
  -o-transform: translateY(0);
  -ms-transform: translateY(0);
  transform: translateY(0);
  -webkit-transition: all .5s ease;
  -moz-transition: all .5s ease;
  -o-transition: all .5s ease;
  transition: all .5s ease;
}
.gallery-item .gallery-img {
  width: 100%;
  height: auto;
}
.gallery-item .gallery-img img {
  width: 100%;
  height: 100%;
  -webkit-transition: all .5s ease;
  -moz-transition: all .5s ease;
  -o-transition: all .5s ease;
  transition: all .5s ease;
}
.gallery-item:hover .gallery-img img, .post-list .product-item:hover .block-post-img img {
  transform: scale(1.1, 1.1);
}
</style>
