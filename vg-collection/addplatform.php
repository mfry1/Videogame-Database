<?php include("header.php"); ?>
<br>
<div class="container well">
	<?php
		// Add entry to platform table of database 
		if(!($stmt = $mysqli->prepare("INSERT INTO platform(name, release_year, company_id, initial_price) VALUES (?,?,?,?)"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if($_POST['initial_price'] == 0){
			$_POST['initial_price'] = NULL;
		}

		if($_POST['release_year'] == 0){
			$_POST['release_year'] = NULL;
		}
		if(!($stmt->bind_param("siii",$_POST['name'],$_POST['release_year'],$_POST['company'],$_POST['initial_price']))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!$stmt->execute()){
			echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
		} else {
			echo "Added " . $stmt->affected_rows . " rows to platform.";
		}
	?>	

	<a href="platforms.php">Click to go back </a>
</div>
<?php include("footer.php"); ?>