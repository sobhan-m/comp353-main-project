<?php

function connectToDatabase($serverName, $userName, $password, $databaseName)
{
	$conn = new mysqli($serverName, $userName, $password, $databaseName);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	return $conn;
}

function quote($input)
{
	return "'".$input."'";
}

function quoteOrDefault($input, $default = "DEFAULT")
{
	if ($input != "")
		return quote($input);
	else
		return $default;
}


// Make a query with: $result = $mysqli->query("SELECT Blah");

?>