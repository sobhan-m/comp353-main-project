<?php 
	require_once("header.php"); 
	fileHeader("Query 19");
?>

<div class="instructions">
	<p>
		Please enter a city name to get a report of its healthcare facilities.
	</p>
</div>


<form method = "post" class="form-input">
	<label for = "city"> City * </label>
	<input type = "text" id = "city" name="city" required/> <br/>
	<button type = "submit"> Submit </button>
</form>

<?php

	if ($_POST != null)
	{
		$city = $_POST["city"];
		$query = "
			SELECT phf.name, phf.address, phf.facilityType, phf.phoneNumber, phf.capacity, workerQuery.workerCount, doseQuery.doseCount, futureDoseQuery.futureDoseCount
			FROM PublicHealthFacilities phf 
				LEFT JOIN (SELECT facilityName, COUNT(DISTINCT workerID) workerCount
							FROM Assignments
							GROUP BY facilityName) workerQuery ON phf.name = workerQuery.facilityName
				LEFT JOIN (SELECT facilityName, COUNT(*) doseCount
							FROM Vaccinations
							GROUP BY facilityName) doseQuery ON phf.name = doseQuery.facilityName
				LEFT JOIN (SELECT facilityName, COUNT(*) futureDoseCount
							FROM Appointments
							WHERE pID IS NOT NULL
							GROUP BY facilityName) futureDoseQuery ON phf.name = futureDoseQuery.facilityName
			WHERE phf.city = '$city'
			ORDER BY doseQuery.doseCount ASC";
		$result = $conn->query($query);

		if (mysqli_num_rows($result) > 0) 
		{
			echo "<h2> $city's Healthcare Facilities </h2>";
			echo "
				<table>
					<tr>
						<th> Facility Name </th>
						<th> Address </th>
						<th> Facility Type </th>
						<th> PhoneNumber </th>
						<th> Capacity </th>
						<th> Number Of Workers </th>
						<th> Number Of Doses </th>
						<th> Number Of Appointments </th>
					</tr>";

			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<tr>
						<td> ".$row["name"]." </td>
						<td> ".$row["address"]." </td>
						<td> ".$row["facilityType"]." </td>
						<td> ".$row["phoneNumber"]." </td>
						<td> ".$row["capacity"]." </td>
						<td> ".($row["workerCount"] == null ? 0 : $row["workerCount"])." </td>
						<td> ".($row["doseCount"] == null ? 0 : $row["doseCount"])." </td>
						<td> ".($row["futureDoseCount"] == null ? 0 : $row["futureDoseCount"])." </td>
					</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo "<p>".$city." has no healthcare facilities! </p>";
		}
		
	}



?>


<?php require("footer.php"); ?>