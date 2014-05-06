<?php
    
    $img = 'Images/DefaultImage.jpg';
	$h1 = "Object Name";
	$h2 = "Object Name";
	$h3 = "Object Name";
	$p = "Ring around the rosy, a pocket full of posies, ashes, ashes, we all fall down.";
	
	$count = 25;
	
	while ($count > 0)
    {
		echo '<div class="object" id="hello">';
        echo '<img src="'.$img.'">';
        echo '<h1 id="a">'.$h1.' '.$count.'</h1>';
		echo '<h2 id="b">'.$h2.'</h2>';
		echo '<h3 id="c">'.$h3.'</h3>';
		echo '<p id="d">'.$p.'</p>';
		echo '<button onclick="hello()">Hello</button>';
		echo '</div>';
        
		$count = $count - 1;
	}

?>