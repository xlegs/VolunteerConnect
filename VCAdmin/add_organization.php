<?php include("include/doc_head.php");?>

<?php include ("include/navigation.php");?>

<div class="row">
  <div class="small-12 columns">
    <h2>Add an Organization</h2>
    <?php
    if ($_POST["username"]) {
     $_POST = array_map_recursive ("trim", $_POST);
     echo "<h3>Organization Successfully Added</h3>";
     $newEntry = json_encode($_POST, true);
     // print_r($newEntry);
     echo "</div></div>";
     // adjust these parameters to match your installation
     $cb = new Couchbase($CBSERVER, "", "", "organizations");
     $cb -> set(getOrganizationUsername($_POST["name"]), $newEntry);
     


       include("include/doc_footer.php");
       exit (1);
     }


     if ($_GET["edit"]) {
       // adjust these parameters to match your installation
       $cb = new Couchbase($CBSERVER, "", "", "organizations");
       $r = $cb->view($_GET['id']);
     }
 ?>
 <form method="POST">

  <div class="row">
    <div class="large-4 columns">
      <label>Username
        <input type="text" name="username" placeholder="myorganizationusername" value="<?php echo($r["username"]); ?>" />
      </label>
    </div>
    <div class="large-4 columns">
      <label>Organization Name
        <input type="text" name="name" placeholder="My Organization Name" value="<?php echo($r["name"]); ?>" />
      </label>
    </div>
    <div class="large-4 columns">
      <label>Website
        <input type="text" name="website" placeholder="http://www.google.com" value="<?php echo($r["website"]); ?>" />
      </label>
    </div>
  </div>
  <div class="row">
     <div class="large-12 columns">
       <label>Description
         <textarea name="description" placeholder="Describe Your Organization"><?php echo($r["description"]); ?> </textarea>
       </label>
     </div>
   </div>
  <button type="submit">Submit</button>
</form>



</div></div>

<?php include("include/doc_footer.php");?>