<?php
    
    $h1 = "Object Name";
	$h2 = "Object Name";
	$h3 = "Object Name";
	$p = "Ring around the rosy, a pocket full of posies, ashes, ashes, we all fall down.";
	
	$count = 10;
	
	while ($count > 0) {
		echo '<div class="userobject">';
        echo '<h1>' .$h1.' ',$count.'</h1>';
		echo '<h2>'.$h2.'</h2>';
		echo '<h3>'.$h3.'</h3>';
		echo '<p>'.$p.'</p>';
		echo '</div>';
		$count = $count - 1;
	}
?>