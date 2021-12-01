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

function getPersonId($firstName, $conn)
{

	$getID = "SELECT id FROM Person WHERE firstName = $firstName";
	$resultSQL = $conn->query($getID); 
	$idRow = mysqli_fetch_assoc($resultSQL);
	$pID = $idRow["id"];
	echo $pID."Person ID FUNCTION";
	return $pID;
}

// Make a query with: $result = $mysqli->query("SELECT Blah");

?>