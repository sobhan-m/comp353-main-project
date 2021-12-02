<?php
require_once("header.php");
fileHeader("Query 16 - Perform Appointment Vaccine");
?>
<div class="row button-prompts">
    <button type="button" onclick="DisplayRegistered();"> Registered </button>
    <button type="button" onclick="DisplayUnregistered();"> Unregistered </button>
</div>

<h2 class = "registered"> Registered </h2>

<h2 class = "unregistered"> Unregistered </h2>

<form method="POST" class="form-input">

	<label for = "identification" class = "registered"> Medicare Card Number </label>
	<label for = "identification" class = "unregistered"> Passport Number </label>
    <input type="text" id = "identification" name="identification" placeholder="Identification number" class="registered unregistered">

	<label for = "fName"> First Name </label>
    <input type="text" id = "fName" name="fName" placeholder="First Name">

	<label for = "mInitial"> Middle Initial </label>
    <input type="text" id = "mInitial" name="mInitial" placeholder="Middle Initial">

	<label for = "lName"> Last Name </label>
    <input type="text" id = "lName" name="lName" placeholder="Last Name">

    <!-- <input type="text" name="id" placeholder="ID" class="registered unregistered"> -->

	<label for = "nurseID"> Nurse ID </label>
    <input type="text" id = "nurseID" name="nurseID" placeholder="Nurse ID">

	<!-- Turn this into a select -->
	<label for = "vaccineName"> Vaccination Name </label>
    <input type="text" id = "vaccineName" name="vaccineName" placeholder="Vaccine Name">

	<label for = "lotNumber"> Lot Number </label>
    <input type="text" id = "lotNumber" name="lotNumber" placeholder="Lot Number">

	<!-- Change to select -->
	<label for = "province"> Province </label>
    <input type="text" id = "province" name="province" placeholder="Province"">

	<label for = "facility"> Facility </label>
    <input type="text" id = "facility" name="facility" placeholder="Facility"">

	<label for = "country"> Country Of Vaccination </label>
    <input type="text" id="country" name="country" placeholder="Country">

	<label for = "dateOfVaccination"> Date Of Vaccination </label>
    <input type="date" id="dateOfVaccination" name="dateOfVaccination">

	<label for = "dateOfBirth" class = "unregistered"> Date Of Birth </label>
    <input type="date" id="dateOfBirth" name="dateOfBirth" class="unregistered">

	<label for = "telephoneNumber" class = "unregistered"> Telephone Number </label>
    <input type="text" id="telephoneNumber" name="telephoneNumber" placeholder="Telephone Number" class="unregistered">

	<label for = "address" class = "unregistered"> Address </label>
    <input type="text" id="address" name="address" placeholder="Address" class="unregistered">

	<label for = "city" class = "unregistered"> City </label>
    <input type="text" id="city" name="city" placeholder="City" class="unregistered">

	<label for = "postalCode" class = "unregistered"> Postal Code </label>
    <input type="text" id="postalCode" name="postalCode" placeholder="Postal Code" class="unregistered">

	<label for = "citizenship" class = "unregistered"> Citizenship </label>
    <input type="text" id="citizenship" name="citizenship" placeholder="Citizenship" class="unregistered">

	<label for = "citizenship" class = "unregistered"> Email Address </label>
    <input type="email" id="email" name="email" placeholder="E-mail" class="unregistered">

    <button type="submit" name="submit" value="registered" class="registered"> Submit </button>

    <button type="submit" name="submit" value="unregistered" class="unregistered"> Submit </button>
</form>
<br>

<script type="text/javascript">
    var registered = document.getElementsByClassName("registered");
    var unregistered = document.getElementsByClassName("unregistered");

	function RequireVisibleInput()
	{
		// Requiring everything visible
		let inputs = document.getElementsByTagName("input");
		for (let i = 0; i < inputs.length; ++i)
		{
			if (inputs[i].style.display != "none")
			{
				inputs[i].required = true;
			}
			else
			{
				inputs[i].required = false;
			}
		}
	}

    function HideAll(input) {
        for (let i = 0; i < input.length; ++i) {
            if (input[i].required == true)
                input[i].required = false;
            input[i].style.display = "none";
        }
    }

    function DisplayAll(input) {
        for (let i = 0; i < input.length; ++i) {
            input[i].style.display = "block";
        }

        buttons = document.getElementsByTagName("button");
        for (let i = 0; i < buttons.length; ++i) {
            if (buttons[i].style.display == "none") {
                buttons[i].disabled = true;
            } else {
                buttons[i].disabled = false;
            }
        }
    }

    function DisplayRegistered() {
        HideAll(unregistered);
        DisplayAll(registered);
    }

    function DisplayUnregistered() {
        HideAll(registered);
        DisplayAll(unregistered);
		RequireVisibleInput();
    }

    HideAll(registered);
    HideAll(unregistered);
</script>

<?php
if ($_POST != null && $_POST["submit"] != null && $_POST["submit"] == "registered") 
{
    $identification = quote($_POST["identification"]);
    $fName = quote($_POST["fName"]);
    $mInitial = quote($_POST["mInitial"]);
    $lName = quote($_POST["lName"]);
    $id = getPersonId($fName, $mInitial, $lName, $conn);
    $nurseID = quote($_POST["nurseID"]);
    $vaccineName = quote($_POST["vaccineName"]);
    $lotNumber = $_POST["lotNumber"];
    $province = quote($_POST["province"]);
    $country = quote($_POST["country"]);
	$dateOfVaccination = quote($_POST["dateOfVaccination"]);
	$facility = quote($_POST["facility"]);
   
	if ($id == null)
	{
		echo "<p> The person you have entered does not exit. Try another name! </p>";
	}
	else
	{
		// Checking if the person is registered.
		$query = "
		SELECT * FROM Registered 
		WHERE medicareCardNum = $identification AND id = $id";
		$registeredPersonResult = $conn->query($query);

		if (mysqli_num_rows($registeredPersonResult) <= 0)
		{
			echo "<p> The person you have entered is not registered. Make sure the name and Medicare number are correct and match. </p>";
		}
		else
		{
			$appointmentCheck = "
			SELECT *
			FROM Appointments
			WHERE pID = $id AND date = $dateOfVaccination AND facilityName = $facility;";

			$appointmentResult = $conn->query($appointmentCheck);

			if (mysqli_num_rows($appointmentResult) <= 0)
			{
				echo "<p> The person you have entered does not have an appointment today. </p>";
			}
			else
			{
				$doseCheck = "
				SELECT id, MAX(doseNumber) lastDose
				FROM Vaccinations
				WHERE id = $id;";
				$doseResult = $conn -> query($doseCheck);
				
				$newDoseNumber = 1;

				// If the person has been vaccinated before.
				if (mysqli_num_rows($registeredPersonResult) > 0)
				{
					$newDoseNumber = mysqli_fetch_assoc($doseResult)["lastDose"] + 1;
				}

				// Insertion time.
				$insertion = "
				INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber)
				VALUES($id, $nurseID, $vaccineName, $dateOfVaccination, $lotNumber, $facility, $province, $country, $newDoseNumber);";

				if ($conn->query($insertion) === TRUE) {
					echo "<p> Successfully inserted the entry!</p>";
				} else {
					echo "<p> Error: " . $insertion . ": <br>" . $conn->error . "</p>";
				}
			}
		}
	}  
}

if ($_POST != null && $_POST["submit"] != null && $_POST["submit"] == "unregistered") 
{
	// Things to confirm.
    $identification = quote($_POST["identification"]);
	$dateOfBirth = quote($_POST["dateOfBirth"]);
	$telephoneNumber = quote($_POST["telephoneNumber"]);
	$address = quote($_POST["address"]);
	$city = quote($_POST["city"]);
	$postalCode = quote($_POST["postalCode"]);
	$citizenship = quote($_POST["citizenship"]);
	$emailAddress = quote($_POST["email"]);

    $fName = quote($_POST["fName"]);
    $mInitial = quote($_POST["mInitial"]);
    $lName = quote($_POST["lName"]);
    $id = getPersonId($fName, $mInitial, $lName, $conn);
    $nurseID = quote($_POST["nurseID"]);
    $vaccineName = quote($_POST["vaccineName"]);
    $lotNumber = $_POST["lotNumber"];
    $province = quote($_POST["province"]);
	$facility = quote($_POST["facility"]);
    $country = quote($_POST["country"]);
	$dateOfVaccination = quote($_POST["dateOfVaccination"]);
   
	if ($id == null)
	{
		echo "<p> The person you have entered does not exit. Try another name! </p>";
	}
	else
	{
		// Checking if the person is unregistered.
		$query = "
		SELECT * 
		FROM Unregistered U 
			INNER JOIN Person P ON U.id = P.id
		WHERE passportNum = $identification 
		AND U.id = $id
		AND dateOfBirth = $dateOfBirth
		AND telephoneNumber = $telephoneNumber
		AND address = $address
		AND city = $city
		AND postalCode = $postalCode
		AND citizenship = $citizenship
		AND emailAddress = $emailAddress";
		$unregisteredPersonResult = $conn->query($query);

		if (mysqli_num_rows($unregisteredPersonResult) <= 0)
		{
			echo "<p> The person you have entered is not unregistered. Make sure the details are correct and match. </p>";
		}
		else
		{
			$appointmentCheck = "
			SELECT *
			FROM Appointments
			WHERE pID = $id AND date = $dateOfVaccination AND facilityName = $facility;";

			$appointmentResult = $conn->query($appointmentCheck);

			if (mysqli_num_rows($appointmentResult) <= 0)
			{
				echo "<p> The person you have entered does not have an appointment today. </p>";
			}
			else
			{
				$doseCheck = "
				SELECT id, MAX(doseNumber) lastDose
				FROM Vaccinations
				WHERE id = $id;";
				$doseResult = $conn -> query($doseCheck);
				
				$newDoseNumber = 1;

				// If the person has been vaccinated before.
				if (mysqli_num_rows($registeredPersonResult) > 0)
				{
					$newDoseNumber = mysqli_fetch_assoc($doseResult)["lastDose"] + 1;
				}

				// Insertion time.
				$insertion = "
				INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber)
				VALUES($id, $nurseID, $vaccineName, $dateOfVaccination, $lotNumber, $facility, $province, $country, $newDoseNumber);";

				if ($conn->query($insertion) === TRUE) {
					echo "<p> Successfully inserted the entry!</p>";
				} else {
					echo "<p> Error: " . $insertion . ": <br>" . $conn->error . "</p>";
				}
			}
		}
	}  
}
?>

<?php require("footer.php"); ?>