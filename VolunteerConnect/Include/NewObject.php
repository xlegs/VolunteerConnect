<?php

$objectcounter = 5; /*default objects loaded per column*/
while ($objectcounter > 0)
{
	echo '<div class="object">';
	echo '<img src="' . $image . '" alt="' . $name . '" />';
	echo '<h1>' . $name . '</h1>';
	echo '<h2>' . $h2 . '</h2>';
	echo '<h3>' . $h3 . '</h3>';
	echo '<p>' . $description .'</p>';
	echo '</div>';
			
	$objectcounter = $objectcounter - 1;
}

?>