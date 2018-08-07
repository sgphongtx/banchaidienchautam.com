<?php
class Rate{
   var $source;
   var $mydate;

   function getXML(){
      return file_get_contents($this->source);
   }
   function getRate(){
      $xmlData = NULL;
      $p = xml_parser_create();
      xml_parse_into_struct($p,$this->getXML() , $xmlData);
      xml_parser_free($p);
      $this->mydate = $xmlData['1']['value'];
      $data = array();
      if($xmlData){
      foreach($xmlData as $v)
         if(isset($v['attributes'])) {
            $data[] = $v['attributes'];
         }
         return $data;
      }
      return false;
   }
   function show(){
      $data = $this->getRate();
      $return="";
      $return.= '<span style="color:#000">Tỷ giá ngoại tệ Vietcombank ngày : '.$this->mydate.'</span><br />';

      $return.= '<table  class=tbl-01 cellpadding=0 cellspacing=0>';
      $return.= '<tr>';

      $return.= '<th align=center width=35><b>Mã NT</b></th><th align=center width=50><b>Mua</b></th><th align=center width=50><b>CK</b></th><th align=center width=50><b>Bán</b></th>';
      $return.= '</tr>';
      $return.= '</table>';

      foreach($data as $k=>$v){
         $return.= '<table  class=tbl-01 cellpadding=0 cellspacing=0>';
         $return.= '<tr >';
         $return.= '<td align=left width=35 class=even>'.$v['CURRENCYCODE'].' </td><td align=right width=50> '.round($v['BUY']).' </td><td align=right width=50> '.round($v['TRANSFER']).'</td><td align=right width=50>'.round($v['SELL']).'</td>';
         $return.= '</tr>';
         $return.= '</table>';
      }
      return $return;
   }
}
$row_template=get_one_row("tbl_template","","");
?>
<div class="single-widget">
   <h3 class="section-title"> Tỷ giá </h3>
   <div class="content-widget exchange-rate-widget">
      <?php
         if($row_template['statistical']!=''){

            // lấy json statistical từ database ra decode lại về mảng
            $statistical=$row_template['statistical'];
            $arrStatistical=unserialize($statistical);

            // lấy ngày tháng hiện tại và explode ngày tháng cập nhật statistical
            // nếu qua ngày mới && qua 1h => cập nhật bản mới
            // ngược lại vẫn lấy bảng cũ
            $hoursNow=date('G'); $dayNow=date('d'); $monthNow=date('m'); $yearNow=date('Y');
            $dateStatistical=$arrStatistical['date'];
            $arr=explode('/',$dateStatistical);
            $dayS=$arr[0]; $monS=$arr[1]; $yearS=$arr[2];

            if($yearNow>$yearS || ($yearNow==$yearS && $monthNow>$monS) || ($yearNow==$yearS && $monthNow==$monS && $dayNow-$dayS==1 && $hoursNow>=13) || ($yearNow==$yearS && $monthNow==$monS && $dayNow-$dayS>1)){
               $rate = new Rate();
               $rate->source = 'http://www.vietcombank.com.vn/ExchangeRates/ExrateXML.aspx';
               $show = $rate -> show();
               $statistical = array('date' => date('d/m/Y'), 'data' => $show );
               $statistical = serialize($statistical);

               if(mysqli_query($conn,"update tbl_template set statistical='".$statistical."'"))
                  echo $show;
            } else {
                  echo $arrStatistical['data'];
            }
         } else {
            $rate = new Rate();
            $rate->source = 'http://www.vietcombank.com.vn/ExchangeRates/ExrateXML.aspx';
            $show=$rate->show();
            $statistical = array('date'=>date('d/m/Y'), 'data'=>$show );
            $statistical=json_encode($statistical);

            if(mysqli_query($conn,"update tbl_template set statistical='".$statistical."'"))
               echo $show;
         }
      ?>
   </div>
</div>
