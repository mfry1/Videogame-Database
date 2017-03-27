<?php include("header.php"); ?>

<div class="container">
	<h1>Companies</h1>
	<!-- Form to add new company to the database --> 
	<fieldset>
		<legend>Add New Company</legend>
			<form action="addcompany.php" method="post">
				<label for="name">Name: </label>
					<input type="text" name="name">
				<label for="location">HQ Location: </label>
					<input type="text" name="location">
				<label for="president">President: </label>
					<input type="text" name="president">
				<input class="btn" type="submit" name="add" value="Add">
			</form>
	</fieldset><br>

	<!-- Table to display all companies -->
	<table class="database-table">
		<tr>
			<th>Name</th>
			<th>HQ Location</th>
			<th>President</th>
			<th>Platforms Released</th>
			<th></th>
		</tr>
		<?php

			$companyArray = [];	// Array to hold all companies. Each company is an array within this array 

			// Create array of all entries in company table 
			if(!($stmt = $mysqli->prepare("SELECT id, name, hq_location, president  FROM company ORDER BY name;"))){
				echo "Prepare failed: " . $stmt->errno . " " .$stmt->error;
			}
			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($id, $name, $location, $president)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}

			while($stmt->fetch()){							
				array_push($companyArray, ["id" => $id, "name" => $name, "location" => $location, "president"=> $president, "platforms" => ""]);
			}
			$stmt->close();



			// Place everything in game array into a table 
			foreach($companyArray as $company){

				// Call databse to get all platforms for each game and put into a single string 
				if(!($stmt = $mysqli->prepare("SELECT p.name FROM company c INNER JOIN platform p ON p.company_id = c.id WHERE p.company_id=" . $company["id"]))){
					echo "Prepare failed: " . $stmt->errno . " " .$stmt->error;
				}
				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($name)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}

				while($stmt->fetch()){							
					$company["platforms"] = $company["platforms"] . $name . "<br>";
				}
				$stmt->close();
				
				// Print out new row with game data 
				echo "<tr>\n<td>\n" . $company["name"] . "\n</td>\n<td>\n" . $company["location"] . "\n</td>\n<td>" . $company["president"] . "\n</td>\n<td>" . $company["platforms"] . "\n</td>\n<td>" . "<form action='delete.php' method='post'><input type='hidden' name='type' value='company'><input type='hidden' name='id' value='" . $company["id"] . "'><input class='delete' type='submit' value='X' name='deleteCompany'></form>" . "\n</td>\n</tr>"; 
			}
		?>
	</table>
</div>

<?php include("footer.php"); ?>