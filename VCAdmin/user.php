<?php include("include/doc_head.php");?>

<?php include ("include/navigation.php");?>
<div class="row">
	<div class="small-12 columns">
		<h2>User Details</h2>
		<?php
		// adjust these parameters to match your installation
		$cb = new Couchbase($CBSERVER, $CBUSER, $CBPASS, "users");
		$viewResult = $cb->view($_GET['id']);

		?>
		<h3>
			<?php echo($viewResult["username"]); ?>
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
						case 'events':
							echo "<td>";
							echo "<ul>";
							foreach ($value as $k => $v){
								echo "<li>";
								echo "<a href='event.php?id=".convertToKey($v)."'>".$v."</a>";
								echo "</li>";
							}
							echo "</ul>";
							echo "</td>";
							break;

						case 'organizations':
							echo "<td>";
							echo "<ul>";
							foreach ($value as $k => $v){
								echo "<li>";
								echo "<a href='organization.php?id=".getOrganizationKey($v)."'>".$v."</a>";
								echo "</li>";
							}
							echo "</ul>";
							echo "</td>";
							break;

						case 'volunteers':
							echo "<td>";
							echo "<ul>";
							foreach ($value as $k => $v){
								echo "<li>";
								echo "<a href='user.php?id=".$v."'>".$v."</a>";
								echo "</li>";
							}
							echo "</ul>";
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
      <a class = "button" href="delete.php?bucket=users&id=<?php echo($_GET['id'])?>"> Delete this User</a>
			</div></div>
			<?php include("include/doc_footer.php");?>