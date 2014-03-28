<?php
session_start();
require_once "include/persona.php";
ini_set('display_errors', 'On');
$button = $email = NULL;
if (!empty($_GET['logout'])) {
    $button = "<p>You have logged out. ";
    $button .= "<a href=\"index.php\">Back to login page</a></p>";
    session_destroy();
} elseif (isset($_SESSION['email'])) {
    $result = $_SESSION['persona'];

    if ($result->status === 'okay') {
        $button = "<p>Logged in as: " . $_SESSION['email'];
        $button .= ' <a href="javascript:navigator.id.logout()">Logout</a></p>';
        $email = $_SESSION['email'];

    } else {
        $button = "<p>Error</p>";
    }
    $button .= "<p><a href=\"index.php\">Back to login page</a></p>";
} else {
    $button = "<p><a class=\"persona-button\" href=\"javascript:navigator.id.request()\"><span>Login with Persona</span></a></p>";
}

?>
<!doctype html>
<?php include ("include/functions.php"); ?>
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
  <div class="large-12 columns">
    <h1>VolunteerConnect Administrative Panel</h1>
  </div>
</div>
<div class="row">
  <div class="small-4 columns small-centered">
  	<form id="login-form" method="POST" action="login.php">
      <input id="assertion-field" type="hidden" name="assertion" value="">
    </form>
    <?php
    	echo $button;
    ?>
  </div>
</div>

<?php 
// include ("include/navigation.php");
?>
    
   
    
<?php include("include/doc_footer.php");?>