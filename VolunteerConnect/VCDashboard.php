<?php include('VCHeader.php'); ?>

<div id="profileimg"></div>

<div id="content">

<table>
		<td id="sidebar">

		<?php include('Include/UserProfileInfo.php'); ?>

			<div id="events">
				<h1>Upcoming Events</h1>

                    <?php include('Include/UserObjects.php'); ?>
                    <footer>Powered by Orphanage without Borders</footer>
            </div>
			
		</td>

		<td id="objects">
			<?php include('Include/ContentObjects.php'); ?>
        
		</td>

	</table>

	
</div>
</body>
</html>