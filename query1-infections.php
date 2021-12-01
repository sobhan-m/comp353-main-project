<?php 
	require_once("header.php"); 
	fileHeader("Infection History");
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

	<label for = "firstName" class = "update insert"> First Name * </label>
	<input type = "text" id = "firstName" name="firstName" placeholder="First Name" class = "update insert" required/>

	<label for = "middleInitial" class = "update insert"> Middle Initial * </label>
	<input type = "text" id = "middleInitial" name="middleInitial" placeholder="Middle Initial" class = "update insert" required/>
    
	<label for = "lastName" class = "update insert"> Last Name * </label>
	<input type = "text" id = "lastName" name="lastName" placeholder="Last Name" class = "update insert" required/>

    <label for = "infectionDate" class = "update insert"> Infection Date </label>
	<input type = "date" id = "infectionDate" name="infectionDate" class = "update insert"/>

    <label for = "type" class = "update insert"> Infection Type </label>
	<select id = "type" name="type" class = "update insert">
		<?php printInfectionTypeOptions($conn); ?>
	</select>

	<label for = "queryFirstName" class = "update delete query"> First Name Query * </label>
	<input type = "text" id = "queryFirstName" name="queryFirstName" placeholder="First Name" class = "update delete query" required/>

	<label for = "queryMiddleInitial" class = "update delete query"> Middle Initial Query * </label>
	<input type = "text" id = "queryMiddleInitial" name="queryMiddleInitial" placeholder="Middle Initial" class = "update delete query" required/>
    
	<label for = "queryLastName" class = "update delete query"> Last Name Query * </label>
	<input type = "text" id = "queryLastName" name="queryLastName" placeholder="Last Name" class = "update delete query" required/>

	<label for = "queryInfectionDate" class = "update delete query"> Infection Date </label>
	<input type = "date" id = "queryInfectionDate" name="queryInfectionDate" class = "update delete query"/>

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
		document.getElementById("firstName").required = true;
        document.getElementById("middleInitial").required = true;
        document.getElementById("lastName").required = true;
		document.getElementById("infectionDate").required = true;
		document.getElementById("queryFirstName").required = true;
        document.getElementById("queryMiddleInitial").required = true;
        document.getElementById("queryLastName").required = true;
		document.getElementById("queryInfectionDate").required = true;
	}

	function DisplayDeletes()
	{
		HideAll(queries);
		HideAll(updates);
		HideAll(inserts);
		DisplayAll(deletes);
        document.getElementById("queryFirstName").required = true;
        document.getElementById("queryMiddleInitial").required = true;
        document.getElementById("queryLastName").required = true;
		document.getElementById("queryInfectionDate").required = true;
	}

	function DisplayInserts()
	{
		HideAll(queries);
		HideAll(updates);
		HideAll(deletes);
		DisplayAll(inserts);
		document.getElementById("firstName").required = true;
        document.getElementById("middleInitial").required = true;
        document.getElementById("lastName").required = true;
		document.getElementById("infectionDate").required = true;
        
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
			$firstName = quote($_POST["firstName"]);
			$middleInitial = quote($_POST["middleInitial"]);
            $lastName = quote($_POST["lastName"]);
            $infectionDate = quote($_POST["infectionDate"]);
            $type = quoteOrDefault($_POST["type"]);

            $pID = getPersonId($firstName, $middleInitial, $lastName, $conn);

            $insertInInfectionHistory = "
            INSERT INTO InfectionHistory(personID, infectionDate, type)
            VALUES ($pID, $infectionDate, $type)";

			if ($conn->query($insertInInfectionHistory)) {
				echo "<p> Successfully entered a new infection history!</p>";
			} else {
				echo "<p> Error: " . $insertInInfectionHistory . ": <br>" . $conn->error . "</p>";
			}
		}

		// Querying stuff. / Display
		if ($_POST["query"] != NULL)
		{
			$pID = null;
			if ($_POST["queryFirstName"] != "" && $_POST["queryMiddleInitial"] != ""  && $_POST["queryLastName"] != "" &&  $_POST["queryInfectionDate"] == "")
			{
				$firstName = quote($_POST["queryFirstName"]);
				$middleInitial = quote($_POST["queryMiddleInitial"]);
				$lastName = quote($_POST["queryLastName"]);

				$pID = getPersonId($firstName, $middleInitial, $lastName, $conn);

				$query = "
				SELECT firstName, middleInitial, lastName, infectionDate, type
				FROM InfectionHistory INNER JOIN Person ON personID = id
				WHERE personID = $pID";
			}
			else if ($_POST["queryFirstName"] != "" && $_POST["queryMiddleInitial"] != ""  && $_POST["queryLastName"] != "" && $_POST["queryInfectionDate"] != "")
			{
				$firstName = quote($_POST["queryFirstName"]);
				$middleInitial = quote($_POST["queryMiddleInitial"]);
				$lastName = quote($_POST["queryLastName"]);
				$infectionDate = quote($_POST["queryInfectionDate"]);

				$pID = getPersonId($firstName, $middleInitial, $lastName, $conn);

				$query = "
				SELECT firstName, middleInitial, lastName, infectionDate, type
				FROM InfectionHistory INNER JOIN Person ON personID = id
				WHERE personID = $pID AND infectionDate = $infectionDate";
			}
			else
			{
				$query = "
				SELECT firstName, middleInitial, lastName, infectionDate, type
				FROM InfectionHistory INNER JOIN Person ON personID = id";

				$pID = 1234; // Random number.
			}

			if ($pID != null)
			{
				$result = $conn->query($query);

				if (mysqli_num_rows($result) > 0) 
				{
					echo "<h2> Person</h2>";
					echo "
						<table>
							<tr>
								<th> First Name </th>
								<th> Middle Initial </th>
								<th> Last Name </th>
								<th> Infection Date </th>
								<th> Infection Type </th>
							</tr>";

					while($row = mysqli_fetch_assoc($result)) 
					{
						echo "<tr>
								<td> ".$row["firstName"]." </td>
								<td> ".$row["middleInitial"]." </td>
								<td> ".$row["lastName"]." </td>
								<td> ".$row["infectionDate"]." </td>	
								<td> ".$row["type"]." </td>
							</tr>";
					}
					echo "</table>";
				}
				else
				{
					echo "<p> There are no results that match your request! </p>";
				}
			}
				
		}

        // Deleting stuff.
		if ($_POST["delete"] != NULL)
		{
			
			$firstName = quote($_POST["queryFirstName"]);
			$middleInitial = quote($_POST["queryMiddleInitial"]);
			$lastName = quote($_POST["queryLastName"]);
			$infectionDate = quote($_POST["queryInfectionDate"]);

			$pID = getPersonId($firstName, $middleInitial, $lastName, $conn);

			if ($pID != null)
			{
				$query = "DELETE FROM InfectionHistory WHERE personID = $pID AND infectionDate = $infectionDate";

				if ($conn->query($query) === TRUE) {
					echo "<p> Successfully deleted the entry!</p>";
				} else {
					echo "<p> Error: " . $query . ": <br>" . $conn->error . "</p>";
				}
			}
		}

		// Updating stuff.
		if ($_POST["update"] != NULL)
		{
			$firstName = quote($_POST["firstName"]);
			$middleInitial = quote($_POST["middleInitial"]);
			$lastName = quote($_POST["lastName"]);
			$infectionDate = quote($_POST["infectionDate"]);
			$type = quoteOrDefault($_POST["type"]);

			$queryFirstName = quote($_POST["queryFirstName"]);
			$queryMiddleInitial = quote($_POST["queryMiddleInitial"]);
			$queryLastName = quote($_POST["queryLastName"]);
			$queryInfectionDate = quote($_POST["queryInfectionDate"]);

			$pID = getPersonId($queryFirstName, $queryMiddleInitial, $queryLastName, $conn);
			$newPID = getPersonId($firstName, $middleInitial, $lastName, $conn);

			if ($pID != null && $newPID != null)
			{
				$updateInfection = "
				UPDATE InfectionHistory
				SET personID = $newPID, infectionDate = $infectionDate, type = $type
				WHERE personID = $pID AND infectionDate = $queryInfectionDate";


			if ($conn->query($updateInfection) === TRUE) {
				echo "<p> Successfully updated the entry!</p>";
			} else {
				echo "<p> Error: " . $updateInfection . ": <br>" . $conn->error . "</p>";
			}
			}
			
		}
		
	}
?>


<?php require("footer.php"); ?>