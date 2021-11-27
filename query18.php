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
	<label for = "dose-count"> Dose Count * </label>
	<input type = "text" id = "dose-count" name="dose-count" placeholder="0"  min = "0" max = "20" required/> <br/>
	<button type = "submit"> Submit </button>
</form>

<?php

	if ($_POST != null)
	{
		$doseCount = $_POST["dose-count"];
		$query = "
		SELECT p.firstName, p.middleInitial, p.lastName, p.telephoneNumber, countQuery.vaccinationCount
		FROM HealthWorker hw INNER JOIN Person p ON hw.pID = p.id
			INNER JOIN Assignments a ON hw.pID = a.pID
			INNER JOIN (SELECT workerID, facilityName, COUNT(*) vaccinationCount
						FROM Vaccinations
						GROUP BY workerID, facilityName) countQuery ON a.workerID = countQuery.workerID AND a.facilityName = countQuery.facilityName
		WHERE hw.employeeType = 'Nurse' AND vaccinationCount >= $doseCount
		ORDER BY vaccinationCount DESC;";
		$result = $conn->query($query);

		if (mysqli_num_rows($result) > 0) 
		{
			echo "<h2> Nurses With At Least $doseCount Doses </h2>";
			echo "
				<table>
					<tr>
						<th> First Name </th>
						<th> Middle Initial </th>
						<th> Last Name</th>
						<th> PhoneNumber </th>
						<th> Vaccination Count </th>
					</tr>";

			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<tr>
						<td> ".$row["firstName"]." </td>
						<td> ".$row["middleInitial"]." </td>
						<td> ".$row["lastName"]." </td>
						<td> ".$row["telephoneNumber"]." </td>
						<td> ".$row["vaccinationCount"]." </td>
					</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo "<p> There are no nurses with atleast $doseCount doseCount! </p>";
		}
		
	}



?>


<?php require("footer.php"); ?>