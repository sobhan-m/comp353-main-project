<?php 
	require_once("header.php"); 
	fileHeader("Query 8");
?>

<form method = "post" class="form-input">
	<label for = "name"> Province Name * </label>
	<input type = "text" id = "name" name="name" placeholder="QC"/>
    <label for = "name"> Age Group </label>
    <input type="text" name="AgeGroupID" placeholder="10">

	<button type = "submit" name = "update" value = "update"> Update Value </button>
</form>

<?php

	if ($_POST != null)
	{
		// Updating stuff.
		if ($_POST["update"] != NULL)
		{
			if ($_POST["name"] != null)
			{
				$name = "'".$_POST["name"]."'";
				$AgeGroupID = "'".$_POST["AgeGroupID"]."'";

				$insert = "
				UPDATE Province
                SET name = $name, ageGroup=$AgeGroupID
                WHERE name = $name;";

				if ($conn->query($insert) === TRUE) {
					echo "<p> Successfully updated the entry!</p>";
				} else {
					echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
				}
			}
			else
			{
				echo "<p> Please fill the 'Name' and 'AgeGroupID' inputs with the AgeGroupID that you want to set for that province. </p>";
			}
			
		}
		
	}
?>


<?php require("footer.php"); ?>