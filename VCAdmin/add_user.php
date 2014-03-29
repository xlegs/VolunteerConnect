<?php include("include/doc_head.php");?>

<?php include ("include/navigation.php");?>

<div class="row">
  <div class="small-12 columns">
    <h2>Add a User</h2>
    <?php

    if ($_POST["username"] ) {
     $_POST = array_map_recursive ("trim", $_POST);
     echo "<h3>User Successfully Added</h3>";
     $newEntry = json_encode($_POST, true);
     // print_r($newEntry);
     echo "</div></div>";
     // adjust these parameters to match your installation
     $cb = new Couchbase($CBSERVER, "", "", "users");
     $cb -> set(convertToKey($_POST["email"]), $newEntry);
     include("include/doc_footer.php");
     exit (1);
    }

    if ($_GET["edit"]) {
      // adjust these parameters to match your installation
      $cb = new Couchbase($CBSERVER, "", "", "users");
      $r = $cb->view($_GET['id']);
    }

 ?>
 <form method="POST">

  <div class="row">
    <div class="large-4 columns">
      <label>User Name
        <input type="text" name="username" placeholder="username" value="<?php echo($r["username"]); ?>" />
      </label>
    </div>
    <div class="large-4 columns">
      <label>Email
        <input type="text" name="email" placeholder="email address" value="<?php echo($r["email"]); ?>" />
      </label>
    </div>
    
  </div>

  <div class="row">
    <div class="large-4 columns">
      <label>First Name
        <input type="text" name="firstname" placeholder="first name" value="<?php echo($r["firstname"]); ?>" />
      </label>
    </div>
    <div class="large-4 columns">
      <label>Last Name
        <input type="text" name="lastname" placeholder="last name" value="<?php echo($r["lastname"]); ?>" />
      </label>
    </div>
    <div class="large-4 columns">
      <label>Gender
        <input type="text" name="gender" placeholder="gender" value="<?php echo($r["gender"]); ?>" />
      </label>
    </div>
  </div>

  <div class="row">
    <div class="large-12 columns">
      <label>Birthdate
        <input type="text" name="birthdate" placeholder="MM/DD/YYYY" value="<?php echo($r["birthdate"]); ?>" />
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <label>Description
        <textarea name="description" placeholder="Describe Your Event" ><?php echo($r["description"]); ?></textarea>
      </label>
    </div>
  </div>
  <button type="submit">Submit</button>
</form>



</div></div>

<?php include("include/doc_footer.php");?>