<?php include("include/doc_head.php");?>
    
<?php include ("include/navigation.php");?>
    <div class="row">
      <div class="small-12 columns">
      <h2>List of Events</h2>
      <a class = "button" href="add_event.php"> Add a New Event</a>
     <?php
     /**
      * Calculates the great-circle distance between two points, with
      * the Haversine formula.
      * @param float $latitudeFrom Latitude of start point in [deg decimal]
      * @param float $longitudeFrom Longitude of start point in [deg decimal]
      * @param float $latitudeTo Latitude of target point in [deg decimal]
      * @param float $longitudeTo Longitude of target point in [deg decimal]
      * @param float $earthRadius Mean earth radius in [m]
      * @return float Distance between points in [m] (same as earthRadius)
      */
     function haversineGreatCircleDistance(
       $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
     {
       // convert from degrees to radians
       $latFrom = deg2rad($latitudeFrom);
       $lonFrom = deg2rad($longitudeFrom);
       $latTo = deg2rad($latitudeTo);
       $lonTo = deg2rad($longitudeTo);

       $latDelta = $latTo - $latFrom;
       $lonDelta = $lonTo - $lonFrom;

       $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
         cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
       return $angle * $earthRadius;
     }

     ?>
       <h4>Filter by Coordinates</h4>
         <form method="POST">
           <div class="row">
             <div class="large-6 columns">
               <label>Latitude
                 <input type="text" name="lat"  />
               </label>
             </div>
             <div class="large-6 columns">
               <label>Longitude
                 <input type="text" name="long"  />
               </label>
             </div>
           </div>
           <button type="submit">Submit</button>
         </form>
         <hr/>
         <?php
          
         // adjust these parameters to match your installation
         $cb = new Couchbase($CBSERVER, $CBUSER, $CBPASS, "events");
         $viewResult = $cb->view("events", "listAll");
         // echo "<pre>";
         // print_r($viewResult); 
         // echo "</pre>";
          unset($distance);
         if ($_POST) {
          $distance = 0;
          
         }
         ?>

      <?php
       
      foreach ($viewResult["rows"] as $key => $value) {
        $out = $value["value"];

        if (isset($distance)) {
          $distance = haversineGreatCircleDistance(floatval($_POST["lat"]),floatval($_POST["long"]),$out["latitude"], $out["longitude"]);
          if ($distance > 5000) {
            // distance greater than 5 km, so skip
            continue;
          }
        }

        if ($_SESSION["type"] == "organization" && $_SESSION['email'] != $out["owner"]) {
          // only show items were user has access
          continue;
        }

        echo '<div class="panel">';
        echo '<div class="small-4 columns">';
        if ($out["profileimage"]) {
          $image = '<img src="data:image/jpg;base64,'.$out["profileimage"].'" />';
        } else {
          $image = '<img src="http://placehold.it/150" />';
        }
        echo $image;
        echo "</div>";
        echo '<div class="small-6 columns">';
        echo "<h3>".$out["title"]."</h3>";
        echo "<h4>".$out["organization"]."</h4>";
        echo "<p>".$out["description"]."</p>";
        echo '</div>';
        echo '<div>';
        echo '<a class = "button" href="event.php?id='.convertToKey($out["title"]).'"> More Information</a> ';
        echo '<a class = "button" href="add_event.php?edit=1&id='.convertToKey($out["title"]).'"> Modify</a>';
        echo "</div>";
        echo "</div>";
      } 
      ?>
      	</div></div>
    
<?php include("include/doc_footer.php");?>
