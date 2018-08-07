<!-- FB chat -->
	<div class="support-icon-right">
<h3><i class="fa fa-hand-o-right"></i> Chat Live Facebook</h3>
<div class="online-support">
<div
class="fb-page"
data-href="<?php echo $row_config["box_face"]; ?>"
data-small-header="true"
data-height="300"
data-width="250"
data-tabs="messages"
data-adapt-container-width="false"
data-hide-cover="false"
data-show-facepile="false"
data-show-posts="false">
</div>
</div>
</div>
<script type="">
	 $(document).ready(function(){
  $('.online-support').hide();
  $('.support-icon-right h3').click(function(e){
    e.stopPropagation();
    $('.online-support').slideToggle();
  });
  $('.online-support').click(function(e){
    e.stopPropagation();
  });
  $(document).click(function(){
    $('.online-support').slideUp();
  });
});
</script>
<style type="text/css">
	.support-icon-right {
    background: #F0F3EF;
    position: fixed;
    right: 0;
    bottom: 0;
    z-index: 9;
    overflow: hidden;
    width: 250px;
    color: #fff!important;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -ms-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}

.support-icon-right h3 {
    text-transform: uppercase;
    font-weight: bold;
    font-size: 13px!important;
    font-family: Arial;
    color: #fff!important;
    margin: 0!important;
    background-color: #3b5998;
    cursor: pointer;
}

.support-icon-right i {
    background-color: #D9534F;
    padding: 15px 15px 12px 15px;
}
.online-support {
    display: none;
}
</style>
	<!-- fb chat -->