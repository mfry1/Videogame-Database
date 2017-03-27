<?php include("header.php"); ?>
<div class="container">
	<h1>Genres</h1>
	<!-- Form to add new genre to database -->
	<fieldset>
	<legend>Add New Genre</legend>
		<form action="addgenre.php" method="post">
			<label for="name">Name: </label>
				<input type="text" name="name">
			<input class="btn" type="submit" name="add" value="Add">
		</form>
	</fieldset><br>

	<br><br>

	<!-- Table to display all genres --> 
	<table class="database-table">
		<tr>
			<th>Name</th>
			<th style="width:10%"</th>
		</tr>
		<?php
			if(!($stmt = $mysqli->prepare("SELECT id, name FROM genre ORDER BY name"))){
				echo "Prepare failed: " . $stmt->errno . " " .$stmt->error;
			}
			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($id, $name)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}

			while($stmt->fetch()){							
				echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>" ."<form action='delete.php' method='post'><input type='hidden' name='type' value='genre'><input type='hidden' name='id' value='" . $id . "'><input class='delete' type='submit' value='X' name='deleteGenre'></form>" . "\n</td>\n</tr>"; 
			}
			$stmt->close();	
		?>
	</table>
</div>
<?php include("footer.php"); ?>