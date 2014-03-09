<?php include("include/doc_head.php");?>

<?php include ("include/navigation.php");?>

<div class="row">
  <div class="small-12 columns">
    <h2>Delete an <?php echo(ucfirst(substr($_GET['bucket'], 0, -1))); ?></h2>
    
    <?php
    ini_set('display_errors', 'On');
    if ($_GET) {
     echo "<h3>".ucfirst(substr($_GET['bucket'], 0, -1))." Successfully Deleted</h3>";
     // adjust these parameters to match your installation
     $cb = new Couchbase($CBSERVER, "", "", $_GET['bucket']);
     $cb -> delete($_GET["id"]);
     

 }

 ?>
 
  



</div></div>

<?php include("include/doc_footer.php");?>