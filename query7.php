<?php 
	require_once("header.php"); 
	fileHeader("Query 7");
?>

<form method = "post" class="form-input">
	<label for = "name"> Province Name * </label>
	<input type = "text" id = "name" name="name" placeholder="QC"/>
    <label for = "name"> Age Group </label>
    <input type="text" name="AgeGroupID" placeholder="10">

	<button type = "submit" name = "insert" value = "insert"> Insert Value </button>

	<label for = "queryName"> Query Province Name </label>
	<input type = "text" id = "queryName" name="queryName" placeholder="QC"/>

	<button type = "submit" name = "query" value = "query"> Query Table </button>
	<button type = "submit" name = "delete" value = "delete"> Delete Value </button>
	<button type = "submit" name = "update" value = "update"> Update Value </button>
</form>

<?php

	if ($_POST != null)
	{
		// Inserting stuff.
		if ($_POST["insert"] != NULL)
		{
			$name = "'".$_POST["name"]."'";
			$AgeGroupID = $_POST["AgeGroupID"] == "" ? "DEFAULT" : "'".$_POST["AgeGroupID"]."'";

			$insert = "
			INSERT INTO Province(name, ageGroup)
			VALUES ($name, $AgeGroupID);";

			if ($conn->query($insert) === TRUE) {
				echo "<p> Successfully inserted!</p>";
			} else {
				echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
			}
		}

		// Querying stuff.
		if ($_POST["query"] != NULL)
		{
			if ($_POST["queryName"] != "")
			{
				$name = "'".$_POST["queryName"]."'";
				$query = "
				SELECT *
                FROM Province
                WHERE name = $name;";
			}
			else
			{
				$query = "
				SELECT *
				FROM Province";
			}

			$result = $conn->query($query);

			if (mysqli_num_rows($result) > 0) 
			{
				echo "<h2> Province Information </h2>";
				echo "
					<table>
						<tr>
							<th> Province Name </th>
							<th> Province Age Group ID </th>
						</tr>";

				while($row = mysqli_fetch_assoc($result)) 
				{
					echo "<tr>
							<td> ".$row["name"]." </td>
							<td> ".$row["ageGroup"]." </td>					
						</tr>";
				}
				echo "</table>";
			}
				
		}

		if ($_POST["delete"] != NULL)
		{
			if ($_POST["queryName"] != null)
			{
				$name = "'".$_POST["queryName"]."'";
				$query = "
				DELETE FROM Province
				WHERE name = $name";

				if ($conn->query($query) === TRUE) {
					echo "<p> Successfully deleted the entry!</p>";
				} else {
					echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
				}
			}
			else
			{
				echo "<p> Please fill the 'Query Name' input with the province you want to delete. </p>";
			}
		}

		// Updating stuff.
		if ($_POST["update"] != NULL)
		{
			if ($_POST["queryName"] != null)
			{
				$name = "'".$_POST["name"]."'";
				$AgeGroupID = $_POST["AgeGroupID"] == "" ? "DEFAULT" : "'".$_POST["AgeGroupID"]."'";

				$queryName = "'".$_POST["queryName"]."'";
				$insert = "
				UPDATE Province
                SET name = $name, ageGroup=$AgeGroupID
                WHERE name = $queryName;";

				if ($conn->query($insert) === TRUE) {
					echo "<p> Successfully updated the entry!</p>";
				} else {
					echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
				}
			}
			else
			{
				echo "<p> Please fill the 'Query Name' input with the Province you want to update. </p>";
			}
			
		}
		
	}
?>


<?php require("footer.php"); ?>