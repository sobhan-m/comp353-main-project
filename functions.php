<?php

function connectToDatabase($serverName, $userName, $password, $databaseName)
{
	$conn = new mysqli($serverName, $userName, $password, $databaseName);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	return $conn;
}

// Make a query with: $result = $mysqli->query("SELECT Blah");

?>