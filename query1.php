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
	<input type = "text" id = "firstName" name="firstName" placeholder="First Name" class = "update query delete insert" required/>

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

    <label for = "infectionDate" class = "update insert"> Infection Date </label>
	<input type = "date" id = "infectionDate" name="infectionDate" class = "update insert"/>

    <label for = "type" class = "update insert"> Infection Type </label>
	<input type = "text" id = "type" name="type" placeholder="Alpha" class = "update insert" />

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
	}

	function DisplayDeletes()
	{
		HideAll(queries);
		HideAll(updates);
		HideAll(inserts);
		DisplayAll(deletes);
        document.getElementById("firstName").required = true;
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
            $dateOfBirth = quote($_POST["dateOfBirth"]);
			$telephoneNumber = quote($_POST["telephoneNumber"]);
            $address = quote($_POST["address"]);
            $city = quote($_POST["city"]);
			$province = quote($_POST["province"]);
            $postalCode = quote($_POST["postalCode"]);
            $citizenship = quote($_POST["citizenship"]);
			$emailAddress = quote($_POST["emailAddress"]);
            $infectionDate = quote($_POST["infectionDate"]);
            $type = quote($_POST["type"]);

			$insertInPerson = "
			INSERT INTO Person (firstName, middleInitial, lastName, dateOfBirth, telephoneNumber, address, city, province, postalCode, citizenship, emailAddress) 
            VALUES($firstName, $middleInitial, $lastName, $dateOfBirth, $telephoneNumber, $address, $city, $province, $postalCode, $citizenship, $emailAddress)";


            $pID = getPersonId($firstName, $conn);

            echo $pID;

            $insertInInfectionHistory = "
            INSERT INTO InfectionHistory(personID, infectionDate, type)
            VALUES ($pID, $infectionDate $type)";

			if (($conn->query($insertInPerson) === TRUE) && $conn->query($insertInInfectionHistory)) {
				echo "<p> Successfully entered a new person and their infection history !</p>";
			} else {
				echo "<p> Error: " . $insertInPerson . ": <br>" . $conn->error . "</p>";
			}
		}

		// Querying stuff. / Display
		if ($_POST["query"] != NULL)
		{
			if ($_POST["firstName"] != "")
			{
				$name = quote($_POST["firstName"]);
				$query = "
                SELECT * FROM Person P
                INNER JOIN InfectionHistory IH ON IH.personID = P.id
                WHERE firstName = $name";
			}
			else
			{
				$query = "
				SELECT *
				FROM Person P 
                INNER JOIN InfectionHistory IH ON IH.personID = P.id";
			}

			$result = $conn->query($query);

			if (mysqli_num_rows($result) > 0) 
			{
				echo "<h2> Person INNER JOIN Infection History</h2>";
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
							<th> Infection Date </th>
							<th> Infection Type </th>
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

        // Deleting stuff.
		if ($_POST["delete"] != NULL)
		{
			if ($_POST["firstName"] != null)
			{
				$name = quote($_POST["firstName"]);

                echo $name;
				$deleteFromPerson = "
				DELETE FROM Person
                WHERE firstName = $name";

                $pID = getPersonId($name, $conn);
                echo $pID;

                $deleteFromInfectionHistory = "
                DELETE FROM InfectionHistory
                WHERE $pID";

				if ($conn->query($query) === TRUE) {
					echo "<p> Successfully deleted the entry!</p>";
				} else {
					echo "<p> Error: " . $deleteFromPerson . ": <br>" . $conn->error . "</p>";
				}
			}
			else
			{
				echo "<p> Please fill the 'firstName' input with the person you're looking up. </p>";
			}
			
		}

		// Updating stuff.
		if ($_POST["update"] != NULL)
		{
			if ($_POST["firstName"] != null)
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
                $infectionDate = quote($_POST["infectionDate"]);
                $type = quote($_POST["type"]);

				$name = quote($_POST["firstName"]);
				$updatePerson = "
                UPDATE Person
				SET firstName = $firstName, middleInitial = $middleInitial, lastName = $lastName, dateOfBirth = $dateOfBirth, telephoneNumber = $telephoneNumber, address= $address, city = $city, province = $province, postalCode = $postalCode, citizenship = $citizenship, emailAddress = $emailAddress
                WHERE firstName = $firstName";

                $pID = getPersonId($firstName, $conn) ;

                $updateInfectionHistory = "
                UPDATE InfectionHistory
                SET infectionDate = $infectionDate, type = $type
                WHERE personID = $pID";

				if ($conn->query($updatePerson) === TRUE) {
					echo "<p> Successfully updated the entry!</p>";
				} else {
					echo "<p> Error: " . $updatePerson . ": <br>" . $conn->error . "</p>";
				}
			}
			else
			{
				echo "<p> Please fill the stuff in input if you want to update. </p>";
			}
			
		}
		
	}
?>


<?php require("footer.php"); ?>