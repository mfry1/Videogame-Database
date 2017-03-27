<?php include("header.php"); ?>


<div class="container">
	<h1>Video Games</h1>
		
	<!-- Form to add the database's videogame table -->
	<fieldset>
	<legend>Add New Game</legend>
		<form action="addgame.php" method="post">
			<input type="hidden" name="type" value="game">
			<label for="title">Title: </label>
				<input type="text" name="title">
			<label for="title">Release Year: </label>
				<input type="number" min="1950" max="2050" name="release_year" value ="">
			<!-- Publisher drop down is populated with all companies in the databse --> 
			<label for="title">Publisher: </label>
			<select name="publisher">
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
			<label for="rating">Rating: </label>
				<input type="number" min="1" max="10" name="rating" step="0.1">
			<input class="btn" type="submit" name="add" value="Add">
		</form>
	</fieldset><br>

	<div class="center">
		<div class="half-width">
			<!-- Form to add to the videogame_platform table of the database -->
			<fieldset>
			<legend>Add Game to Platform</legend>
				<form method="post" action="addgame.php">
					<input type="hidden" name="type" value="game-platform">
					<!-- drop down with all games -->
					<label for="game">Game:</label>
						<select class="dropdown" name="game">
							<?php
							if(!($stmt = $mysqli->prepare("SELECT id, title FROM videogame ORDER BY title"))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							if(!$stmt->bind_result($id, $title)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while($stmt->fetch()){
							 echo '<option value=" '. $id . ' "> ' . $title . '</option>\n';
							}
							$stmt->close();
							?>
						</select>
					<!-- drop down with all platforms -->
					<label for="platform">Platform:</label>
						<select class="dropdown" name="platform">
							<?php
							if(!($stmt = $mysqli->prepare("SELECT id, name FROM platform ORDER BY name"))){
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
					<input class="btn" type="submit" name="" value="Add">
				</form>
			</fieldset>
		</div>
		<div class="half-width">
			<!-- Form to add to videogame_genre table of databse -->
			<fieldset>
				<legend>Add Game to Genre</legend>
				<form method="post" action="addgame.php">
					<input type="hidden" name="type" value="game-genre">
					<!-- drop down with all games -->
					<label for="game">Game:</label>
						<select class="dropdown" name="game">
							<?php
							if(!($stmt = $mysqli->prepare("SELECT id, title FROM videogame ORDER BY title"))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							if(!$stmt->bind_result($id, $title)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while($stmt->fetch()){
							 echo '<option value=" '. $id . ' "> ' . $title . '</option>\n';
							}
							$stmt->close();
							?>
						</select>
					<!-- drop down with all genres --> 
					<label for="genre">Genre:</label>
					<select class="dropdown" name="genre">
							<?php
							if(!($stmt = $mysqli->prepare("SELECT id, name FROM genre ORDER BY name"))){
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
					<input class="btn" type="submit" name="" value="Add">
				</form>
			</fieldset>
		</div>
	</div>

	<br><br>
	
	<!-- Search bar to search for a game by title --> 
	<div class="search">
		<form action="filter.php" method="post">
			<input type="hidden" name="type" value="search">
			<input type="text" name="title">
			<input class="btn" type="submit" name="search" value="Search Titles">
		</form>
	</div>

	<!-- Bar for several filter forms. -->
	<div class="filters">
		<div >
			<p>Filter By:</p>
		</div>
		<!-- Filter by publisher form --> 
		<div>
			<h5>Publisher</h5>
			<form action="filter.php" method="post">
				<input type="hidden" name="type" value="filter-publisher">
				<select name="publisher">
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
				<input class="btn" type="submit" name="" value="Go">
			</form>
		</div>
		<!-- Filted by platform form --> 
		<div>
			<h5>Platform</h5>
			<form action="filter.php" method="post">
				<input type="hidden" name="type" value="filter-platform">
				<select name="platform">
					<?php
						if(!($stmt = $mysqli->prepare("SELECT id, name FROM platform ORDER BY name"))){
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
				<input class="btn" type="submit" name="" value="Go">
			</form>
		</div>
		<!-- Filter by genre form -->
		<div>
			<h5>Genre</h5>
			<form action="filter.php" method="post">
				<input type="hidden" name="type" value="filter-genre">
				<select name="genre">
					<?php
						if(!($stmt = $mysqli->prepare("SELECT id, name FROM genre ORDER BY name"))){
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
				<input class="btn" type="submit" name="" value="Go">
			</form>
		</div>
	</div>

	<!-- Table to hold results of a call to get all video games in the database -->
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

			$gameArray = [];	// Array that will hold arrays. Each sub array will represent a game. 

			// Create array of all entries in videogame table 
			if(!($stmt = $mysqli->prepare("SELECT vg.id, vg.title, vg.release_year, c.name, vg.rating FROM videogame vg LEFT JOIN company c ON vg.publishing_company_id = c.id ORDER BY vg.title"))){
				echo "Prepare failed: " . $stmt->errno . " " .$stmt->error;
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



			// Place everything in game array into a table 
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