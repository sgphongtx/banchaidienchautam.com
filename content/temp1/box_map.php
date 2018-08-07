<div class=" maps-widget">
   <div class="content-widget">
      <div class="map-responsive">
         <?php
            $result = get_records("tbl_map","status=1","id DESC"," "," ");
            while ($row = mysqli_fetch_assoc($result)) :
               echo $row['detail']; 
            endwhile; 
         ?>
      </div>
   </div>
</div>
