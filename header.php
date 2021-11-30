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
			<nav class = 'row'>
			<a href='index.php'>Home</a>
			<a href='query1.php'>Query 1</a>
			<a href='query2.php'>Query 2</a>
			<a href='query3.php'>Query 3</a>
			<a href='query4.php'>Query 4</a>
			<a href='query5.php'>Query 5</a>
			<a href='query6.php'>Query 6</a>
			<a href='query7.php'>Query 7</a>
			<a href='query8.php'>Query 8</a>
			<a href='query9.php'>Query 9</a>
			<a href='query10.php'>Query 10</a>
			<a href='query11.php'>Query 11</a>
			<a href='query12.php'>Query 12</a>
			<a href='query13.php'>Query 13</a>
			<a href='query14.php'>Query 14</a>
			<a href='query15.php'>Query 15</a>
			<a href='query16.php'>Query 16</a>
			<a href='query17.php'>Query 17</a>
			<a href='query18.php'>Query 18</a>
			<a href='query19.php'>Query 19</a>
			<a href='query20.php'>Query 20</a>
		</nav>
		</header>
		
		
		";
	}
	
?>



