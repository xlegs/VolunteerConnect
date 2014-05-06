<?php include("include/doc_head.php");?>
    
<?php include ("include/navigation.php");?>
    <div class="row">
      <div class="small-12 columns">
      <h2>List of Organizations</h2>
      <a class = "button" href="add_organization.php"> Add a New Organization</a>
     
         <?php
         //  
         // adjust these parameters to match your installation
         $cb = new Couchbase($CBSERVER, "", "", "organizations");
         $viewResult = $cb->view("organizations", "listAll");
         // echo "<pre>";
         // print_r($viewResult); 
         // echo "</pre>";
     
       
      foreach ($viewResult["rows"] as $key => $value) {
        $out = $value["value"];
        if ($_SESSION["type"] == "organization" && $_SESSION['email'] != $out["username"]) {
          // only show items were user has access
          continue;
        }
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
        echo "<h3>".$out["name"]."</h3>";
        echo "<h4><a target='_blank' href='".$out["website"]."'>".$out["website"]."</a></h4>";
        echo "<p>".$out["description"]."</p>";
        echo '</div>';
        echo '<div>';
        echo '<a class = "button" href="organization.php?id='.getOrganizationKey ($out["name"]).'"> More Information</a> ';
        echo '<a class = "button" href="add_organization.php?edit=1&id='.getOrganizationKey ($out["name"]).'"> Modify</a>';
        echo "</div>";
        echo "</div>";
      } 
      ?>
      	</div></div>
    
<?php include("include/doc_footer.php");?>
