<?php include("include/doc_head.php");?>

<?php include ("include/navigation.php");?>
<div class="row">
	<div class="small-12 columns">
		<h2>Event Details</h2>
		<?php
		// adjust these parameters to match your installation
		$cb = new Couchbase($CBSERVER, $CBUSER, $CBPASS, "events");
		$viewResult = $cb->view($_GET['id']);

		?>
		<h3>
			<?php echo($viewResult["title"]); ?>
		</h3>
		<table>
			<thead>
				<th>Item</th>
				<th>Value</th>
			</thead>
			<tbody>

				<?php
				echo "<tr>";
				foreach ($viewResult as $key => $value) {
					echo "<td>".ucfirst($key).":</td>";
					switch ($key) {
						case 'profileimage':
							echo "<td>";
					        echo '<img src="data:image/jpg;base64,'.$value.'" />';
					        echo "</td>";
					        break;
					    case 'coverimage':
					    		echo "<td>";
					            echo '<img src="data:image/jpg;base64,'.$value.'" />';
					            echo "</td>";
					            break;
						
						default:
							echo "<td>".$value."</td>";
							break;
					}

					
				echo "</tr>";
				}
				?>
				<tbody>
				</table>
      <a class = "button" href="delete.php?bucket=events&id=<?php echo($_GET['id'])?>"> Delete this Event</a>
			</div></div>
			<?php include("include/doc_footer.php");?>
