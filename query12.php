<?php 
	require_once("header.php"); 
	fileHeader("Query 12 - First Available Booking Slot");
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
        SELECT A.date, A.time, A.facilityName
        FROM Appointments A
        WHERE A.pID IS NULL
        AND A.facilityName = '$facilityName'
        AND A.date = '$givenDate' 
        ORDER BY A.time
        LIMIT 1";

		$result = $conn->query($query);

		if (mysqli_num_rows($result) > 0) 
		{
			echo "<h2> The first availability for an appointment is:</h2>";
			echo "
				<table>
					<tr>
						<th> Facility Name </th>
						<th> Time </th>
						<th> Date</th>
					</tr>";

			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<tr>
						<td> ".$row["facilityName"]." </td>
						<td> ".$row["time"]." </td>
						<td> ".$row["date"]." </td>
					</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo "<p> There are no availabilities at $facilityName on $givenDate ! </p>";
		}
		
	}



?>


<?php require("footer.php"); ?>