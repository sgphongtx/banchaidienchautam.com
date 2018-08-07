<script type="text/javascript">
function myClock(idClock, startTime) {
	var timeout=1000;
	if (startTime === undefined ) {
		rightNow = new Date();
		var rN = rightNow.toLocaleString('en-GB', { timeZone: 'Asia/Jakarta' });
		var arr1 = rN.split(",");
		var arr2 = arr1[1].split(" ");
	}
	currentTime = arr2[1];
	document.getElementById(idClock).innerHTML = currentTime;

	if (startTime===undefined) setTimeout("myClock('"+idClock+"')",timeout);
	else setTimeout("myClock('"+idClock+"','"+currentTime+"')",timeout);
}
</script>
<div class="single-widget date-now-widget">
   <div class="h3 section-title">
      <?php echo module_keyword($mang11,$mang22,"box_date_now");?>
   </div>
   <div class="content-widget">
		<div id="clock" class="clock">clock</div>  
		<script  type='text/javascript'> myClock("clock"); </script>  
		<div class="datetime">
        	<script type="text/javascript">  
            dayName = new Array ("Chủ nhật","Thứ hai","Thứ ba","Thứ tư","Thứ năm","Thứ sáu","Thứ bảy")
            monName = new Array ("01","02","03","04","05","06","07","08","09","10","11","12")
            now = new Date
            document.write("<b>"+dayName[now.getDay()]+ ", " +now.getDate()+ "/" +monName[now.getMonth()]+ "/" +now.getFullYear()+"</b>")
        </script>
		</div>
		<div class="clearfix"></div>
   </div>
</div>
