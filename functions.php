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

function printInfectionTypeOptions($conn)
{
	$result = $conn->query("SELECT * FROM InfectionTypes");
	if (mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			$type = $row["name"];
			echo "<option value = '$type'> $type </option>";
		}
	}
	else
	{
		echo "<p> Error! No infection types found! </p>";
	}
}

function printProvinceOptions($conn)
{
	$result = $conn->query("SELECT name FROM Province");
	if (mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			$province = $row["name"];
			echo "<option value = '$province'> $province </option>";
		}
	}
	else
	{
		echo "<p> Error! No provinces found! </p>";
	}
}

// Make a query with: $result = $mysqli->query("SELECT Blah");

?>