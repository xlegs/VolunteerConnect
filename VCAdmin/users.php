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
        echo '<div class="small-8">';
        echo "<h3>".$out["username"]."</h3>";
        echo "<h4>".$out["firstname"]." ".$out["lastname"]."</h4>";
        echo "<h5>".$out["gender"]." - ".$out["birthdate"]."</h5>";
        echo "<p>".$out["description"]."</p>";
        echo '</div>';
        echo '<div class="small-4">';
        echo '<a class = "button" href="user.php?id='.$out["username"].'"> More Information</a>';
        echo "</div>";
        echo "</div>";
      } 
      ?>
      	</div></div>
    
<?php include("include/doc_footer.php");?>
