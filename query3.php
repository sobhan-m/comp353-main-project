<?php 
	require_once("header.php"); 
	fileHeader("Query 3");
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

	<label for = "name" class = "update insert"> Name * </label>
	<input type = "text" id = "name" name="name" placeholder="General Hospital" class = "update insert"/>

	<label for = "name" class = "update insert"> Street Address </label>
	<input type = "text" id = "address" name="address" placeholder="Guy Street" class = "update insert"/>

	<label for = "name" class = "update insert"> City </label>
	<input type = "text" id = "city" name="city" placeholder="Montreal" class = "update insert"/>

	<label for = "name" class = "update insert"> Province </label>
	<select id = "province" name = "province" class = "update insert">
		<?php printProvinceOptions($conn); ?>
	</select>

	<label for = "name" class = "update insert"> Country </label>
	<input type = "text" id = "country" name="country" placeholder="Canada" class = "update insert"/>

	<label for = "name" class = "update insert"> Phone Number </label>
	<input type = "text" id = "phoneNumber" name="phoneNumber" placeholder="111111111" pattern="[0-9]+" class = "update insert"/>

	<label for = "name" class = "update insert"> Web Address </label>
	<input type = "text" id = "webAddress" name="webAddress" placeholder="www.abc.com" class = "update insert"/>

	<label for = "name" class = "update insert"> Facility Type </label>
	<select id = "facilityType" name = "facilityType" class = "update insert">
		<option value = "HOSPITAL"> Hospital </option>
		<option value = "CLINIC"> Clinic </option>
		<option value = "SPECIAL INSTALLMENT"> Special Installment </option>
	</select>

	<label for = "name" class = "update insert"> Category </label>
	<select id = "category" name = "category" class = "update insert">
		<option value = "RESERVATION-ONLY"> Reservation Only </option>
		<option value = "WALKIN-ALLOWED"> Walk-In Allowed </option>
	</select>

	<label for = "name" class = "update insert"> Capacity * </label>
	<input type = "text" id = "capacity" name="capacity" placeholder="10" pattern="[0-9]+" class = "update insert"/>

	<label for = "name" class = "update insert"> Manager ID </label>
	<input type = "text" id = "managerID" name="managerID" placeholder="9" class = "update insert"/>

	<button type = "submit" name = "insert" value = "insert" class = "insert"> Insert Value </button>

	<label for = "queryName" class = "query delete update"> Query Name </label>
	<input type = "text" id = "queryName" name="queryName" placeholder="General Hospital" class = "query delete update"/>

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
		document.getElementById("name").required = true;
		document.getElementById("capacity").required = true;
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
		document.getElementById("name").required = true;
		document.getElementById("capacity").required = true;
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
			$name = "'".$_POST["name"]."'";
			$address = $_POST["address"] == "" ? "DEFAULT" : "'".$_POST["address"]."'";
			$city = $_POST["city"] == "" ? "DEFAULT" : "'".$_POST["city"]."'";
			$province = "'".$_POST["province"]."'";
			$country = $_POST["country"] == "" ? "DEFAULT" : "'".$_POST["country"]."'";
			$phoneNumber = $_POST["phoneNumber"] == "" ? "DEFAULT" : "'".$_POST["phoneNumber"]."'";
			$webAddress = $_POST["webAddress"] == "" ? "DEFAULT" : "'".$_POST["webAddress"]."'";
			$facilityType = "'".$_POST["facilityType"]."'";
			$category = $_POST["category"] == "" ? "DEFAULT" : "'".$_POST["category"]."'";
			$capacity = $_POST["capacity"] == "" ? 0 : $_POST["capacity"];
			$managerID = $_POST["managerID"] == "" ? "DEFAULT" : "'".$_POST["managerID"]."'";
			$insert = "
			INSERT INTO PublicHealthFacilities (name, address, city, province, country, phoneNumber, webAddress, facilityType, category, capacity, managerID)
			VALUES ($name, $address, $city, $province, $country, $phoneNumber, $webAddress, $facilityType, $category, $capacity, $managerID);";

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
				$name = "'".$_POST["queryName"]."'";
				$query = "
				SELECT *
				FROM PublicHealthFacilities
				WHERE name = $name";
			}
			else
			{
				$query = "
				SELECT *
				FROM PublicHealthFacilities";
			}

			$result = $conn->query($query);

			if (mysqli_num_rows($result) > 0) 
			{
				echo "<h2> Healthcare Facilities </h2>";
				echo "
					<table>
						<tr>
							<th> Facility Name </th>
							<th> Address </th>
							<th> City </th>
							<th> Province </th>
							<th> Country </th>
							<th> Phone Number </th>
							<th> Web Address </th>
							<th> Facility Type </th>
							<th> Category </th>
							<th> Capacity </th>
							<th> Manager ID </th>
						</tr>";

				while($row = mysqli_fetch_assoc($result)) 
				{
					echo "<tr>
							<td> ".$row["name"]." </td>
							<td> ".$row["address"]." </td>
							<td> ".$row["city"]." </td>
							<td> ".$row["province"]." </td>
							<td> ".$row["country"]." </td>
							<td> ".$row["phoneNumber"]." </td>
							<td> ".$row["webAddress"]." </td>
							<td> ".$row["facilityType"]." </td>
							<td> ".$row["category"]." </td>
							<td> ".$row["capacity"]." </td>			
							<td> ".$row["managerID"]." </td>					
						</tr>";
				}
				echo "</table>";
			}
			else
			{
				echo "<p>".$city." has no healthcare facilities! </p>";
			}
				
		}

		if ($_POST["delete"] != NULL)
		{
			if ($_POST["queryName"] != null)
			{
				$name = "'".$_POST["queryName"]."'";
				$query = "
				DELETE FROM PublicHealthFacilities
				WHERE name = $name";

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
				$name = "'".$_POST["name"]."'";
				$address = $_POST["address"] == "" ? "DEFAULT" : "'".$_POST["address"]."'";
				$province = "'".$_POST["province"]."'";
				$country = $_POST["country"] == "" ? "DEFAULT" : "'".$_POST["country"]."'";
				$phoneNumber = $_POST["phoneNumber"] == "" ? "DEFAULT" : "'".$_POST["phoneNumber"]."'";
				$webAddress = $_POST["webAddress"] == "" ? "DEFAULT" : "'".$_POST["webAddress"]."'";
				$facilityType = "'".$_POST["facilityType"]."'";
				$category = $_POST["category"] == "" ? "DEFAULT" : "'".$_POST["category"]."'";
				$capacity = $_POST["capacity"];
				$managerID = $_POST["managerID"] == "" ? "DEFAULT" : "'".$_POST["managerID"]."'";

				$queryName = "'".$_POST["queryName"]."'";
				$insert = "
				UPDATE PublicHealthFacilities
				SET name = $name, address = $address, province = $province, country = $country,
					phoneNumber = $phoneNumber, webAddress = $webAddress, facilityType = $facilityType, 
					category = $category, capacity = $capacity, managerID = $managerID
				WHERE name = $queryName";

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