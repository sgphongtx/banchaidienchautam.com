function goBack() {
   window.history.back();
}
// function linkto(act){
//    window.location.href = root+'/quantri/?act='+act;
// }
// function to_href(link){
//    window.location.href = root+'/quantri/'+link;
// }
function to_href2(link){
   window.open(link);
}
function readURL(input) {
   if (input.files && input.files[0]) {
      var reader = new FileReader();            
      reader.onload = function (e) {
         $('#blah').attr('src', e.target.result);
      }            
      reader.readAsDataURL(input.files[0]);
   }
}

function responsive_filemanager_callback(field_id){
   var url=jQuery('#'+field_id).val();
   if(field_id == 'fieldID')
      jQuery('#'+field_id).closest('.input-group').find('img').attr('src', url);
   else
      jQuery('#'+field_id).closest('.input-group').find('img').attr('src', url);
}

function delete_img_product_thumbnail(field_id){
   jQuery('#'+field_id).val('');
   jQuery('#'+field_id).closest('.input-group').find('img').attr('src', '/uploads/others/default.png');
}

function bodauTiengViet(str) {
   str = str.toLowerCase();
   str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
   str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
   str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
   str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
   str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
   str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
   str = str.replace(/đ/g,"d");
   return str;
}
$(document).ready(function() {
    
   $('.nav-header.pull-right > li div.btn-group button.btn.btn-default.btn-image').click(function(){
      $(this).parent('.btn-group').toggleClass('open');
   });

   /**/

   $(".tool").on('click', function(){
      var id = $(this).attr("value");
      var table  = $(this).attr('data-table');
      var field  = $(this).attr('data-field');
      var action = $(this).attr('data-action');
      var $this = $(this);
      var data = {'action': action, 'item': id, 'field': field, 'table': table};
      $.ajax({
         url: 'ajax/ajax.php',
         type: 'POST',
         dataType: 'html',
         data: {'data': data, 'cmd': 'BTN_ACTIVE_STAT'},
      })
      .done(function(result) {
         if(result=='1') $this.toggleClass('active');
      });
   });


   $('.iframe-btn').fancybox({
      'width'   : 880,
      'height'  : 570,
      'type'    : 'iframe',
      'autoScale'   : false
   });

});

var html = '<option value="0">-- Chọn --</option>';
function get_parent(menu, parent_id, current_id, current_parent_id, string) {

   // Bước 1
   if (string == undefined) string = '|--';
   var loop = new Array();
   var contin = new Array();

   for (var i = 0; i < menu.length; i++) {

      // trường hợp current_id == menu[i].menu_id không lấy chính nó làm menu cha trong option
      // trường hợp current_id == menu[i].menu_parent_id
      if (current_id == menu[i].menu_id || current_id == menu[i].menu_parent_id) {
         // do not thing
      } else if (menu[i].menu_parent_id == parent_id) {
         loop.push(menu[i]);
      } else {
         contin.push(menu[i]);
      }

   }

   // Bước 2
   for (var i = 0; i < loop.length; i++) {
      html += '<option ' + ((current_parent_id == loop[i].menu_id) ? 'selected' : '') + ' value="' + loop[i].menu_id + '">' + string + loop[i].menu_name + '</option>';
      get_parent(contin, loop[i].menu_id, current_id, current_parent_id, string + '|--');
   }
}
function get_parent_m(menu, parent_id, current_id, current_parent_id, string) {

   // Bước 1
   if (string == undefined) string = '|--';
   var loop = new Array();
   var contin = new Array();

   for (var i = 0; i < menu.length; i++) {
      
      if (menu[i].menu_parent_id == parent_id) {
         loop.push(menu[i]);
      } else {
         contin.push(menu[i]);
      }

   }

   // Bước 2
   for (var i = 0; i < loop.length; i++) {
      html += '<option ' + ((current_parent_id == loop[i].menu_id) ? 'selected' : '') + ' value="' + loop[i].menu_id + '">' + string + loop[i].menu_name + '</option>';
      get_parent_m(contin, loop[i].menu_id, current_id, current_parent_id, string + '|--');
   }
}