<?php include("include/doc_head.php");?>

<?php include ("include/navigation.php");?>

<div class="row">
  <div class="small-12 columns">
    <h2>Add an Organization</h2>
    <?php
    if ($_POST) {
     echo "<h3>Organization Successfully Added</h3>";
     $newEntry = json_encode($_POST, true);
     print_r($newEntry);
     echo "</div></div>";
     // adjust these parameters to match your installation
     $cb = new Couchbase("127.0.0.1:8091", "", "", "organizations");
     $cb -> add($_POST["username"], $newEntry);
     


   include("include/doc_footer.php");
   exit (1);
 }

 ?>
 <form method="POST">

  <div class="row">
    <div class="large-4 columns">
      <label>Username
        <input type="text" name="username" placeholder="myorganizationusername" />
      </label>
    </div>
    <div class="large-4 columns">
      <label>Organization Name
        <input type="text" name="name" placeholder="My Organization Name" />
      </label>
    </div>
    <div class="large-4 columns">
      <label>Website
        <input type="text" name="website" placeholder="http://www.google.com" />
      </label>
    </div>
  </div>
  <div class="row">
     <div class="large-12 columns">
       <label>Description
         <textarea name="description" placeholder="Describe Your Organization"></textarea>
       </label>
     </div>
   </div>
  <button type="submit">Submit</button>
</form>



</div></div>

<?php include("include/doc_footer.php");?>