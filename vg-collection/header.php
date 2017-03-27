<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>

<!-- Connect to database --> 
<?php 
	ini_set('display_errors', 'On');
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","fryma-db","lpiEDEtIS8LAvGQf","fryma-db");
	if($mysqli->connect_errno){
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!-- Navagation links --> 
<h1 id="main-header">Video Game Collection Database</h1>
<div class="nav-links"><br>
	<a href="index.php">Video Games</a>
	<a href="companies.php">Companies</a>
	<a href="platforms.php">Platforms</a>
	<a href="genres.php">Genres</a>
</div>