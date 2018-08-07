<?php
    $rstin=get_records("tbl_ad","status=1 and cate=7 AND idshop='{$idshop}'"," "," "," ");
    if(mysqli_num_rows($rstin)>0){
        if(isset($_COOKIE['cookie_h'])){}
        else{
            setcookie('cookie_h', "home", time()+120, '/' );
?>
<script type="text/javascript">
    var shadow = $('<div id="shadowElem"></div>');
    var speed = 1000;
    $(document).ready(function() {
        $('body').prepend(shadow);
    });
    $(window).load( function() {
        screenHeight = $(window).height();
        screenWidth = $(window).width();
        elemWidth = $('#dropElem').outerWidth(true);
        elemHeight = $('#dropElem').outerHeight(true)
         
        leftPosition = (screenWidth / 2) - (elemWidth / 2);
        topPosition = (screenHeight / 2) - (elemHeight / 2);
         
        $('#dropElem').css({
            'left' : leftPosition + 'px',
            'top' : -elemHeight + 'px'
        });
        $('#dropElem').show().animate({
            'top' : topPosition
        }, speed);
         
        shadow.animate({
            'opacity' : 0.7
        }, speed);
         
        $('#dropClose').click( function() {
            shadow.animate({
                'opacity' : 0
            }, speed);
            $('#dropElem').animate({
            'top' : -elemHeight + 'px'
        }, speed, function() {
                shadow.remove();
                $(this).remove();
            });
             
        });
    });
</script>
<style type="text/css">
#dropElem {
    display: none;
    position: fixed;
    top: 0;
    border-radius: 10px 10px 10px 10px;
    box-shadow: 0 0 25px 5px #999;
    padding: 20px;
    background: #fff;
    z-index: 9;
}
#shadowElem {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: black;
    opacity: 0.3;
    z-index: 9;
}
#dropContent {
    position: relative;
}
#dropClose {
    position: absolute;
    z-index: 99999;
    cursor: pointer;
    top: -32px;
    right: -30px;
    padding: 5px 10px;
    background-color: black;
    border-radius: 6px 6px 6px 6px;
    color: #fff;
}
 
</style>
<div id="dropElem">
    <div id="dropContent">
        <div id="dropClose">X</div>
        <?php $row_quangcaoleft=mysqli_fetch_assoc($rstin); ?>
		<a href="<?php echo $row_quangcaoleft['link']?>" title="" target="_blank">
			<img src="<?php echo $path_image.$row_quangcaoleft['image']; ?>" alt="<?php echo $row_quangcaoleft['name']; ?>" />
		</a> 
    </div>
</div>
<?php } } ?>