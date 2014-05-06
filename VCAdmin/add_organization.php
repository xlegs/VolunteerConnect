<?php include("include/doc_head.php");?>

<?php include ("include/navigation.php");?>

<div class="row">
  <div class="small-12 columns">
    <h2>Add an Organization</h2>
    <?php
    if ($_POST["username"]) {

      $cb = new Couchbase($CBSERVER, "", "", "organizations");
      $r = $cb->view($_GET['id']);


      $newEntry = $_POST;

      include("include/upload_images.php");

      $_POST = array_map_recursive ("trim", $_POST);
      echo "<h3>Organization Successfully Added</h3>";


     // adjust these parameters to match your installation
      $cb = new Couchbase($CBSERVER, "", "", "organizations");
      $cb -> set(getOrganizationKey($_POST["name"]), json_encode($newEntry, true));



      include("include/doc_footer.php");
      exit (1);
    }


    if ($_GET["edit"]) {
     // adjust these parameters to match your installation
     $cb = new Couchbase($CBSERVER, "", "", "organizations");
     $r = $cb->view($_GET['id']);

     if ($_SESSION["type"] == "organization" && $_SESSION['email'] != $r["username"]) {
       echo "<h3>Access Denied: Insufficient Privileges</h3>";
       include("include/doc_footer.php");
       exit (1);
     }
   }
   ?>
   <form data-abide method="POST" enctype="multipart/form-data">
    <?php include("include/image_form.php"); ?>
  <div class="row">
    <div class="small-4 columns">
      <label>Username
        <input required type="text" name="username" placeholder="myorganizationusername" value="<?php echo($r["username"]); ?>" />
      </label>
      <small class="error">A valid username is required.</small>
    </div>
    <div class="small-4 columns">
      <label>Organization Name
        <input required type="text" name="name" placeholder="My Organization Name" value="<?php echo($r["name"]); ?>" />
      </label>
      <small class="error">A valid organization name is required.</small>
    </div>
    <div class="small-4 columns">
      <label>Website
        <input required pattern="url" type="text" name="website" placeholder="http://www.google.com" value="<?php echo($r["website"]); ?>" />
      </label>
      <small class="error">A valid website is required.</small>
    </div>
  </div>
  <div class="row">
   <div class="small-12 columns">
     <label>Description
       <textarea required name="description"><?php echo($r["description"]); ?> </textarea>
     </label>
     <small class="error">A valid description is required.</small>
   </div>
 </div>
 <button type="submit">Submit</button>
</form>



</div>
</div>


<?php include("include/doc_footer.php");?>