<div class="col-xs-12">
   <div class="row">
      <div id="comments">
         <?php 
            $query = mysqli_query($conn, "select *, date_format(date_now, '%d-%m-%Y %H:%m') as dateAdd from product_comment where id_product=".$row[ 'id']." and idshop=".$idshop." and status=1 order by id_comment asc");
            if (mysqli_num_rows($query)> 0) { ?>
         <!-- List comment -->
         <h4> Bình luận </h4>
         <ol class="comment-list">
            <?php while($row = mysqli_fetch_array($query)) { ?>
            <li class="comment row">
               <div class="col-md-2 col-sm-2 hidden-xs">
                  <figure class="thumbnail">
                     <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg">
                     <figcaption class="text-center">
                        <?=$row[ 'name']?>
                     </figcaption>
                  </figure>
               </div>
               <div class="col-md-10 col-sm-10">
                  <div class="panel panel-default arrow left">
                     <div class="panel-body">
                        <header class="text-left">
                           <div class="comment-user">
                              <i class="fa fa-user"></i>
                              <?=$row[ 'name']?>
                           </div>
                           <time class="comment-date" datetime="<?=$row['date_now']?>">
                              <i class="fa fa-clock-o"></i>
                              <?=$row[ 'dateAdd']?>
                           </time>
                        </header>
                        <div class="comment-post">
                           <p>
                              <?=$row[ 'content']?>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </li>
            <?php } ?>
         </ol>
         <?php } ?>
         <div class="clearfix"></div>
         <!-- Form comment -->
         <div id="respond">
            <h4>Để lại bình luận</h4>
            <div class="commentform" id="commentform">
               <div id="comment-success"></div>
               <div class="form-group">
                  <input type="text" name="author" id="author" value="<?=$_SESSION['kh_shop_login_id']!='' ? get_field('tbl_customer_shop','id',$_SESSION['kh_shop_login_id'],'name'): ''?>" placeholder="Tên*" class="form-control">
               </div>
               <div class="form-group">
                  <input type="text" name="email" id="email" value="<?=$_SESSION['kh_shop_login_id']!='' ? get_field('tbl_customer_shop','id',$_SESSION['kh_shop_login_id'],'email'): ''?>" placeholder="Email*" class="form-control">
               </div>
               <div class="form-group">
                  <textarea name="comment" id="comment" placeholder="Viết bình luận của bạn ở đây..." class="form-control"></textarea>
               </div>
               <div class="comment_submit_wrap">
                  <i class="fa fa-hand-o-right"></i>
                  <input type="submit" name="submit" id="submit" idsp="<?=$rowtin['id']; ?>" value="Gửi bình luận">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
$(function() {
    $('#submit').click(function(event) {
   var name = $('#author').val(),
      email = $('#email').val(),
      comment = $('#comment').val(),
      idsp = $(this).attr('idsp'),
      idshop = <?= $idshop ?> ;
   var emailfilter = /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/;
   var checkemail = emailfilter.test(email)
   if (name == '') {
      alert('Vui lòng nhập "Tên"');
      $('#author').focus();
      return false;
   }
   if (email == '') {
      alert('Vui lòng nhập "Email"');
      $('#email').focus();
      return false;
   }
   if (!checkemail) {
      alert('"Email" không đúng định dạng (example@domain.com)');
      $('#email').focus();
      return false;
   }
   if (comment == '') {
      alert('Vui lòng nhập "Nội dung"');
      $('#comment').focus();
      return false;
   }
   $.ajax({
      url: '<?=$linkroot;?>/content/<?php echo $template ?>/Add_comment_ajax.php',
      type: 'GET',
      dataType: 'html',
      data: {
         'idsp': idsp,
         'name': name,
         'email': email,
         'comment': comment,
         'idshop': idshop,
         'type': 'addcmt'
      },
   })
   .done(function(data) {
      $('#comment-success').html(data);
   })
});
});
</script>