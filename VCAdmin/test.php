<?php
 ini_set('display_errors', 'On');
// adjust these parameters to match your installation
$cb = new Couchbase("127.0.0.1:8091", "", "", "events");
// echo "<pre>";
$viewResult = $cb->view("events", "listAll");
// print_r($viewResult); 
// echo "</pre>";
foreach ($viewResult["rows"] as $key => $value) {
	$out = $value["value"];
	echo "<h3>".$out["title"]."</h3>";
	echo "<h4>".$out["organization"]."</h4>";
	echo "<p>".$out["description"]."</p>";
}	
?>