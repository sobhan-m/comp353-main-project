<?php 
	require_once("header.php"); 
	fileHeader("Query 20");
?>

<div class="instructions">
	<p>
		Please enter your first name, middle initial, and last name in the fields below.
	</p>
	<p>
		This will provide you with all the information regarding your vaccination appointments, 
		previous vaccinations, and your history of vaccination if they apply.
	</p>
</div>


<form method = "post" class="form-input">
	<label for = "firstName"> First Name * </label>
	<input type = "text" id = "firstName" name="firstName" required/> <br/>
	<label for = "middleInitial"> Middle Initial * </label> 
	<input type = "text" id = "middleInitial" name="middleInitial" required/><br/>
	<label for = "lastName"> Last Name * </label>
	<input type = "text" id = "lastName" name="lastName" required/><br/>
	<button type = "submit"> Submit </button>
</form>

<?php

	if ($_POST != null)
	{
		$query = "SELECT p.dateOfBirth, p.firstName, p.lastName, p.middleInitial
					FROM Person p
					WHERE p.firstName = '" . $_POST['firstName'] . "' AND p.middleInitial = '" . $_POST['middleInitial'] . "' AND p.lastName = '" . $_POST['lastName'] . "'";
		$result = $conn->query($query);

		if (mysqli_num_rows($result) > 0) 
		{
			echo "<hr>";
			echo "<h2> User Information </h2>";
			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<p> <strong> Name: </strong>" . $row['firstName']. " " . $row['middleInitial']. ". " . $row["lastName"] . " </p>";
				echo "<p> <strong>Date Of Birth: </strong>" . $row["dateOfBirth"] . "</p>";
			}
			echo "<hr>";
		}

		$query = "SELECT a.date, a.time, a.facilityName, phf.address
					FROM Appointments a INNER JOIN PublicHealthFacilities phf ON a.facilityName  = phf.name
							INNER JOIN Person p ON a.pID = p.id
					WHERE p.firstName = '" . $_POST['firstName'] . "' AND p.middleInitial = '" . $_POST['middleInitial'] . "' AND p.lastName = '" . $_POST['lastName'] . "'";
		$result = $conn->query($query);

		if (mysqli_num_rows($result) > 0) 
		{
			echo "<h2> Appointment Information </h2>";
			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<p> <strong>Time: </strong>" . $row["date"]. " " . $row["time"]. "</p>";
				echo "<p> <strong>Facility: </strong>" . $row["facilityName"] . "</p>";
				echo "<p> <strong>Address: </strong>" . $row["address"] . "</p>";
			}
			echo "<hr>";
		}

		$query = "SELECT v.vaccinationName, v.vaccinationDate, v.lotNumber, v.facilityName, v.doseNumber
					FROM Vaccinations v INNER JOIN Person p ON v.id = p.id
					WHERE p.firstName = '" . $_POST['firstName'] . "' AND p.middleInitial = '" . $_POST['middleInitial'] . "' AND p.lastName = '" . $_POST['lastName'] . "'";
		$result = $conn->query($query);

		if (mysqli_num_rows($result) > 0) 
		{
			echo "<h2> Vaccination Information </h2>";
			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<h3> Dose " . $row["doseNumber"] . "</h3>";
				echo "<p> <strong>Vaccination: </strong>" . $row["vaccinationName"] . "</p>";
				echo "<p> <strong>Date: </strong>" . $row["vaccinationDate"] . "</p>";
				echo "<p> <strong>Facility: </strong>" . $row["facilityName"] . "</p>";
				echo "<p> <strong>Lot #: </strong>" . $row["lotNumber"] . "</p>";
			}
			echo "<hr>";
		}

		$query = "SELECT ih.infectionDate, ih.type
					FROM InfectionHistory ih INNER JOIN Person p ON ih.personID = p.id
					WHERE p.firstName = '" . $_POST['firstName'] . "' AND p.middleInitial = '" . $_POST['middleInitial'] . "' AND p.lastName = '" . $_POST['lastName'] . "'";
		$result = $conn->query($query);

		if (mysqli_num_rows($result) > 0) 
		{
			echo "<h2> Infection Information </h2>";
			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<p><strong>" . $row["infectionDate"] . "</strong>: Positive Result For ". $row["type"] ." Strain</p>";
			}
			echo "<hr>";
		}
		
	}



?>


<?php require("footer.php"); ?>