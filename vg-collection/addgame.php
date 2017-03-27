<?php include("header.php"); ?>
<br>
<div class="container well">
	<?php

	//Adding new game to videogame table of database. 
	if($_POST['type'] == "game"){
		if(!($stmt = $mysqli->prepare("INSERT INTO videogame(title, release_year, publishing_company_id, rating) VALUES (?,?,?,?)"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}
		// rating and release_year should default to null instead of 0 
		if($_POST['rating'] == 0){
			$_POST['rating'] = NULL;
		}

		if($_POST['release_year'] == 0){
			$_POST['release_year'] = NULL;
		}

		if(!($stmt->bind_param("siid",$_POST['title'],$_POST['release_year'],$_POST['publisher'],$_POST['rating']))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!$stmt->execute()){
			echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
		} else {
			echo "Added " . $stmt->affected_rows . " rows to videogame.";
		}
		
	}	

	// Adding new platform to platform table of database
	if($_POST['type'] == "game-platform"){
		if(!($stmt = $mysqli->prepare("INSERT INTO videogame_platform(videogame_id, platform_id) VALUES (?,?)"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!($stmt->bind_param("ii",$_POST['game'],$_POST['platform']))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!$stmt->execute()){
			echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
		} else {
			echo "Added " . $stmt->affected_rows . " rows to videogame_platform.";
		}
		
	}

	// Adding new genre to genre table of database 
	if($_POST['type'] == "game-genre"){
		if(!($stmt = $mysqli->prepare("INSERT INTO videogame_genre(videogame_id, genre_id) VALUES (?,?)"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!($stmt->bind_param("ii",$_POST['game'],$_POST['genre']))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!$stmt->execute()){
			echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
		} else {
			echo "Added " . $stmt->affected_rows . " rows to videogame_genre.";
		}
		
	}

	?>	
	<a href="index.php">Click to go back </a>
</div>
<?php include("footer.php"); ?>