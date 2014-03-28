<?php include ("include/functions.php"); ?>


<?php
session_start();
require_once "include/persona.php";
ini_set('display_errors', 'On');
$button = $email = NULL;
if (isset($_POST['assertion'])) {
    $persona = new Persona();
    $result = $persona->verifyAssertion($_POST['assertion']);

    if ($result->status === 'okay') {
         // adjust these parameters to match your installation
       $cb = new Couchbase($CBSERVER, "", "", "users");
       try{
        $viewResult = json_decode($cb->get($result->email));
       } catch (CouchbaseException $e) {
          $button = "<p>Error: This user account is not registered with the VolunteerConnect Console. Contact an administrator to continue.</p>";
          $button .= "<p><a href=\"index.php\">Back to login page</a></p>";
          echo $button;
          include("include/doc_footer.php");
          exit();
      }

        // user account verified
      $button = "<p>Logged in as: " . $result->email . "</p>";
      $button .= '<p><a href="javascript:navigator.id.logout()">Logout</a></p>';
      $button .= "<p>This page will redirect shortly. Click <a href='index2.php'>here</a> if it does not.</p>";
      $button .= "<script>setTimeout(function () {window.location.replace('index2.php');}, 3000); </script>";

      $email = $result->email;
      $type = $viewResult ->type;
      $_SESSION["persona"] = $result;
      $_SESSION["email"] = $email;
      $_SESSION["type"] = $type;

      

  } else {
    $button = "<p>Error: " . $result->reason . "</p>";
}
$button .= "<p><a href=\"index.php\">Back to login page</a></p>";
} elseif (!empty($_GET['logout'])) {
    $button = "<p>You have logged out.</p>";
    $button .= "<p><a href=\"index.php\">Back to login page</a></p>";
} else {
    $button = "<p><a class=\"persona-button\" href=\"javascript:navigator.id.request()\"><span>Login with Persona</span></a></p>";
}

?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" type="text/css" href="css/persona-button.css"/>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
<div class="row">
  <div class="small-4 columns small-centered">
    
    <?php
        echo $button;
    ?>
  </div>
</div>

<?php include("include/doc_footer.php");?>