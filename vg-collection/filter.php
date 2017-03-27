<?php include("header.php"); ?>

<div class="container">
	<h1>Video Games</h1>
	<?php

		$gameArray = [];

		// Create array of all entries in videogame table matching the search 
		if($_POST["type"] == "search"){
			if(!($stmt = $mysqli->prepare("SELECT vg.id, vg.title, vg.release_year, c.name, vg.rating FROM videogame vg LEFT JOIN company c ON vg.publishing_company_id = c.id WHERE vg.title=(?)ORDER BY vg.title"))){
				echo "Prepare failed: " . $stmt->errno . " " .$stmt->error;
			}
			if(!($stmt->bind_param("s",$_POST['title']))){
					echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
				}
			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($id, $title, $release_year, $company, $rating)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}

			while($stmt->fetch()){							
				array_push($gameArray, ["id" => $id, "title" => $title, "release_year" => $release_year, "publisher"=> $company, "rating" => $rating, "genres" => "","platforms" => ""]);
				
			}
			$stmt->close();
			echo "<h3>Searched for Title: " . $_POST["title"]. "</h3>";
		}

		// Create array of all games with selected publisher
		if($_POST["type"] == "filter-publisher"){
			if(!($stmt = $mysqli->prepare("SELECT vg.id, vg.title, vg.release_year, c.name, vg.rating FROM videogame vg LEFT JOIN company c ON vg.publishing_company_id = c.id WHERE c.id = (?) ORDER BY vg.title"))){
				echo "Prepare failed: " . $stmt->errno . " " .$stmt->error;
			}
			if(!($stmt->bind_param("i",$_POST['publisher']))){
					echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
				}
			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($id, $title, $release_year, $company, $rating)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}

			while($stmt->fetch()){							
				array_push($gameArray, ["id" => $id, "title" => $title, "release_year" => $release_year, "publisher"=> $company, "rating" => $rating, "genres" => "","platforms" => ""]);
				
			}
			$stmt->close();
			echo "<h3>Filtered by publisher: " . $company . "</h3>";
		}
		
		// Create array of all games with selected platform
		if($_POST["type"] == "filter-platform"){
			if(!($stmt = $mysqli->prepare("SELECT p.name, vg.id, vg.title, vg.release_year, c.name, vg.rating FROM videogame vg LEFT JOIN company c ON vg.publishing_company_id = c.id INNER JOIN videogame_platform vp ON vg.id = vp.videogame_id INNER JOIN platform p ON vp.platform_id = p.id WHERE vp.platform_id = (?) ORDER BY vg.title"))){
				echo "Prepare failed: " . $stmt->errno . " " .$stmt->error;
			}
			if(!($stmt->bind_param("i",$_POST['platform']))){
					echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
				}
			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($platform, $id, $title, $release_year, $company, $rating)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}

			while($stmt->fetch()){							
				array_push($gameArray, ["id" => $id, "title" => $title, "release_year" => $release_year, "publisher"=> $company, "rating" => $rating, "genres" => "","platforms" => ""]);
				
			}
			$stmt->close();
			echo "<h3>Filtered by platform: " . $platform . "</h3>";
		}

		// Create array of all games with selected genre 
		if($_POST["type"] == "filter-genre"){
			if(!($stmt = $mysqli->prepare("SELECT g.name, vg.id, vg.title, vg.release_year, c.name, vg.rating FROM videogame vg LEFT JOIN company c ON vg.publishing_company_id = c.id INNER JOIN videogame_genre vgg ON vg.id = vgg.videogame_id INNER JOIN genre g ON vgg.genre_id = g.id WHERE vgg.genre_id = (?) ORDER BY vg.title"))){
				echo "Prepare failed: " . $stmt->errno . " " .$stmt->error;
			}
			if(!($stmt->bind_param("i",$_POST['genre']))){
					echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
				}
			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($genre, $id, $title, $release_year, $company, $rating)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}

			while($stmt->fetch()){							
				array_push($gameArray, ["id" => $id, "title" => $title, "release_year" => $release_year, "publisher"=> $company, "rating" => $rating, "genres" => "","platforms" => ""]);
				
			}
			$stmt->close();
			echo "<h3>Filtered by genre: " . $genre . "</h3>";
		}

		echo "<a href='index.php'>Go Back to All Games</a><br><br>";
	?>

	<!-- place all elements in the games array into a table --> 
	<table class="database-table">
		<tr>
			<th>Title</th>
			<th>Release Year</th>
			<th>Publisher</th>
			<th>Genre(s)</th>
			<th>Platform(s)</th>
			<th>Rating</th>
			<th></th>
		</tr>
			

		<?php
			foreach($gameArray as $game){

				// Call databse to get all platforms for each game and put into a single string 
				if(!($stmt = $mysqli->prepare("SELECT name FROM videogame_platform vp INNER JOIN platform p ON p.id = vp.platform_id WHERE vp.videogame_id=" . $game["id"]))){
					echo "Prepare failed: " . $stmt->errno . " " .$stmt->error;
				}
				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($name)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}

				while($stmt->fetch()){							
					$game["platforms"] = $game["platforms"] . $name . "<br>";
				}
				$stmt->close();
				
				// Call databse to get all genres for each game and put into a single string 
				if(!($stmt = $mysqli->prepare("SELECT name FROM videogame_genre vg INNER JOIN genre g ON g.id = vg.genre_id WHERE vg.videogame_id=" . $game["id"]))){
					echo "Prepare failed: " . $stmt->errno . " " .$stmt->error;
				}
				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($name)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}

				while($stmt->fetch()){							
					$game["genres"] = $game["genres"] . $name . "<br>";
				}
				$stmt->close();

				// Print out new row with game data 
				echo "<tr>\n<td>\n" . $game["title"] . "\n</td>\n<td>\n" . $game["release_year"] . "\n</td>\n<td>" . $game["publisher"] . "\n</td>\n<td>" . $game["genres"] . "\n</td>\n<td>" . $game["platforms"] . "\n</td>\n<td>" . $game["rating"] . "\n</td>\n<td>" . "<form action='delete.php' method='post'><input type='hidden' name='type' value='game'><input type='hidden' name='id' value='" . $game["id"] . "'><input class='delete' type='submit' value='X' name='deleteGame'></form>" . "\n</td>\n</tr>"; 
			}
		?>
	</table>
</div>
<?php include("footer.php"); ?>