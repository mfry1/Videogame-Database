<?php include("header.php"); ?>
<br>
<div class="container well">
	<?php
		// Add entry to company table of database
		if(!($stmt = $mysqli->prepare("INSERT INTO company(name, hq_location, president) VALUES (?,?,?)"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!($stmt->bind_param("sss",$_POST['name'],$_POST['location'],$_POST['president']))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!$stmt->execute()){
			echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
		} else {
			echo "Added " . $stmt->affected_rows . " rows to company.";
		}
	?>	

	<a href="companies.php">Click to go back </a>
</div>
<?php include("footer.php"); ?>