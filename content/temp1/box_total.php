<?php
if (!isset($_SESSION['ipAdress'])) {
   $_SESSION['ipAdress'] = " ";
}
$maxtime = 60 * 30;
mysqli_query($conn,"delete from tbl_visitor where UNIX_TIMESTAMP(activity) < UNIX_TIMESTAMP(now())-$maxtime");
$humnay = date("Y-m-d");
$namnay = date("Y");
$thangnay = date("n");
$thu = date("N");
$heso = get_field("tbl_module", "idshop", $idshop, "heso");
if ($heso == "" || $heso <= 0) {
   $heso = 1;
}
if(isset($_SESSION['ipAdress']) && check_table("tbl_visitor","session_id='".session_id()."'","ip_address")==true) {
   unset($_SESSION['online']);
   unset($_SESSION['ipAdress']);
}
if (!isset($_SESSION['online']) && $_SESSION['ipAdress'] != getIpAddress()) {
   $_SESSION['ipAdress'] = getIpAddress();
   $row_count = getRecord("tbl_count", "idshop='".$idshop."'");
   mysqli_query($conn,"insert into tbl_visitor (session_id, idshop , activity, ip_address, url, user_agent) values ('".session_id()."','$idshop', now(), '{$_SERVER['REMOTE_ADDR']}', '{$_SERVER['REQUEST_URI']}', '{$_SERVER['HTTP_USER_AGENT']}')");
   /*------*/
   if (get_field("tbl_count", "idshop", $idshop, "total") == "")
      mysqli_query($conn,"insert into tbl_count (idshop , total ,datenow,yearnow) values ('$idshop', '".$heso."', '".$humnay."', '".$namnay. "')");
   else
      mysqli_query($conn,"update tbl_count set total=total+".$heso." where idshop=".$idshop);
   /*------*/
   if ($row_count['yearnow'] != $namnay)
      // chuyển từ năm cũ sang năm mới => set yearnow = năm nay, yearold = year , tháng 1 đến tháng 12 = 0
      mysqli_query($conn,"update tbl_count set yearold=year, year='".$heso."',yearnow='".$namnay."', month1=0, month2=0, month3=0, month4=0, month5=0, month6=0, month7=0, month8=0, month9=0, month10=0, month11=0, month12=0, where idshop=".$idshop);
   else
      mysqli_query($conn,"update tbl_count set year=year+".$heso. " where idshop=".$idshop);
   /*------*/
   mysqli_query($conn,"update tbl_count set month".$thangnay."=month".$thangnay."+".$heso." where idshop=".$idshop);
   /*------*/
   if (get_field("tbl_count", "idshop", $idshop, "datenow") == $humnay) {
      mysqli_query($conn,"update tbl_count set today".$thu."=today".$thu."+".$heso." where idshop=".$idshop);
      mysqli_query($conn,"update tbl_count set yearnow=".$namnay." where idshop=".$idshop);
   } else {
      if ($thu == 1) {
         // chuyển từ chủ nhật qua thứ 2 => set thứ 2 = $heso , thứ 3 đến chủ nhật = 0
         mysqli_query($conn,"update tbl_count set today1='".$heso."', today2=0, today3=0, today4=0, today5=0, today6=0, today7=0 where idshop=".$idshop);
      } else {
         // do chuyển từ chủ nhật qua thứ 2 đã set các ngày trong tuần = 0 => chỉ cần cập nhật các ngày trong tuần + $heso
         mysqli_query($conn,"update tbl_count set today".$thu."='".$heso."' where idshop=".$idshop);
      }
      /*------*/
      mysqli_query($conn,"update tbl_count set today=".$heso." where idshop=".$idshop);
      mysqli_query($conn,"update tbl_count set datenow='".$humnay."' where idshop=".$idshop);
   }
} else {
   if (isset($_SESSION['online']) && $_SESSION['ipAdress'] != getIpAddress()) {
      if (check_table("tbl_visitor", "session_id='".session_id()."'", "ip_address") == false) {
         mysqli_query($conn,"update tbl_visitor set activity=now(), member='y' where session_id='".session_id()."'");
         mysqli_query($conn,"update tbl_count set today=today+".($heso * 1)." where idshop=".$idshop);
         mysqli_query($conn,"update tbl_count set today".$thu."=today".$thu."+".$heso." where idshop=".$idshop);
         mysqli_query($conn,"update tbl_count set month".$thangnay."=month".$thangnay."+".$heso." where idshop=".$idshop);
         mysqli_query($conn,"update tbl_count set yearnow=".$namnay." where idshop=".$idshop);
      } else {
         mysqli_query($conn,"insert into tbl_visitor (session_id, idshop , activity, ip_address, url, user_agent) values ('".session_id()."','$idshop', now(), '{$_SERVER['REMOTE_ADDR']}', '{$_SERVER['REQUEST_URI']}', '{$_SERVER['HTTP_USER_AGENT']}')");
         mysqli_query($conn,"insert into tbl_visitor2 (session_id, idshop , activity, ip_address, url, user_agent) values ('".session_id()."','$idshop', now(), '{$_SERVER['REMOTE_ADDR']}', '{$_SERVER['REQUEST_URI']}', '{$_SERVER['HTTP_USER_AGENT']}')");
      }
      //neu ko ton tai sess id nay trong visitter thi them lai cho no 1 lan xem
   }
}
$guest = countRecord("tbl_visitor", "idshop=".$idshop);
$rConfig = getRecord('tbl_count', "idshop =".$idshop);
$total_visits = $rConfig['total'];
$total_visits_today = $rConfig['today'.$thu] != 0 ? $rConfig['today'.$thu] : $heso;
$total_visits_month = $rConfig['month'.$thangnay];
$total_week = 0;
for ($n = 1; $n < $thu; $n++) {
   $total_week += $rConfig['today'.$n];
}
$total_week += $total_visits_today;
$total_t = $rConfig['total'];
?>
<div class="single-widget statistic-widget">
   <div class="h3 section-title">
      <?php echo module_keyword($mang11,$mang22,"box_total");?>
   </div>
   <div class="content-widget">
      <table class="wrap_total">
			<tr>
			  	<td class="label online"><?=module_keyword($mang11, $mang22, 'useronline')?></td>
			  	<td class="value"><?php if ($guest<=0) { echo "1"; } else { echo $guest * $heso;} ?></td>
			</tr>
			<tr>
				<td class="label today"><?=module_keyword($mang11, $mang22, 'usertoday')?></td>
				<td class="value"><?php echo $total_visits_today * $heso;?></td>
			</tr>
			<tr>
			  	<td class="label week"><?=module_keyword($mang11, $mang22, 'userthisweek')?></td>
			  	<td class="value"><?php echo $total_week * $heso; ?></td>
			</tr>
			<tr>
			  	<td class="label month"><?=module_keyword($mang11, $mang22, 'userthismonth')?></td>
			  	<td class="value"><?php echo $total_visits_month * $heso; ?></td>
			</tr>
         <tr>
            <td class="label total"><?=module_keyword($mang11, $mang22, 'totalvisit')?></td>
            <td class="value"><?php echo $total_visits * $heso; ?></td>
         </tr>
      </table>
      <?php $_SESSION['ipAdress'] = getIpAddress(); ?>
   </div>
</div>