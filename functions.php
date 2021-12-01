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

function getPersonId($firstName, $middleInitial, $lastName, $conn)
{

	$getID = "SELECT id FROM Person WHERE firstName = $firstName AND middleInitial = $middleInitial AND lastName = $lastName";
	$result = $conn->query($getID); 
	if (mysqli_num_rows($result) == 0)
	{
		echo "<p> This person does not exist in our database. </p>";
		return null;
	}
	$row = mysqli_fetch_assoc($result);
	return $row["id"];
}

// Make a query with: $result = $mysqli->query("SELECT Blah");

?>