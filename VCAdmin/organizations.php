<?php include("include/doc_head.php");?>
    
<?php include ("include/navigation.php");?>
    <div class="row">
      <div class="small-12 columns">
      <h2>List of Organizations</h2>
      <a class = "button" href="add_organization.php"> Add a New Organization</a>
     
         <?php
         ini_set('display_errors', 'On');
         // adjust these parameters to match your installation
         $cb = new Couchbase($CBSERVER, "", "", "organizations");
         $viewResult = $cb->view("organizations", "listAll");
         // echo "<pre>";
         // print_r($viewResult); 
         // echo "</pre>";
     
       
      foreach ($viewResult["rows"] as $key => $value) {
        $out = $value["value"];
        echo '<div class="panel">';
        echo '<div class="small-8">';
        echo "<h3>".$out["name"]."</h3>";
        echo "<h4><a target='_blank' href='".$out["website"]."'>".$out["website"]."</a></h4>";
        echo "<p>".$out["description"]."</p>";
        echo '</div>';
        echo '<div class="small-4">';
        echo '<a class = "button" href="organization.php?id='.getOrganizationUsername ($out["name"]).'"> More Information</a>';
        echo "</div>";
        echo "</div>";
      } 
      ?>
      	</div></div>
    
<?php include("include/doc_footer.php");?>
