<?php include("include/doc_head.php");?>
<?php include ("include/navigation.php");?>
<div class="row">
  <div class="small-12 columns">
    <h2>Add an Event</h2>
    <?php
    if ($_POST["title"]) {
      $_POST = array_map_recursive ("trim", $_POST);

      $newEntry = json_encode($_POST, true);
    // print_r($newEntry);
      echo "</div></div>";
  // adjust these parameters to match your installation
      $cb = new Couchbase($CBSERVER, "", "", "events");
      $cb2 = new Couchbase($CBSERVER, "", "", "organizations");


      try {
        $viewResult = $cb2->view(getOrganizationUsername($_POST['organization']));
      } catch (CouchbaseException $e) {
        echo "<h3>Organization ".$_POST['organization']." does not exist. Please verify that the organization is spelled correctly and try again. The event has not been added. </h3>";
        include("include/doc_footer.php");
        exit (1);
      }

      echo "<h3>Event Successfully Added</h3>";
      $viewResult["events"][] = $_POST["title"];
      // echo "<pre>";
      //  print_r($viewResult); 
      //  echo "</pre>";
      $cb -> set(convertToKey($_POST["title"]), $newEntry);
      $cb2 -> replace(getOrganizationUsername($_POST['organization']), json_encode($viewResult));

      include("include/doc_footer.php");
      exit (1);
    }
    if ($_GET["edit"]) {
      // adjust these parameters to match your installation
      $cb = new Couchbase($CBSERVER, "", "", "events");
      $r = $cb->view($_GET['id']);
    }

    ?>
    <form method="POST">
      <div class="row">
        <div class="large-4 columns">
          <label>Event Name
            <input type="text" name="title" placeholder="Name of the event" value="<?php echo($r["title"]); ?>" />
          </label>
        </div>
        <div class="large-4 columns">
          <label>Organization
            <input type="text" name="organization" placeholder="Name of the organization" value="<?php echo($r["organization"]); ?>" />
          </label>
        </div>
        <div class="large-4 columns">
          <label>Event Date
            <input type="text" name="event_date" placeholder="MM/DD/YYYY" value="<?php echo($r["event_date"]); ?>" />
          </label>
        </div>
      </div>
      <div class="row">
        <div class="large-4 columns">
          <label>Event Time
            <input type="text" name="event_time" placeholder="16:30" value="<?php echo($r["event_time"]); ?>" />
          </label>
        </div>
        <div class="large-4 columns">
          <label>Latitude
            <input type="text" name="latitude" placeholder="108.45" value="<?php echo($r["latitude"]); ?>" />
          </label>
        </div>
        <div class="large-4 columns">
          <label>Longitude
            <input type="text" name="longitude" placeholder="-57.23" value="<?php echo($r["longitude"]); ?>" />
          </label>
        </div>
      </div>
      <div class="row">
        <div class="large-12 columns">
          <label>Address
            <input type="text" name="address" placeholder="Put the address here" value="<?php echo($r["address"]); ?>" />
          </label>
        </div>
      </div>
      <div class="row">
        <div class="large-12 columns">
          <label>Description
            <textarea name="description" placeholder="Describe Your Event"><?php echo($r["description"]); ?> </textarea>
          </label>
        </div>
      </div>
      <button type="submit">Submit</button>
    </form>
  </div></div>
  <?php include("include/doc_footer.php");?>