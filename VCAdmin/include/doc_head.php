
<?php
session_start();
require_once "persona.php";
// ini_set('display_errors', 'On');
$button = $email = NULL;
if (isset($_SESSION['persona'])) {
    $result = $_SESSION['persona'];

    if ($result->status === 'okay') {
        $button = "<p>Logged in as: " . $_SESSION['email'];
        $button .= ' <a href="javascript:navigator.id.logout()">Logout</a></p>';
        $email = $_SESSION['email'];

    } else {
        $button = "<p>Error</p>";
    }
    $button .= "<p><a href=\"index.php\">Back to login page</a></p>";
} elseif (!empty($_GET['logout'])) {
    $button = "<p>You have logged out. ";
    $button .= "<a href=\"index.php\">Back to login page</a></p>";
    include("include/doc_footer.php");
    session_destroy();
    exit();

} else {
    $button = "<p>You are logged out. ";
    $button .= "<a href=\"index.php\">Back to login page</a></p>";
    echo($button);
    include("include/doc_footer.php");
    exit();
}

?>

<!doctype html>
<?php include ("functions.php"); ?>
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