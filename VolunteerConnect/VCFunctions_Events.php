<?php

	function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
	{
		// convert from degrees to radians
		$latFrom = deg2rad($latitudeFrom);
		$lonFrom = deg2rad($longitudeFrom);
		$latTo = deg2rad($latitudeTo);
		$lonTo = deg2rad($longitudeTo);

		$latDelta = $latTo - $latFrom;
		$lonDelta = $lonTo - $lonFrom;

		$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
		cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
		return $angle * $earthRadius;
	}

	$cb = new Couchbase($CBSERVER, $CBUSER, $CBPASS, "events");
	$viewResult = $cb->view("events", "listAll");
	
	if ($_POST)
	{
		$distance = 0;
	}

	foreach ($viewResult["rows"] as $key => $value) {
		$out = $value["value"];

		if (isset($distance)) {
			$distance = haversineGreatCircleDistance(floatval($_POST["lat"]),floatval($_POST["long"]),$out["latitude"], $out["longitude"]);
			if ($distance > 5000) {
				// distance greater than 5 km, so skip
				continue;
			}
		}

		if ($_SESSION["type"] == "organization" && $_SESSION['email'] != $out["owner"]) {
			// only show items were user has access
			continue;
		}

		if ($out["profileimage"]) 
		{
			$image = '<img src="data:image/jpg;base64,'.$out["profileimage"].'" />';
		} else 
		{
			$image = '<img src="Images/DefaultImage.jpg" />';
		}

	   
		$img = 'Images/DefaultImage.jpg';
		$h1 = $out["title"];
		$h2 = $out["organization"];
		$h3 = "Object Name";
		$p = $out["description"];
	
	
		echo '<div class="object">';
		echo $image;
		echo '<h1>'.$h1.'</h1>';
		echo '<h2>'.$h2.'</h2>';
		echo '<h3>'.$h3.'</h3>';
		echo '<a class = "button" href="event.php?id='.convertToKey($out["title"]).'"> More Information</a> ';
		echo '<a class = "button" href="add_event.php?edit=1&id='.convertToKey($out["title"]).'"> Modify</a>';
		echo '<p>'.$p.'</p>';
		echo '<button onclick="hello()">Hello</button>';
		echo '</div>';
	}

	ini_set('display_errors', 'On');
	
?>