<div id="content">

	<?php
	
		$mobile = 0;
		$screen = 1;

		if ($screen == $mobile)
			$count = 1;
		else $count = 5; /*number of columns, default*/
		
		/*Initialize to database data, temp hard coded*/
		$image = "Images/DefaultImage.jpg";
		$name = "ObjectName";
		$h2 = "Descriptor 1";
		$h3 = "Descriptor 2";
		$description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. In pretium quis neque a eleifend. Maecenas bibendum odio nulla, non rutrum augue tempus sed...";

		while ($count>0)
		{
			echo '<div class="column" width="' . 100/$count . '%">'; /*new column*/

			include("Include/LoadObjects.php"); /*generates 5 new objects*/
			
			echo '</div>'; /*end column*/
			$count = $count - 1;
		}
		
	?>

</div>