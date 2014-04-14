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
    if(!checkImage("profileimage")){
      $encodedImage = $r["profileimage"];
      echo "Profile Image ignored. </br>";
    }else{
      $encodedImage = base64_encode(file_get_contents($_FILES["profileimage"]["tmp_name"]));
      echo '<img src="data:image/jpg;base64,'.$encodedImage.'" />';
    }
    
    $newEntry["profileimage"] = $encodedImage;

    if(!checkImage("coverimage")){
         $encodedImage = $r["coverimage"];
          echo "Cover Image ignored. </br>";
        }else{
          $encodedImage = base64_encode(file_get_contents($_FILES["coverimage"]["tmp_name"]));
          echo '<img src="data:image/jpg;base64,'.$encodedImage.'" />';
        }
        
        $newEntry["coverimage"] = $encodedImage;
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
 <form method="POST" enctype="multipart/form-data">
<div class="row">
 <div class="large-6 columns">
   <label>Profile Image:
    <input type="file" name="profileimage" />
   </label>
 </div><div class="large-6 columns">
   <label>Cover Image:
    <input type="file" name="coverimage" />
   </label>
 </div>
 </div>
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