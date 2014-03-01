<?php include("include/doc_head.php");?>

<?php include ("include/navigation.php");?>

<div class="row">
  <div class="small-12 columns">
    <h2>Add an Event</h2>
    <?php
    if ($_POST) {
     echo "<h3>Event Successfully Added</h3>";
     $newEntry = json_encode($_POST, true);
     // print_r($newEntry);
     echo "</div></div>";
     // adjust these parameters to match your installation
     $cb = new Couchbase("127.0.0.1:8091", "", "", "events");
     $cb -> add(convertToKey($_POST["title"]), $newEntry);
     
     $cb = new Couchbase("127.0.0.1:8091", "", "", "organizations");
     $viewResult = $cb->view(getOrganizationUsername($_POST['organization']));

     $viewResult["events"][] = $_POST["title"];
      // echo "<pre>";
      //  print_r($viewResult); 
      //  echo "</pre>";
     $cb -> replace(getOrganizationUsername($_POST['organization']), json_encode($viewResult)); 

     






   include("include/doc_footer.php");
   exit (1);
 }

 ?>
 <form method="POST">

  <div class="row">
    <div class="large-4 columns">
      <label>Event Name
        <input type="text" name="title" placeholder="Name of the event" />
      </label>
    </div>
    <div class="large-4 columns">
      <label>Organization
        <input type="text" name="organization" placeholder="Name of the organization" />
      </label>
    </div>
    <div class="large-4 columns">
      <label>Event Date
        <input type="text" name="event_date" placeholder="MM/DD/YYYY" />
      </label>
    </div>
  </div>

  <div class="row">
    <div class="large-4 columns">
      <label>Event Time
        <input type="text" name="event_time" placeholder="16:30" />
      </label>
    </div>
    <div class="large-4 columns">
      <label>Latitude
        <input type="text" name="latitude" placeholder="108.45" />
      </label>
    </div>
    <div class="large-4 columns">
      <label>Longitude
        <input type="text" name="longitude" placeholder="-57.23" />
      </label>
    </div>
  </div>

  <div class="row">
    <div class="large-12 columns">
      <label>Address
        <input type="text" name="address" placeholder="Put the address here" />
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <label>Description
        <textarea name="description" placeholder="Describe Your Event"></textarea>
      </label>
    </div>
  </div>
  <button type="submit">Submit</button>
</form>



</div></div>

<?php include("include/doc_footer.php");?>