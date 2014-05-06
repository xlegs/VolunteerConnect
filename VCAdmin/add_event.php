<?php include("include/doc_head.php");?>
<?php include ("include/navigation.php");?>
<div class="row">
  <div class="small-12 columns">
    <h2>Add an Event</h2>
    <?php
    if ($_POST["title"]) {
      $_POST = array_map_recursive ("trim", $_POST);

      $newEntry = $_POST;

      // adjust these parameters to match your installation
      $cb = new Couchbase($CBSERVER, "", "", "events");
      $r = $cb->view($_GET['id']);

      $cb2 = new Couchbase($CBSERVER, "", "", "organizations");

      include("include/upload_images.php");

      try {
        $viewResult = $cb2->view(getOrganizationKey($_POST['organization']));
      } catch (CouchbaseException $e) {
        echo "<h3>Organization ".$_POST['organization']." does not exist. Please verify that the organization is spelled correctly and try again. The event has not been added. </h3>";
        include("include/doc_footer.php");
        exit (1);
      }

      echo "<h3>Event Successfully Added</h3>";
      $viewResult["events"][] = $_POST["title"];
      $newEntry["owner"] = $viewResult["username"];
      $cb -> set(convertToKey($_POST["title"]), json_encode($newEntry));
      $cb2 -> replace(getOrganizationKey($_POST['organization']), json_encode($viewResult));

      include("include/doc_footer.php");
      exit (1);
    }

    if ($_GET["edit"]) {
      // adjust these parameters to match your installation
      $cb = new Couchbase($CBSERVER, "", "", "events");
      $r = $cb->view($_GET['id']);
    }

    ?>
    <form data-abide method="POST" enctype="multipart/form-data">
    <?php include("include/image_form.php"); ?>
    
      <div class="row">
        <div class="small-4 columns">
          <label>Event Name
            <input required type="text" name="title" placeholder="Name of the event" value="<?php echo($r["title"]); ?>" />
          </label>
          <small class="error">A valid event name is required.</small>
        </div>
        <div class="small-4 columns">
          <label>Organization
            <input required type="text" name="organization" placeholder="Name of the organization" value="<?php echo($r["organization"]); ?>" />
          </label>
          <small class="error">A valid organization name is required.</small>
        </div>
        <div class="small-4 columns">
          <label>Event Date
            <input required pattern="month_day_year" type="text" name="event_date" placeholder="MM/DD/YYYY" value="<?php echo($r["event_date"]); ?>" />
          </label>
          <small class="error">A valid event date (MM/DD/YYYY format only) is required.</small>
        </div>
      </div>
      <div class="row">
        <div class="small-4 columns">
          <label>Event Time
            <input required pattern="[0-2][0-9]:[0-5][0-9]" data-abide type="text" name="event_time" placeholder="16:30" value="<?php echo($r["event_time"]); ?>" />
          </label>
          <small class="error">A valid event time (HH:MM in 24-hour time) is required.</small>
        </div>
        <div class="small-4 columns">
          
          <label>Latitude <a class="hide" id="coordinate" target="_blank" href="">Verify Coordinates</a>
            <input required pattern="[0-9]\.?[0-9]*" type="text" id="latitude" name="latitude" placeholder="108.45" value="<?php echo($r["latitude"]); ?>" />
          </label>
          <small class="error">A valid latitude coordinate is required.</small>
        </div>
        <div class="small-4 columns">
          <label>Longitude
            <input required pattern="[0-9]\.?[0-9]*" type="text" id="longitude" name="longitude" placeholder="-57.23" value="<?php echo($r["longitude"]); ?>" />
          </label>
          <small class="error">A valid longitude coordinate is required.</small>
        </div>
      </div>
      <div class="row">
        <div class="small-12 columns">
          <label>Address
            <input required type="text" id="address" name="address" placeholder="Put the address here" value="<?php echo($r["address"]); ?>" />
          </label>
          <small class="error">A valid address is required.</small>
        </div>
      </div>
      <div class="row">
        <div class="small-12 columns">
          <label>Description
            <textarea required name="description" placeholder="Describe Your Event"><?php echo($r["description"]); ?> </textarea>
          </label>
          <small class="error">A valid description is required.</small>
        </div>
      </div>
      <button type="submit">Submit</button>
    </form>
  </div></div>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
  <script type="text/javascript" src="js/geocoding.js"></script>
  <script type="text/javascript">
    $("#address").change(
       function(){
        getCoordinates();
       }
      );
    $("#latitude, #longitude").change(
       function(){
        updateLink();
       }
      );
  </script>
  <?php include("include/doc_footer.php");?>