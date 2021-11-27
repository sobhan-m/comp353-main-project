<?php 
	require_once("header.php"); 
	fileHeader("Query 11");
?>

<div class="instructions">
	<p>
		Display the first available spot for vaccination in a given facility starting from a given date (2022-12-25).
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
		$facilityName = $_POST["facility_name"];
        $givenDate = $_POST["given_date"];
		$query = "
        SELECT A.workerID, P.firstName, P.lastName, P.emailAddress, A.hourlyWage
        FROM Person P INNER JOIN Assignments A ON P.id = A.pID
            INNER JOIN HealthWorker HW ON HW.pID = A.pID
            INNER JOIN WorkerSchedule WS ON WS.pID = HW.pID
        WHERE HW.employeeType = 'Nurse' 
        AND YEAR(A.startDate) = '$givenDate'
        AND A.facilityName = '$facilityName'
        ORDER BY hourlyWage";

		$result = $conn->query($query);

		if (mysqli_num_rows($result) > 0) 
		{
			echo "<h2> The first availability for an appointment is:</h2>";
			echo "
				<table>
					<tr>
						<th> WorkerID </th>
						<th> First Name </th>
						<th> Last Name</th>
                        <th> Email Address </th>
						<th> Hourly Wage</th>
					</tr>";

			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<tr>
						<td> ".$row["workerID"]." </td>
						<td> ".$row["firstName"]." </td>
						<td> ".$row["lastName"]." </td>
                        <td> ".$row["emailAddress"]." </td>
						<td> ".$row["hourlyWage"]." </td>
					</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo "<p> Seems like all Nurses at $facilityName on $givenDate are actually assigned ! </p>";
		}
		
	}



?>


<?php require("footer.php"); ?>