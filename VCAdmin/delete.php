<?php include("include/doc_head.php");?>

<?php include ("include/navigation.php");?>

<div class="row">
  <div class="small-12 columns">
    <h2>Delete <?php echo(ucfirst(substr($_GET['bucket'], 0, -1))); ?></h2>
    
    <?php
    ini_set('display_errors', 'On');
    if ($_GET) {
     echo "<h3>".ucfirst(substr($_GET['bucket'], 0, -1))." Successfully Deleted</h3>";
     // adjust these parameters to match your installation
     $cb = new Couchbase($CBSERVER, "", "", $_GET['bucket']);

     if ($_GET['bucket'] == "events") {
     	$org = json_decode($cb -> get($_GET["id"]));

     	$org = getOrganizationUsername($org->organization);
      	$cb2 = new Couchbase($CBSERVER, "", "", "organizations");
     	$viewResult = json_decode($cb2->get($org),true);
     	

     	$viewResult["events"] = array_diff(array ($_GET["id"]),$viewResult["events"]);
     	$cb2 -> replace($org, json_encode($viewResult));
     }
     $cb -> delete($_GET["id"]);
     

 }

 ?>
 
  



</div></div>

<?php include("include/doc_footer.php");?>