<?php 
	require_once("header.php"); 
	fileHeader("Query 9 - Appointments");
?>

<div class="instructions">
	<p>
		All the details regarding a Person and their Infection history.
	</p>
</div>

<div class = "row button-prompts">
	<button type="button" onclick="DisplayInserts();"> Insert </button>
	<button type="button" onclick="DisplayQueries();"> Queries </button>
	<button type="button" onclick="DisplayDeletes();"> Delete </button>
	<button type="button" onclick="DisplayUpdates();"> Update </button>
</div>

<form method = "post" class="form-input">

	<label for = "firstName" class = "update insert"> First Name </label>
	<input type = "text" id = "firstName" name="firstName" placeholder="First Name" class = "update insert"/>

	<label for = "middleInitial" class = "update insert"> Middle Initial </label>
	<input type = "text" id = "middleInitial" name="middleInitial" placeholder="Middle Initial" class = "update insert"/>
    
	<label for = "lastName" class = "update insert"> Last Name </label>
	<input type = "text" id = "lastName" name="lastName" placeholder="Last Name" class = "update insert"/>

    <label for = "date" class = "update insert"> Date * </label>
	<input type = "date" id = "date" name="date" class = "update insert"/>

	<label for = "time" class = "update insert"> Time * </label>
	<input type = "time" id = "time" name="time" class = "update insert"/>

	<label for = "facilityName" class = "update insert"> Facility Name * </label>
	<input type = "text" id = "facilityName" name="facilityName" placeholder="Facility Name" class = "update insert"/>

	<label for = "queryDate" class = "update query delete"> Query Date </label>
	<input type = "date" id = "queryDate" name="queryDate" class = "update query delete"/>

	<label for = "queryTime" class = "update query delete"> Query Time </label>
	<input type = "time" id = "queryTime" name="queryTime" class = "update query delete"/>

	<label for = "queryFacilityName" class = "update query delete"> Query Facility Name </label>
	<input type = "text" id = "queryFacilityName" name="queryFacilityName" placeholder="Facility Name" class = "update query delete"/>

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
		document.getElementById("date").required = true;
        document.getElementById("time").required = true;
        document.getElementById("facilityName").required = true;
		document.getElementById("queryDate").required = true;
        document.getElementById("queryTime").required = true;
        document.getElementById("queryFacilityName").required = true;
	}

	function DisplayDeletes()
	{
		HideAll(queries);
		HideAll(updates);
		HideAll(inserts);
		DisplayAll(deletes);
        document.getElementById("queryDate").required = true;
        document.getElementById("queryTime").required = true;
        document.getElementById("queryFacilityName").required = true;
	}

	function DisplayInserts()
	{
		HideAll(queries);
		HideAll(updates);
		HideAll(deletes);
		DisplayAll(inserts);
		document.getElementById("date").required = true;
        document.getElementById("time").required = true;
        document.getElementById("facilityName").required = true;
        
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
			// Case when name is given.
			if ($_POST["firstName"] != "" && $_POST["middleInitial"] != "" && $_POST["lastName"] != "")
			{
				$date = quote($_POST["date"]);
				$time = quote($_POST["time"]);
				$facilityName = quote($_POST["facilityName"]);

				$firstName = quote($_POST["firstName"]);
				$middleInitial = quote($_POST["middleInitial"]);
				$lastName = quote($_POST["lastName"]);

				$pID = getPersonId($firstName, $middleInitial, $lastName, $conn);

				if ($pID != null)
				{
					$sql = "INSERT INTO Appointments (date, time, pID, facilityName)
							VALUES($date, $time, $pID, $facilityName)";
					if ($conn->query($sql)) {
						echo "<p> Successfully entered a new appointment!</p>";
					} else {
						echo "<p> Error: " . $sql . ": <br>" . $conn->error . "</p>";
					}
				}
			}
			else
			{
				// If no name given.

				$date = quote($_POST["date"]);
				$time = quote($_POST["time"]);
				$facilityName = quote($_POST["facilityName"]);

				$sql = "INSERT INTO Appointments (date, time, pID, facilityName)
							VALUES($date, $time, NULL, $facilityName)";
				if ($conn->query($sql)) {
					echo "<p> Successfully entered a new appointment!</p>";
				} else {
					echo "<p> Error: " . $sql . ": <br>" . $conn->error . "</p>";
				}
			}
		}

		// Querying stuff. / Display
		if ($_POST["query"] != NULL)
		{
			// If asked for specific input.

			if ($_POST["queryDate"] != "" && $_POST["queryTime"] != "" && $_POST["queryFacilityName"] != "")
			{
				$date = quote($_POST["queryDate"]);
				$time = quote($_POST["queryTime"]);
				$facilityName = quote($_POST["queryFacilityName"]);


				$sql = "SELECT p.firstName, p.middleInitial, p.lastName, a.date, a.time, a.facilityName
						FROM Appointments a LEFT JOIN Person p ON a.pID = p.id
						WHERE a.date = $date AND a.time = $time AND a.facilityName = $facilityName";

			}
			else
			{
				$sql = "SELECT p.firstName, p.middleInitial, p.lastName, a.date, a.time, a.facilityName
						FROM Appointments a LEFT JOIN Person p ON a.pID = p.id";
			}

			$result = $conn->query($sql);

			if (mysqli_num_rows($result) > 0) 
			{
				echo "<h2> Appointments </h2>";
				echo "
					<table>
						<tr>
							<th> First Name </th>
							<th> Middle Initial </th>
							<th> Last Name </th>
							<th> Date </th>
							<th> Time </th>
							<th> Facility Name </th>
						</tr>";

				while($row = mysqli_fetch_assoc($result)) 
				{
					echo "<tr>
							<td> ".$row["firstName"]." </td>
							<td> ".$row["middleInitial"]." </td>
							<td> ".$row["lastName"]." </td>
							<td> ".$row["date"]." </td>	
							<td> ".$row["time"]." </td>
							<td> ".$row["facilityName"]." </td>
						</tr>";
				}
				echo "</table>";
			}
			else
			{
				echo "<p> There are no results that match your request! </p>";
			}		
		}

        // Deleting stuff.
		if ($_POST["delete"] != NULL)
		{
			
			$date = quote($_POST["queryDate"]);
			$time = quote($_POST["queryTime"]);
			$facilityName = quote($_POST["queryFacilityName"]);


			$query = "DELETE FROM Appointments WHERE date = $date AND time = $time AND facilityName = $facilityName";

			if ($conn->query($query) === TRUE) {
				echo "<p> Successfully deleted the entry!</p>";
			} else {
				echo "<p> Error: " . $query . ": <br>" . $conn->error . "</p>";
			}
		}

		// Updating stuff.
		if ($_POST["update"] != NULL)
		{
			// Case when name is given.
			if ($_POST["firstName"] != "" && $_POST["middleInitial"] != "" && $_POST["lastName"] != "")
			{
				$queryDate = quote($_POST["queryDate"]);
				$queryTime = quote($_POST["queryTime"]);
				$queryFacilityName = quote($_POST["queryFacilityName"]);

				$date = quote($_POST["date"]);
				$time = quote($_POST["time"]);
				$facilityName = quote($_POST["facilityName"]);

				$firstName = quote($_POST["firstName"]);
				$middleInitial = quote($_POST["middleInitial"]);
				$lastName = quote($_POST["lastName"]);

				$pID = getPersonId($firstName, $middleInitial, $lastName, $conn);

				if ($pID != null)
				{
					$sql = "UPDATE Appointments SET date = $date, time = $time, facilityName = $facilityName, pID = $pID
							WHERE date = $queryDate AND time = $queryTime AND facilityName = $queryFacilityName";
					if ($conn->query($sql)) {
						echo "<p> Successfully updated the appointment!</p>";
					} else {
						echo "<p> Error: " . $sql . ": <br>" . $conn->error . "</p>";
					}
				}
			}
			else
			{
				// If no name given.

				$queryDate = quote($_POST["queryDate"]);
				$queryTime = quote($_POST["queryTime"]);
				$queryFacilityName = quote($_POST["queryFacilityName"]);

				$date = quote($_POST["date"]);
				$time = quote($_POST["time"]);
				$facilityName = quote($_POST["facilityName"]);


				$sql = "UPDATE Appointments SET date = $date, time = $time, facilityName = $facilityName, pID = NULL
						WHERE date = $queryDate AND time = $queryTime AND facilityName = $queryFacilityName";
				if ($conn->query($sql)) {
					echo "<p> Successfully updated the appointment!</p>";
				} else {
					echo "<p> Error: " . $sql . ": <br>" . $conn->error . "</p>";
				}
			}
			
		}
		
	}
?>


<?php require("footer.php"); ?>