<div class="content bg-gray-lighter">
   <div class="row items-push">
      <div class="col-sm-7">
         <h1 class="page-heading">Danh sách tiền tệ</h1>
      </div>
      <div class="col-sm-5 text-right hidden-xs">
         <ol class="breadcrumb push-10-t">
            <li><a href="<?=url_direct()?>">Quản trị</a>
            </li>
            <li>Danh sách tiền tệ</li>
         </ol>
      </div>
   </div>
</div>
<div class="content">
   <div class="row">
      <div class="col-sm-12">
         <div class="block">
            <div class="block-header bg-gray-lighter">
               <span class="block-title">Danh sách tiền tệ</span>
               <ul class="block-options">
                  <button class="ctr rf btn btn-success btn-xs" type="button"><a href="<?=url_direct("get","currency_refresh")?>"><i class="fa fa-refresh"></i> Cập nhật tỉ giá</a></button>
                  <button onclick="location.href='<?=url_direct('add')?>'" class="btn btn-primary btn-xs" type="button"><i class="fa fa-plus"></i> Tạo mới</button>
               </ul>
            </div>
            <!-- .block-content -->
            <div class="block-content">
               <div class="block-content-top" style="margin-bottom: 20px;">
                  <form method="POST" action="" name="frmForm" enctype="multipart/form-data">
                     <div class="dataTable_filter">
                        <div class="row">
                           <div class="col-md-4">
                              <input name="tukhoa" type="text" class="form-control" id="tukhoa" value="Tìm kiếm..." style="display: inline-block; width: auto; margin-right: 5px;" />
                              <button type="submit" name="tim" class="btn btn-default">
                                 <i class="fa fa-search"></i>
                              </button>
                              <button type="submit" name="reset" class="btn btn-default">
                                 <i class="fa fa-refresh"></i>
                              </button>
                           </div>
                           <div class="col-md-5 pull-right">
                              <?php if ($_REQUEST[ 'code']==1) { ?>
                              <div class="alert alert-success" style="margin-bottom: 0px;">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>Cập nhật thành công
                              </div>
                              <?php } ?>
                              <?php if ($errMsg1 !='' ) { ?>
                              <div class="alert alert-success" style="margin-bottom: 0px;">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                 <?=$errMsg1?>
                              </div>
                              <?php } elseif ($errMsg2 !='' ) { ?>
                              <div class="alert alert-danger" style="margin-bottom: 0px;">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                 <?=$errMsg2?>
                              </div>
                              <?php } elseif ($errMsg3 !='' ) { ?>
                              <div class="alert alert-warning" style="margin-bottom: 0px;">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                 <?=$errMsg3?>
                              </div>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
               <!-- /block-content-top -->

               <div class="table-responsive">
                  <form method="POST" action="#" name="frmForm" enctype="multipart/form-data">
                     <input type="hidden" name="act" value="<?=$_REQUEST['act']?>" />
                     <input type="hidden" name="page" value="<?=$_REQUEST['pageNum']?>" />
                     <table class="table table-hover table-bordered datatable">
                        <thead>
                           <tr>
                              <td style="width: 1px;" class="text-center">
                                 <input type="checkbox" name="chk[]" class="tai_c" id="chkall" value="<?php echo $row['id']?>" />
                              </td>
                              <td class="text-center" width="20%">Tiêu đề</td>
                              <td class="text-center" width="7%">Mã</td>
                              <td class="text-center" width="20%">Tỉ giá <span data-toggle="tooltip" data-placement="top" title="Tỉ giá so với đồng USD" class="glyphicon glyphicon-question-sign"></span>
                              </td>
                              <td class="text-center" width="20%">Lần thay đổi cuối</td>
                              <td class="text-center" width="10%">Trạng thái</td>
                              <td class="text-center" width="20%">Thao tác</td>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $sql       = "SELECT * FROM tbl_currency WHERE status=1 ORDER BY id DESC";
                              $result    = mysqli_query($conn,$sql);
                              while($row = mysqli_fetch_array($result)) :
                           ?>
                           <tr>
                              <td class="text-center"><input type="checkbox" name="chk[]" class="tai_c" value="<?=$row['id']?>" /></td>
                              <td class="text-center"><?=$row['title']?></td>
                              <td class="text-center"><?=$row['code']?></td>
                              <td class="text-center"><?=number_format($row['value'],2)?></td>
                              <td class="text-center"><?=$row['date_modified']?></td>
                              <td class="text-center"><div class="check tool <?php echo $row['status']==1?'active':'' ?>" data-action='toggleStatus' data-field='status' data-table='tbl_currency' title="Ẩn hiện" value="<?=$row['id']?>"></div></td>
                              <td class="text-center">
                                 <?php if ($row['code']!='USD') { ?>
                                 <a href="<?=url_direct('edit',$_GET['act'],'_m','&page='.$_REQUEST['pageNum'].'&id='.$row['id'])?>" title="Sửa" class="btn btn-xs btn-pencil btn-primary">
                                    <i class="fa fa-pencil"></i>
                                 </a>
                                 <a href="<?=url_direct('del',$_GET['act'],null,'&action=del&page='.$_REQUEST['pageNum'].'&id='.$row['id'])?>" title="Xóa"  onclick="return confirm('Bạn có muốn xoá luôn không ?');"  class="btn btn-xs btn-remove btn-danger">
                                    <i class="fa fa-trash"></i>
                                 </a>
                                 <?php } ?>
                              </td>
                           </tr>
                           <?php endwhile; ?>
                        </tbody>
                        <tfoot>
                           <tr>
                              <td class="text-center">
                                 <button type="submit" name="btnDel" class="btn btn-danger btn-xs" onClick="return confirm('Bạn có chắc chắn muốn xóa ?');"> <i class="fa fa-trash"></i>
                                 </button>
                              </td>
                              <td colspan="6"></td>
                           </tr>
                        </tfoot>
                     </table>
                  </form>
               </div>
            </div>
            <!-- .block-content -->
         </div>
      </div>
   </div>
</div>

<script language="JavaScript">
function chkallClick(o) {
   var form = document.frmForm;
   for (var i = 0; i < form.elements.length; i++) {
      if (form.elements[i].type == "checkbox" && form.elements[i].name!="chkall") {
         form.elements[i].checked = document.frmForm.chkall.checked;
      }
   }
}
</script> 

<script>
$(document).ready(function() {  
    
   $("#chkall").click(function(){
      var status=this.checked;
      $("input[class='tai_c']").each(function(){this.checked=status;})
   });
    
});
</script>

<style type="text/css" media="screen">
ul.block-options * {
  color: #fff;
}  
</style>