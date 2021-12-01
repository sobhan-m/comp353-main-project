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

	<label for = "firstName" class = "update insert"> First Name * </label>
	<input type = "text" id = "firstName" name="firstName" placeholder="First Name" class = "update insert" required/>

	<label for = "middleInitial" class = "update insert"> Middle Initial * </label>
	<input type = "text" id = "middleInitial" name="middleInitial" placeholder="Middle Initial" class = "update insert" required/>
    
	<label for = "lastName" class = "update insert"> Last Name * </label>
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

    <!-- <label for = "infectionDate" class = "update insert"> Infection Date </label>
	<input type = "date" id = "infectionDate" name="infectionDate" class = "update insert"/>

    <label for = "type" class = "update insert"> Infection Type </label>
	<input type = "text" id = "type" name="type" placeholder="Alpha" class = "update insert" /> -->

	<label for = "queryFirstName" class = "update delete query"> First Name Query * </label>
	<input type = "text" id = "queryFirstName" name="queryFirstName" placeholder="First Name" class = "update delete query" required/>

	<label for = "queryMiddleInitial" class = "update delete query"> Middle Initial Query * </label>
	<input type = "text" id = "queryMiddleInitial" name="queryMiddleInitial" placeholder="Middle Initial" class = "update delete query" required/>
    
	<label for = "queryLastName" class = "update delete query"> Last Name Query * </label>
	<input type = "text" id = "queryLastName" name="queryLastName" placeholder="Last Name" class = "update delete query" required/>

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
		document.getElementById("queryFirstName").required = true;
        document.getElementById("queryMiddleInitial").required = true;
        document.getElementById("queryLastName").required = true;
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
            $dateOfBirth = quoteOrDefault($_POST["dateOfBirth"]);
			$telephoneNumber = quoteOrDefault($_POST["telephoneNumber"]);
            $address = quoteOrDefault($_POST["address"]);
            $city = quoteOrDefault($_POST["city"]);
			$province = quoteOrDefault($_POST["province"]);
            $postalCode = quoteOrDefault($_POST["postalCode"]);
            $citizenship = quoteOrDefault($_POST["citizenship"]);
			$emailAddress = quoteOrDefault($_POST["emailAddress"]);
            // $infectionDate = quote($_POST["infectionDate"]);
            // $type = quote($_POST["type"]);

			$insertInPerson = "
			INSERT INTO Person (firstName, middleInitial, lastName, dateOfBirth, telephoneNumber, address, city, province, postalCode, citizenship, emailAddress) 
            VALUES($firstName, $middleInitial, $lastName, $dateOfBirth, $telephoneNumber, $address, $city, $province, $postalCode, $citizenship, $emailAddress)";

			if ($conn->query($insertInPerson) === TRUE) {
				echo "<p> Successfully entered a new person!</p>";
			} else {
				echo "<p> Error: " . $insertInPerson . ": <br>" . $conn->error . "</p>";
			}

            // $pID = getPersonId($firstName, $middleInitial, $lastName, $conn);

            // $insertInInfectionHistory = "
            // INSERT INTO InfectionHistory(personID, infectionDate, type)
            // VALUES ($pID, $infectionDate $type)";

			// if (($conn->query($insertInPerson) === TRUE) && $conn->query($insertInInfectionHistory)) {
			// 	echo "<p> Successfully entered a new person and their infection history !</p>";
			// } else {
			// 	echo "<p> Error: " . $insertInPerson . ": <br>" . $conn->error . "</p>";
			// }
		}

		// Querying stuff. / Display
		if ($_POST["query"] != NULL)
		{
			if ($_POST["queryFirstName"] != "" && $_POST["queryMiddleInitial"] != ""  && $_POST["queryLastName"] != "" )
			{
				$firstName = quote($_POST["queryFirstName"]);
				$middleInitial = quote($_POST["queryMiddleInitial"]);
				$lastName = quote($_POST["queryLastName"]);

				$query = "
                SELECT * 
				FROM Person
                WHERE firstName = $firstName AND middleInitial = $middleInitial AND lastName = $lastName";
			}
			else
			{
				$query = "
				SELECT *
				FROM Person P";
			}

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
                            <th> Date of Birth </th>
                            <th> Telephone number </th>
                            <th> Address </th>
                            <th> City </th>
                            <th> Province </th>
                            <th> Postal Code </th>
                            <th> Citizenship </th>
                            <th> Email </th>
						</tr>";

				while($row = mysqli_fetch_assoc($result)) 
				{
					echo "<tr>
							<td> ".$row["firstName"]." </td>
							<td> ".$row["middleInitial"]." </td>
							<td> ".$row["lastName"]." </td>
							<td> ".$row["dateOfBirth"]." </td>	
                            <td> ".$row["telephoneNumber"]." </td>
							<td> ".$row["address"]." </td>
							<td> ".$row["city"]." </td>
							<td> ".$row["province"]." </td>	
                            <td> ".$row["postalCode"]." </td>
							<td> ".$row["citizenship"]." </td>
							<td> ".$row["emailAddress"]." </td>
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
			
			$firstName = quote($_POST["queryFirstName"]);
			$middleInitial = quote($_POST["queryMiddleInitial"]);
			$lastName = quote($_POST["queryLastName"]);

			$pID = getPersonId($firstName, $middleInitial, $lastName, $conn);

			if ($pID == null)
			{
				echo "<p> That person does not exist. </p>";
			}
			else
			{
				$query = "DELETE FROM Person WHERE id = $pID";

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
			$dateOfBirth = quote($_POST["dateOfBirth"]);
			$telephoneNumber = quote($_POST["telephoneNumber"]);
			$address = quote($_POST["address"]);
			$city = quote($_POST["city"]);
			$province = quote($_POST["province"]);
			$postalCode = quote($_POST["postalCode"]);
			$citizenship = quote($_POST["citizenship"]);
			$emailAddress = quote($_POST["emailAddress"]);
			// $infectionDate = quote($_POST["infectionDate"]);
			// $type = quote($_POST["type"]);

			$queryFirstName = quote($_POST["queryFirstName"]);
			$queryMiddleInitial = quote($_POST["queryMiddleInitial"]);
			$queryLastName = quote($_POST["queryLastName"]);

			$pID = getPersonId($queryFirstName, $queryMiddleInitial, $queryLastName, $conn) ;

			if ($pID == null)
			{
				echo "<p> That person does not exist. </p>";
			}
			else
			{
				$updatePerson = "
				UPDATE Person
				SET firstName = $firstName, middleInitial = $middleInitial, lastName = $lastName, dateOfBirth = $dateOfBirth, telephoneNumber = $telephoneNumber, address= $address, city = $city, province = $province, postalCode = $postalCode, citizenship = $citizenship, emailAddress = $emailAddress
				WHERE id = $pID";


			if ($conn->query($updatePerson) === TRUE) {
				echo "<p> Successfully updated the entry!</p>";
			} else {
				echo "<p> Error: " . $updatePerson . ": <br>" . $conn->error . "</p>";
			}
			}
			
		}
		
	}
?>

<p>
	For Infection History go to <a href = "query1-infections.php"> Infection History </a>.
</p>


<?php require("footer.php"); ?>