<?php 
	require_once("header.php"); 
	fileHeader("Query 15");
?>

<div class="instructions">
	<p>
		Display the schedule for a given facility and on the specified date(test with facilityName='C' and date='2021-01-25'). 
	</p>
</div>


<form method = "post" class="form-input">
    <label for = "facility_name"> Facility Name * </label>
	<input type = "text" id = "facility_name" name="facility_name" placeholder="0"  min = "0" max = "20" required/> <br/>
    <label for = "given_date"> Given Date * </label>
	<input type = "text" id = "given_date" name="given_date" placeholder="0"  min = "0" max = "20" required/> <br/>
	<button type = "submit"> Submit </button>
</form>


<?php

	if ($_POST != null)
	{
        $givenDate = $_POST["given_date"];
		$facilityName = $_POST["facility_name"];
		
		$query = "
		SELECT PHF.name, P.firstName, P.middleInitial, P.lastName, HW.employeeType, WS.days, WS.startingHour, WS.endingHour
		FROM Person P INNER JOIN HealthWorker HW ON P.id = HW.pID
			INNER JOIN WorkerSchedule WS ON  HW.pID = WS.pID
			INNER JOIN PublicHealthFacilities PHF ON WS.facilityName = PHF.name
		WHERE PHF.name = '$facilityName' AND POSITION(DAYNAME('$givenDate') IN WS.days);
        ";

		$result = $conn->query($query);

		if (mysqli_num_rows($result) > 0)
		{
			echo "<h2> Facilities schedules:</h2>";
			echo "
				<table>
					<tr>
						<th> Facility Name </th>
						<th> Worker First Name </th>
						<th> Worker Middle Name </th>
                        <th> Worker Last Name </th>
						<th> Worker Employment Type </th>
						<th> Worker Working Days </th>
						<th> Worker Starting Hour </th>
						<th> Worker Ender Hour </th>
					</tr>";

			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<tr>
						<td> ".$row["name"]." </td>
						<td> ".$row["firstName"]." </td>
						<td> ".$row["middleInitial"]." </td>
                        <td> ".$row["lastName"]." </td>
						<td> ".$row["employeeType"]." </td>
						<td> ".$row["days"]." </td>
						<td> ".$row["startingHour"]." </td>
						<td> ".$row["endingHour"]." </td>
					</tr>";
			}
			echo "</table>";
		}

		$query = "
		SELECT A.facilityName, A.date, A.time, P.firstName, P.middleInitial, P.lastName
		FROM Appointments A INNER JOIN Person P ON A.pID = P.id
			WHERE A.facilityName = '$facilityName' AND A.date = '$givenDate';
        ";

		$result = $conn->query($query);

		if (mysqli_num_rows($result) > 0)
		{
			echo "<h2> Facilities schedules:</h2>";
			echo "
				<table>
					<tr>
						<th> Facility Name </th>
						<th> Patient First Name </th>
						<th> Patient Middle Name </th>
                        <th> Patient Last Name </th>
						<th> Appointment Date </th>
						<th> Appointment Time </th>
					</tr>";

			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<tr>
						<td> ".$row["facilityName"]." </td>
						<td> ".$row["firstName"]." </td>
						<td> ".$row["middleInitial"]." </td>
                        <td> ".$row["lastName"]." </td>
						<td> ".$row["date"]." </td>
						<td> ".$row["time"]." </td>
					</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo "<p> Seems like there's no appointment for the facility $facilityName on $givenDate! </p>";
		}

	}



?>


<?php require("footer.php"); ?>