<?php
	require_once("credentials.php"); 
	require_once("functions.php");
	$conn = connectToDatabase($serverName, $userName, $password, $databaseName);

	function fileHeader($title)
	{
		echo '
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel = "stylesheet" type = "text/CSS" href = "style.css"/>
			<link rel = "stylesheet" type = "text/CSS" href = "colours.css"/>
			<title>'.$title.'</title>
		</head>
		<body>
		';

		echo 
		"
		<header> 
			<h1> $title </h1> 
		</header>
		<hr>
		";
	}
	
?>



