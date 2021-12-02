<?php 
	require_once("header.php"); 
	fileHeader("Query 2 - Public Health Worker");
?>

<div class="instructions">
	<p>
		Please enter the information regarding the public health worker.
	</p>
</div>

<div class = "row button-prompts">
	<button type="button" onclick="DisplayInserts();"> Insert </button>
	<button type="button" onclick="DisplayQueries();"> Queries </button>
	<button type="button" onclick="DisplayDeletes();"> Delete </button>
	<button type="button" onclick="DisplayUpdates();"> Update </button>
</div>


<form method = "post" class="form-input">

    <label for = "id" class = "insert"> Person ID * </label>
	<input type = "text" id = "id" name="id" placeholder="Person ID" class = "insert" required/>

    <label for = "pID" class = "query delete update"> Person ID * </label>
	<input type = "text" id = "pID" name="pID" placeholder="Person ID" class = "query delete update" required/>

    <label for = "medicareIssueDate" class = "insert"> Medicare issue date </label>
	<input type = "date" id = "medicareIssueDate" name="medicareIssueDate" class = "insert"/>

    <label for = "medicareExpiryDate" class = "insert"> Medicare expiry date </label>
	<input type = "date" id = "medicareExpiryDate" name="medicareExpiryDate" class = "insert"/>

	<label for = "ssn" class = "update insert"> SSN </label>
	<input type = "text" id = "ssn" name="ssn" class = "update insert"/>

    <label for = "employeeType" class = "update insert"> Employee Type </label>
	<input type = "text" id = "employeeType" name="employeeType" class = "update insert"/>

    <button type = "submit" name = "insert" value = "insert" class = "insert"> Insert Value </button>

    <button type = "submit" name = "query" value = "query" class = "query"> Query Table </button>

    <button type = "submit" name = "delete" value = "delete" class = "delete"> Delete Value </button>

    <button type = "submit" name = "update" value = "update" class = "update"> Update Value </button>

</form>

<script type="text/javascript">
	var queries = document.getElementsByClassName("query");
	var updates = document.getElementsByClassName("update");
	var deletes = document.getElementsByClassName("delete");
	var inserts = document.getElementsByClassName("insert");

	function HideAll(input)
	{
		for (let i = 0; i < input.length; ++i)
		{
			if (input[i].required == true)
				input[i].required = false;
			input[i].style.display = "none";
		}
	}

	function DisplayAll(input)
	{
		for (let i = 0; i < input.length; ++i)
		{
			input[i].style.display = "block";
		}

		buttons = document.getElementsByTagName("button");
		for (let i = 0; i < buttons.length; ++i)
		{
			if (buttons[i].style.display == "none")
			{
				buttons[i].disabled = true;
			}
			else
			{
				buttons[i].disabled = false;
			}
		}
	}

	function DisplayQueries()
	{
		HideAll(updates);
		HideAll(deletes);
		HideAll(inserts);
		DisplayAll(queries);
	}

	function DisplayUpdates()
	{
		HideAll(queries);
		HideAll(deletes);
		HideAll(inserts);
		DisplayAll(updates);
	}

	function DisplayDeletes()
	{
		HideAll(queries);
		HideAll(updates);
		HideAll(inserts);
		DisplayAll(deletes);
	}

	function DisplayInserts()
	{
		HideAll(queries);
		HideAll(updates);
		HideAll(deletes);
		DisplayAll(inserts);
	}

	HideAll(updates);
	HideAll(queries);
	HideAll(deletes);
	HideAll(inserts);

</script>

<?php

	if ($_POST != null)
	{
		// Inserting stuff.
		if ($_POST["insert"] != NULL)
		{
			$pID = "'".$_POST["id"]."'";
            $medicareIssue = "'".$_POST["medicareIssueDate"]."'";
            $medicareExpiry = "'".$_POST["medicareExpiryDate"]."'";
            $ssn = "'".$_POST["ssn"]."'";
            $employeeType = "'".$_POST["employeeType"]."'";

			$insert = "
			INSERT INTO Registered (id, medicareIssueDate, medicareExpiryDate)
            VALUES ($pID, $medicareIssue, $medicareExpiry);";

            $insertHW = "
            INSERT INTO HealthWorker(pID, ssn, employeeType)
            VALUES($pID, $ssn, $employeeType)";

			if ($conn->query($insert) === TRUE) {
				echo "<p> Successfully entered the result!</p>";
			} else {
				echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
			}

            if ($conn->query($insertHW) === TRUE) {
				echo "<p> Successfully entered the result!</p>";
			} else {
				echo "<p> Error: " . $insertHW . ": <br>" . $conn->error . "</p>";
			}
		}

		// Querying stuff.
		if ($_POST["query"] != NULL)
		{
			if ($_POST["pID"] != "")
			{
				$pID = "'".$_POST["pID"]."'";
				$query = "
				SELECT * FROM HealthWorker
                WHERE pID = $pID";
			}
			else
			{
				$query = "
				SELECT *
				FROM HealthWorker";
			}

			$result = $conn->query($query);

			if (mysqli_num_rows($result) > 0) 
			{
				echo "<h2> Health Worker </h2>";
				echo "
					<table>
						<tr>
							<th> Person ID </th>
							<th> SSN </th>
							<th> Employee Type </th>
						</tr>";

				while($row = mysqli_fetch_assoc($result)) 
				{
					echo "<tr>
							<td> ".$row["pID"]." </td>
							<td> ".$row["ssn"]." </td>
							<td> ".$row["employeeType"]." </td>				
						</tr>";
				}
				echo "</table>";
			}
			else
			{
				echo "<p>".$pID." does not have this health worker </p>";
			}
				
		}

		if ($_POST["delete"] != NULL)
		{
			if ($_POST["pID"] != null)
			{
				$pID = "'".$_POST["pID"]."'";
				$query = "
				DELETE FROM HealthWorker
				WHERE pID = $pID";

				if ($conn->query($query) === TRUE) {
					echo "<p> Successfully deleted the entry!</p>";
				} else {
					echo "<p> Error: " . $query . ": <br>" . $conn->error . "</p>";
				}
			}
			else
			{
				echo "<p> Please fill the 'Person ID' input with the ID you want to delete. </p>";
			}
			
		}

		// Updating stuff.
		if ($_POST["update"] != NULL)
		{
			if ($_POST["pID"] != null)
			{
				$pID = "'".$_POST["pID"]."'";
				$ssn = "'".$_POST["ssn"]."'";
				$employeeType = "'".$_POST["employeeType"]."'";

				$update = "
				UPDATE HealthWorker
                SET ssn = $ssn, employeeType = $employeeType
                WHERE pID = $pID";

				if ($conn->query($update) === TRUE) {
					echo "<p> Successfully updated the entry!</p>";
				} else {
					echo "<p> Error: " . $update . ": <br>" . $conn->error . "</p>";
				}
			}
			else
			{
				echo "<p> Please fill the 'ID' of the Health Worker you wish to modify/update and the ssn and employee type you wish to set them to. </p>";
			}
			
		}
		
	}
?>


<?php require("footer.php"); ?>