<?php 
	require_once("header.php"); 
	fileHeader("Query 18");
?>

<div class="instructions">
	<p>
		To get the details of the nurses, please enter the minimum number of doses you want the nurse to have done.
	</p>
</div>


<form method = "post" class="form-input">
	<label for = "name"> Name * </label>
	<input type = "text" id = "name" name="name" placeholder="General Hospital" required/>
	<label for = "name"> Street Address </label>
	<input type = "text" id = "address" name="address" placeholder="Guy Street" />
	<label for = "name"> City </label>
	<input type = "text" id = "city" name="city" placeholder="Montreal"/>
	<label for = "name"> Province </label>
	<select id = "province" name = "province">
		<option> NL </option>
		<option> PE </option>
		<option> NS </option>
		<option> NB </option>
		<option> QC </option>
		<option> ON </option>
		<option> MB </option>
		<option> SK </option>
		<option> AB </option>
		<option> YT </option>
		<option> NT </option>
		<option> NU </option>
		<option> BC </option>
	</select>
	<label for = "name"> Country </label>
	<input type = "text" id = "country" name="country" placeholder="Canada"/>
	<label for = "name"> Phone Number </label>
	<input type = "text" id = "phoneNumber" name="phoneNumber" placeholder="111111111" pattern="[0-9]+"/>
	<label for = "name"> Web Address </label>
	<input type = "text" id = "webAddress" name="webAddress" placeholder="www.abc.com"/>
	<label for = "name"> Facility Type </label>
	<select id = "facilityType" name = "facilityType">
		<option value = "HOSPITAL"> Hospital </option>
		<option value = "CLINIC"> Clinic </option>
		<option value = "SPECIAL INSTALLMENT"> Special Installment </option>
	</select>
	<label for = "name"> Category </label>
	<select id = "category" name = "category">
		<option value = "RESERVATION-ONLY"> Reservation Only </option>
		<option value = "WALKIN-ALLOWED"> Walk-In Allowed </option>
	</select>
	<label for = "name"> Capacity * </label>
	<input type = "text" id = "capacity" name="capacity" placeholder="10" pattern="[0-9]+" required/>
	<label for = "name"> Manager ID </label>
	<input type = "text" id = "managerID" name="managerID" placeholder="9"/>
	<button type = "submit" name = "insert" value = "insert"> Insert Value </button>


	<label for = "name"> Name * </label>
	<input type = "text" id = "name" name="name" placeholder="General Hospital" required/>
	<button type = "submit" name = "query" value = "query"> Query Table </button>
	<button type = "submit" name = "delete" value = "delete"> Delete Value </button>
	<button type = "submit" name = "update" value = "update"> Update Value </button>
</form>

<?php

	if ($_POST != null)
	{
		if ($_POST["insert"] != NULL)
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
			$insert = "
			INSERT INTO PublicHealthFacilities (name, address, province, country, phoneNumber, webAddress, facilityType, category, capacity, managerID)
			VALUES ($name, $address, $province, $country, $phoneNumber, $webAddress, $facilityType, $category, $capacity, $managerID);";

			if ($conn->query($insert) === TRUE) {
				echo "<p> Successfully entered the result!</p>";
			} else {
				echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
			}
		}

		if ($_POST["query"] != NULL)
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
			$insert = "
			INSERT INTO PublicHealthFacilities (name, address, province, country, phoneNumber, webAddress, facilityType, category, capacity, managerID)
			VALUES ($name, $address, $province, $country, $phoneNumber, $webAddress, $facilityType, $category, $capacity, $managerID);";

			if ($conn->query($insert) === TRUE) {
				echo "<p> Successfully entered the result!</p>";
			} else {
				echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
			}
		}

		if ($_POST["delete"] != NULL)
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
			$insert = "
			INSERT INTO PublicHealthFacilities (name, address, province, country, phoneNumber, webAddress, facilityType, category, capacity, managerID)
			VALUES ($name, $address, $province, $country, $phoneNumber, $webAddress, $facilityType, $category, $capacity, $managerID);";

			if ($conn->query($insert) === TRUE) {
				echo "<p> Successfully entered the result!</p>";
			} else {
				echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
			}
		}

		if ($_POST["update"] != NULL)
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
			$insert = "
			INSERT INTO PublicHealthFacilities (name, address, province, country, phoneNumber, webAddress, facilityType, category, capacity, managerID)
			VALUES ($name, $address, $province, $country, $phoneNumber, $webAddress, $facilityType, $category, $capacity, $managerID);";

			if ($conn->query($insert) === TRUE) {
				echo "<p> Successfully entered the result!</p>";
			} else {
				echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
			}
		}
		
	}
?>


<?php require("footer.php"); ?>