<?php include("header.php"); ?>
<br>
<div class="container well">
	<?php
		// Add entry to genre table of database 
		if(!($stmt = $mysqli->prepare("INSERT INTO genre(name) VALUES (?)"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}


		if(!($stmt->bind_param("s",$_POST['name']))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!$stmt->execute()){
			echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
		} else {
			echo "Added " . $stmt->affected_rows . " rows to genre.";
		}
	?>	

	<a href="genres.php">Click to go back </a>
</div>
<?php include("footer.php"); ?>