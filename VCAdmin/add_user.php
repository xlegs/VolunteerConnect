<?php include("include/doc_head.php");?>

<?php include ("include/navigation.php");?>

<div class="row">
  <div class="small-12 columns">
    <h2>Add a User</h2>
    <?php
    if ($_POST) {
     $_POST = array_map_recursive ("trim", $_POST);
     echo "<h3>User Successfully Added</h3>";
     $newEntry = json_encode($_POST, true);
     // print_r($newEntry);
     echo "</div></div>";
     // adjust these parameters to match your installation
     $cb = new Couchbase($CBSERVER, "", "", "users");
     $cb -> add(convertToKey($_POST["username"]), $newEntry);

 
      // echo "<pre>";
      //  print_r($viewResult); 
      //  echo "</pre>";

     






   include("include/doc_footer.php");
   exit (1);
 }

 ?>
 <form method="POST">

  <div class="row">
    <div class="large-4 columns">
      <label>User Name
        <input type="text" name="username" placeholder="username" />
      </label>
    </div>
    <div class="large-4 columns">
      <label>Email
        <input type="text" name="email" placeholder="email address" />
      </label>
    </div>
    
  </div>

  <div class="row">
    <div class="large-4 columns">
      <label>First Name
        <input type="text" name="firstname" placeholder="first name" />
      </label>
    </div>
    <div class="large-4 columns">
      <label>Last Name
        <input type="text" name="lastname" placeholder="last name" />
      </label>
    </div>
    <div class="large-4 columns">
      <label>Gender
        <input type="text" name="gender" placeholder="gender" />
      </label>
    </div>
  </div>

  <div class="row">
    <div class="large-12 columns">
      <label>Birthdate
        <input type="text" name="birthdate" placeholder="MM/DD/YYYY" />
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