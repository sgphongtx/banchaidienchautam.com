<?php
   $k = isset($_GET['k'])?($_GET['k']) : "";
   if (isset($_POST['s'])) {
      $k=isset($_POST['k'])?$_POST['k']:"";
      header("location:".$linkroot."/tim-kiem/keyword=".$k);
   }
?>
<div class=" search-widget">
   <div class="content-widget">
      <form method="POST" id="searchform" action="" enctype="multipart/form-data">
         <input type="text" name="k" value="" placeholder="<?php echo module_keyword($mang11,$mang22,"keyword");?>"
         onblur="if(this.value=='') this.value='<?php echo module_keyword($mang11,$mang22,"keyword");?>'"
         onfocus="if(this.value =='<?php echo module_keyword($mang11,$mang22,"keyword");?>') this.value=''">
         <button type="submit" name="s"><i class="fa fa-search"></i></button>
      </form>
   </div>
</div>