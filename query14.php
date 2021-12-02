<?php 
	require_once("header.php"); 
	fileHeader("Query 14 - No Nurses");
?>

<div class="instructions">
	<p>
		Display all the facilities that do not have any nurse scheduled to work at the facility on the specified date(test with 2020-04-01). 
	</p>
</div>


<form method = "post" class="form-input">
    <label for = "given_date"> Given Date * </label>
	<input type = "text" id = "given_date" name="given_date" placeholder="0"  min = "0" max = "20" required/> <br/>
	<button type = "submit"> Submit </button>
</form>


<?php

	if ($_POST != null)
	{
        $givenDate = $_POST["given_date"];
		$query = "
        SELECT PHF.name, PHF.address, PHF.phoneNumber, PHF.capacity, FS.openingHour, FS.closingHour
		FROM PublicHealthFacilities PHF
		JOIN FacilitySchedule FS ON FS.name=PHF.name
		WHERE PHF.name NOT IN (
		SELECT PHF.name
			FROM PublicHealthFacilities PHF
			INNER JOIN WorkerSchedule WS ON WS.facilityName=PHF.name
			INNER JOIN HealthWorker HW ON HW.pID=WS.pID
		WHERE POSITION(DAYNAME('$givenDate') IN WS.days)
		AND HW.employeeType='Nurse');
        ";
		$result = $conn->query($query);

		if (mysqli_num_rows($result) > 0) 
		{
			echo "<h2> Facilities that are open and have no nurse scheduled to work:</h2>";
			echo "
				<table>
					<tr>
						<th> Facility Name </th>
						<th> Facility Address </th>
						<th> Facility Phone Number</th>
                        <th> Facility Capacity </th>
						<th> Facility Opening Hour </th>
						<th> Facility Closing Hour </th>
					</tr>";

			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<tr>
						<td> ".$row["name"]." </td>
						<td> ".$row["address"]." </td>
						<td> ".$row["phoneNumber"]." </td>
                        <td> ".$row["capacity"]." </td>
						<td> ".$row["openingHour"]." </td>
						<td> ".$row["closingHour"]." </td>
					</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo "<p> Seems like all facilities on $givenDate are either closed, or have at least one scheduled nurse! </p>";
		}
		
	}



?>


<?php require("footer.php"); ?>