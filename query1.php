<?php 
	require_once("header.php"); 
	fileHeader("Query 1");
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

	<label for = "firstName" class = "update insert"> First Name  </label>
	<input type = "text" id = "firstName" name="firstName" placeholder="First Name" class = "update insert" required/>

	<label for = "middleInitial" class = "update insert"> First Name  </label>
	<input type = "text" id = "middleInitial" name="middleInitial" placeholder="Middle Initial" class = "update insert" required/>
    
	<label for = "lastName" class = "update insert"> Last Name  </label>
	<input type = "text" id = "lastName" name="lastName" placeholder="Last Name" class = "update insert" required/>

	<label for = "dateOfBirth" class = "update insert"> Date Of Birth </label>
	<input type = "date" id = "dateOfBirth" name="dateOfBirth" class = "update insert"/>

    <label for = "telephoneNumber" class = "update insert"> Telephone Number </label>
	<input type = "text" id = "telephoneNumber" name="telephoneNumber" placeholder="111111" class = "update insert" pattern="[0-9]+"/>

    <label for = "address" class = "update insert"> Address </label>
	<input type = "text" id = "address" name="address" placeholder="# Street Name" class = "update insert" />

    <label for = "city" class = "update insert"> City </label>
	<input type = "text" id = "city" name="city" placeholder="City name" class = "update insert" />

    <label for = "province" class = "update insert"> Province </label>
	<input type = "text" id = "province" name="province" placeholder="QC" class = "update insert" />

    <label for = "postalCode" class = "update insert"> Postal Code </label>
	<input type = "text" id = "postalCode" name="postalCode" placeholder="A1A1A1" class = "update insert" />

    <label for = "citizenship" class = "update insert"> Citizenship </label>
	<input type = "text" id = "citizenship" name="citizenship" placeholder="Canadian" class = "update insert" />

    <label for = "emailAddress" class = "update insert"> Email address </label>
	<input type = "text" id = "emailAddress" name="emailAddress" placeholder="name@domain.com" class = "update insert" />

    <label for = "ageGroupID" class = "update insert"> Age Group ID </label>
	<input type = "text" id = "ageGroupID" name="ageGroupID" placeholder="0-10" class = "update insert" />

    <label for = "infectionDate" class = "update insert"> Infection Date </label>
	<input type = "date" id = "infectionDate" name="infectionDate" class = "update insert"/>

    <label for = "type" class = "update insert"> Infection Type </label>
	<input type = "text" id = "type" name="type" placeholder="Alpha" class = "update insert" />

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
			$firstName = quote($_POST["firstName"]);
			$middleInitial = quote($_POST["middleInitial"]);
            $lastName = quote($_POST["lastName"]);
            $dateOfBirth = quote($_POST["dateOfBirth"]);
			$telephoneNumber = quote($_POST["telephoneNumber"]);
            $address = quote($_POST["address"]);
            $city = quote($_POST["city"]);
			$province = quote($_POST["province"]);
            $postalCode = quote($_POST["postalCode"]);
            $citizenship = quote($_POST["citizenship"]);
			$emailAddress = quote($_POST["emailAddress"]);
            $ageGroupID = quote($_POST["ageGroupID"]);
            $infectionDate = quote($_POST["infectionDate"]);
            $type = quote($_POST["type"]);

			$insertInPerson = "
			INSERT INTO Person (firstName, middleInitial, lastName, dateOfBirth, telephoneNumber, address, city, province, postalCode, citizenship, emailAddress, ageGroupID) 
            VALUES($firstName, $middleInitial, $lastName, $dateOfBirth, $telephoneNumber, $address, $city, $province, $postalCode, $citizenship, $emailAddress, $ageGroupID)";

            $getID = "SELECT id FROM Person WHERE firstName = $firstName";

            $resultSQL = $conn->query($getID); 
            $idRow = mysqli_fetch_assoc($resultSQL);

            $pID = $idRow["id"];

            $insertInInfectionHistory = "
            INSERT INTO InfectionHistory(personID, infectionDate, type)
            VALUES ($pID, $infectionDate $type)";

			if (($conn->query($insertInPerson) === TRUE) && $conn->query($insertInInfectionHistory)) {
				echo "<p> Successfully entered a new person and their infection history !</p>";
			} else {
				echo "<p> Error: " . $insertInPerson . ": <br>" . $conn->error . "</p>";
			}
		}

		// Querying stuff.
		if ($_POST["query"] != NULL)
		{
			if ($_POST["queryName"] != "")
			{
				$name = quote($_POST["queryName"]);
				$query = "
				SELECT * FROM Person 
                WHERE firstName = $name";
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