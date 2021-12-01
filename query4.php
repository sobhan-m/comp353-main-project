<?php 
	require_once("header.php"); 
	fileHeader("Query 4");
?>

<div class="instructions">
	<p>
		To get the details of the nurses, please enter the minimum number of doses you want the nurse to have done.
	</p>
</div>

<div class = "row button-prompts">
	<button type="button" onclick="DisplayInserts();"> Insert </button>
	<button type="button" onclick="DisplayQueries();"> Queries </button>
	<button type="button" onclick="DisplayDeletes();"> Delete </button>
	<button type="button" onclick="DisplayUpdates();"> Update </button>
</div>


<form method = "post" class="form-input">

	<label for = "vaccinationName" class = "update insert"> Vaccination Name * </label>
	<input type = "text" id = "vaccinationName" name="vaccinationName" placeholder="Pfizer" class = "update insert" required/>

	<label for = "dateOfApproval" class = "update insert"> Date Of Approval </label>
	<input type = "date" id = "dateOfApproval" name="dateOfApproval" class = "update insert"/>

	<label for = "vaccinationType" class = "update insert"> Vaccination Type </label>
	<select id = "vaccinationType" name = "vaccinationType" class = "update insert">
		<option value = "SAFE"> Safe </option>
		<option value = "SUSPENDED"> Suspended </option>
	</select>

	<label for = "dateOfSuspension" class = "update insert"> Date Of Suspension </label>
	<input type = "date" id = "dateOfSuspension" name="dateOfSuspension" class = "update insert"/>

	<button type = "submit" name = "insert" value = "insert" class = "insert"> Insert Value </button>

	<label for = "queryName" class = "update query delete"> Search Vaccination Name </label>
	<input type = "text" id = "queryName" name="queryName" placeholder="Pfizer" class = "update query delete"/>

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
		document.getElementById("vaccinationName").required = true;
		document.getElementById("queryName").required = true;
	}

	function DisplayDeletes()
	{
		HideAll(queries);
		HideAll(updates);
		HideAll(inserts);
		DisplayAll(deletes);
		document.getElementById("queryName").required = true;
	}

	function DisplayInserts()
	{
		HideAll(queries);
		HideAll(updates);
		HideAll(deletes);
		DisplayAll(inserts);
		document.getElementById("vaccinationName").required = true;
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
			$vaccinationName = quote($_POST["vaccinationName"]);
			$dateOfApproval = quoteOrDefault($_POST["dateOfApproval"]);
			$vaccinationType = quoteOrDefault($_POST["vaccinationType"]);
			$dateOfSuspension = quoteOrDefault($_POST["dateOfSuspension"]);

			$insert = "
			INSERT INTO ApprovedVaccinations (vaccinationName, dateOfApproval, vaccinationType, dateOfSuspension)
			VALUES ($vaccinationName, $dateOfApproval, $vaccinationType, $dateOfSuspension)";

			if ($conn->query($insert) === TRUE) {
				echo "<p> Successfully entered the result!</p>";
			} else {
				echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
			}
		}

		// Querying stuff.
		if ($_POST["query"] != NULL)
		{
			if ($_POST["queryName"] != "")
			{
				$name = quote($_POST["queryName"]);
				$query = "
				SELECT *
				FROM ApprovedVaccinations
				WHERE vaccinationName = $name";
			}
			else
			{
				$query = "
				SELECT *
				FROM ApprovedVaccinations";
			}

			$result = $conn->query($query);

			if (mysqli_num_rows($result) > 0) 
			{
				echo "<h2> Vaccines </h2>";
				echo "
					<table>
						<tr>
							<th> Vaccination Name </th>
							<th> Date Of Approval </th>
							<th> Vaccination Type </th>
							<th> Date Of Suspension </th>
						</tr>";

				while($row = mysqli_fetch_assoc($result)) 
				{
					echo "<tr>
							<td> ".$row["vaccinationName"]." </td>
							<td> ".$row["dateOfApproval"]." </td>
							<td> ".$row["vaccinationType"]." </td>
							<td> ".$row["dateOfSuspension"]." </td>					
						</tr>";
				}
				echo "</table>";
			}
			else
			{
				echo "<p> There are no vaccines that match your request! </p>";
			}
				
		}

		if ($_POST["delete"] != NULL)
		{
			if ($_POST["queryName"] != null)
			{
				$name = quote($_POST["queryName"]);
				$query = "
				DELETE FROM ApprovedVaccinations
				WHERE vaccinationName = $name";

				if ($conn->query($query) === TRUE) {
					echo "<p> Successfully deleted the entry!</p>";
				} else {
					echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
				}
			}
			else
			{
				echo "<p> Please fill the 'Query Name' input with the facility you want to delete. </p>";
			}
			
		}

		// Updating stuff.
		if ($_POST["update"] != NULL)
		{
			if ($_POST["queryName"] != null)
			{
				$vaccinationName = quote($_POST["vaccinationName"]);
				$dateOfApproval = quoteOrDefault($_POST["dateOfApproval"]);
				$vaccinationType = quoteOrDefault($_POST["vaccinationType"]);
				$dateOfSuspension = quoteOrDefault($_POST["dateOfSuspension"]);

				$name = quote($_POST["queryName"]);
				$insert = "
				UPDATE ApprovedVaccinations
				SET vaccinationName = $vaccinationName, dateOfApproval = $dateOfApproval, 
					vaccinationType = $vaccinationType, dateOfSuspension = $dateOfSuspension
				WHERE vaccinationName = $name";

				if ($conn->query($insert) === TRUE) {
					echo "<p> Successfully updated the entry!</p>";
				} else {
					echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
				}
			}
			else
			{
				echo "<p> Please fill the 'Query Name' input with the facility you want to update. </p>";
			}
			
		}
		
	}
?>


<?php require("footer.php"); ?>