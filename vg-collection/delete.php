<?php include("header.php"); ?>
<br>
<div class="container well">


<?php		
	// Delete game. Select game by the id of the delete button that was clicked 
	if($_POST['type'] == "game"){
		if(!($stmt = $mysqli->prepare("DELETE FROM videogame WHERE id = ?"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}	
		if(!($stmt->bind_param("i",$_POST['id']))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!$stmt->execute()){
			echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
		} else {
			echo "Removed " . $stmt->affected_rows . " rows from video games.<br><a href='index.php'>Click to go back </a>";
		}
	}
	
	// Delete company. Select company by the id of the delete button that was clicked
	if($_POST['type'] == "company"){
		if(!($stmt = $mysqli->prepare("DELETE FROM company WHERE id = ?"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}	
		if(!($stmt->bind_param("i",$_POST['id']))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!$stmt->execute()){
			echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
		} else {
			echo "Removed " . $stmt->affected_rows . " rows from company.<br><a href='companies.php'>Click to go back </a>";
		}
	}

	// Delete platform. Select platform by the id of the delete button that was clicked
	if($_POST['type'] == "platform"){
		if(!($stmt = $mysqli->prepare("DELETE FROM platform WHERE id = ?"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}	
		if(!($stmt->bind_param("i",$_POST['id']))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!$stmt->execute()){
			echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
		} else {
			echo "Removed " . $stmt->affected_rows . " rows from platform.<br><a href='platforms.php'>Click to go back </a>";
		}
	}

	// Delete genre. Select genre by the id of the delete button that was clicked
	if($_POST['type'] == "genre"){
		if(!($stmt = $mysqli->prepare("DELETE FROM genre WHERE id = ?"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!($stmt->bind_param("i",$_POST['id']))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
		}	
		if(!$stmt->execute()){
			echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
		} else {
			echo "Removed " . $stmt->affected_rows . " rows from genre.<br><a href='genres.php'>Click to go back </a>";
		}
	}
?>	
</div>
<?php include("footer.php"); ?>