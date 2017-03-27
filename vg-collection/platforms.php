<?php include("header.php"); ?>

<div class="container">
	<h1>Platforms</h1>
	<!-- Form to add new platform to database --> 
	<fieldset>
	<legend>Add New Platform</legend>
		<form action="addplatform.php" method="post">
			<label for="name">Name: </label>
				<input type="text" name="name">
			<label for="release_year">Release Year: </label>
				<input type="number" min="1950" max="2050" name="release_year" value ="">
			<label for="initial_price">Initial Price: </label>
				<input type="number" min="1" max="5000" name="initial_price">
			<label for="company">Company Created By: </label>
			<select style="max-width:15%" name="company">
				<?php
				if(!($stmt = $mysqli->prepare("SELECT id, name FROM company ORDER BY name"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($id, $name)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
			<br><br><input class="btn" type="submit" name="add" value="Add">
		</form>
	</fieldset><br>
	<br><br>

	<!-- Table to display all platforms --> 
	<table class="database-table">
		<tr>
			<th>Name</th>
			<th>Release Year</th>
			<th>Initial Price</th>
			<th>Company Created By</th>
			<th></th>
		</tr>
		<?php
			if(!($stmt = $mysqli->prepare("SELECT p.id, p.name, p.release_year, p.initial_price, c.name FROM platform p LEFT JOIN company c ON p.company_id = c.id"))){
				echo "Prepare failed: " . $stmt->errno . " " .$stmt->error;
			}
			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($id, $name, $release_year, $initial_price, $company)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}

			while($stmt->fetch()){							
				echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $release_year . "\n</td>\n<td>" . $initial_price . "\n</td>\n<td>" . $company  . "\n</td>\n<td>" ."<form action='delete.php' method='post'><input type='hidden' name='type' value='platform'><input type='hidden' name='id' value='" . $id . "'><input class='delete' type='submit' value='X' name='deletePlatform'></form>" . "\n</td>\n</tr>"; 
			}
			$stmt->close();	
		?>
	</table>
</div>
<?php include("footer.php"); ?>