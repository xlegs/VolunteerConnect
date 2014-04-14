<?php include("include/doc_head.php");?>
    
<?php include ("include/navigation.php");?>
    <div class="row">
      <div class="small-12 columns">
      <h2>List of Users</h2>
      <a class = "button" href="add_user.php"> Add a New User</a>
     
         <?php
         ini_set('display_errors', 'On');
         // adjust these parameters to match your installation
         $cb = new Couchbase($CBSERVER, "", "", "users");
         $viewResult = $cb->view("users", "listAll");
         // echo "<pre>";
         // print_r($viewResult); 
         // echo "</pre>";
     
       
      foreach ($viewResult["rows"] as $key => $value) {
        $out = $value["value"];
        echo '<div class="panel">';
        echo '<div class="small-4 columns">';
        if ($out["profileimage"]) {
          $image = '<img src="data:image/jpg;base64,'.$out["profileimage"].'" />';
        } else {
          $image = '<img src="http://placehold.it/150" />';
        }
        echo $image;
        echo "</div>";
        echo '<div class="small-6 columns">';
        echo "<h3>".$out["username"]."</h3>";
        echo "<h4>".$out["firstname"]." ".$out["lastname"]."</h4>";
        echo "<h5>".$out["gender"]." - ".$out["birthdate"]."</h5>";
        echo "<p>".$out["description"]."</p>";
        echo '</div>';
        echo '<div>';
        echo '<a class = "button" href="user.php?id='.$out["email"].'"> More Information</a> ';
        echo '<a class = "button" href="add_user.php?edit=1&amp;id='.$out["email"].'"> Modify</a>';
        echo "</div>";
        echo "</div>";
      } 
      ?>
        </div></div>
    
<?php include("include/doc_footer.php");?>