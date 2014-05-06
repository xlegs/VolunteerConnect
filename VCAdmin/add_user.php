<?php include("include/doc_head.php");?>

<?php include ("include/navigation.php");?>

<div class="row">
  <div class="small-12 columns">
    <h2>Add a User</h2>
    <?php
     // adjust these parameters to match your installation
     $cb = new Couchbase($CBSERVER, "", "", "users");
    $r = $cb->view($_GET['id']);
    if ($_POST["username"] ) {
    $newEntry = $_POST;

    include("include/upload_images.php");

     $_POST = array_map_recursive ("trim", $_POST);
     echo "<h3>User Successfully Added</h3>";
     // $newEntry = json_encode($_POST, true);
     

     
     $cb -> set(convertToKey($_POST["email"]), json_encode($newEntry, true));
     include("include/doc_footer.php");
     exit (1);
    }

    if ($_GET["edit"]) {
      // adjust these parameters to match your installation
      $cb = new Couchbase($CBSERVER, "", "", "users");
      $r = $cb->view($_GET['id']);
    }

 ?>
  <form data-abide method="POST" enctype="multipart/form-data">
    <?php include("include/image_form.php"); ?>
 
  <div class="row">
    <div class="small-4 columns">
      <label>User Name
        <input required type="text" name="username" placeholder="username" value="<?php echo($r["username"]); ?>" />
      </label>
      <small class="error">A valid username is required.</small>
    </div>
    <div class="small-4 columns">
      <label>User Type
        <select name="type">
          <option value="admin">Administrator</option>
          <option value="organization" <?php if ($r["type"] == "organization") echo "selected"; ?>>Organization</option>
        </select>
      </label>
    </div>
    <div class="small-4 columns">
      <label>Email
        <input required pattern="email" type="text" name="email" placeholder="Email address" value="<?php echo($r["email"]); ?>" />
      </label>
      <small class="error">A valid email address is required.</small>
    </div>
    
  </div>
 
  <div class="row">
    <div class="small-4 columns">
      <label>First Name
        <input required type="text" name="firstname" placeholder="First name" value="<?php echo($r["firstname"]); ?>" />
      </label>
      <small class="error">A valid first name is required.</small>
    </div>
    <div class="small-4 columns">
      <label>Last Name
        <input required type="text" name="lastname" placeholder="Last name" value="<?php echo($r["lastname"]); ?>" />
      </label>
      <small class="error">A valid last name is required.</small>
    </div>
    <div class="small-4 columns">
      <label>Gender
        <input required pattern="[MF]" type="text" name="gender" placeholder="M/F" value="<?php echo($r["gender"]); ?>" />
      </label>
      <small class="error">A valid gender (M or F) is required.</small>
    </div>
  </div>

  <div class="row">
    <div class="small-12 columns">
      <label>Birthdate
        <input required pattern="month_day_year" type="text" name="birthdate" placeholder="MM/DD/YYYY" value="<?php echo($r["birthdate"]); ?>" />
      </label>
      <small class="error">A valid (but not necessarily real) birthdate is required.</small>
    </div>
  </div>
  <div class="row">
    <div class="small-12 columns">
      <label>Description
        <textarea name="description" placeholder="Describe yourself" ><?php echo($r["description"]); ?></textarea>
      </label>
    </div>
  </div>
  <button type="submit">Submit</button>
</form>



</div></div>

<?php include("include/doc_footer.php");?>