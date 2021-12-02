<?php 
	require_once("header.php"); 
	fileHeader("Query 11");
?>

<div class="instructions">
	<p>
		Please enter the facility name, the starting date, and the ending date.
	</p>
</div>


<form method = "post" class="form-input">
	<label for = "facilityName"> Facility Name * </label>
	<input type = "text" id = "facilityName" name="facilityName" placeholder="A" required/>

	<label for = "startDate"> Start Date * </label>
	<input type = "date" id = "startDate" name="startDate" required/>

	<label for = "endDate"> End Date * </label>
	<input type = "date" id = "endDate" name="endDate" required/>

	<button type = "submit"> Submit </button>
</form>

<?php

	if ($_POST != null)
	{
		$facilityName = quote($_POST["facilityName"]);
		$startDate = quote($_POST["startDate"]);
		$endDate = quote($_POST["endDate"]);

		$query = "SELECT *
			FROM Appointments A
				INNER JOIN Person p ON A.pID = p.id
			WHERE A.date BETWEEN $startDate AND $endDate AND A.facilityName = $facilityName
			AND pID IS NOT NULL;";

		$result = $conn->query($query);

		if (mysqli_num_rows($result) > 0) 
		{
			echo "<h2> Booked Slots </h2>";
			echo "
				<table>
					<tr>
						<th> First Name </th>
						<th> Middle Initial </th>
						<th> Last Name </th>
						<th> Facility Name </th>
						<th> Date </th>
						<th> Time </th>
					</tr>";

			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<tr>
						<td> ".$row["firstName"]." </td>
						<td> ".$row["middleInitial"]." </td>
						<td> ".$row["lastName"]." </td>
						<td> ".$row["facilityName"]." </td>
						<td> ".$row["date"]." </td>
						<td> ".$row["time"]." </td>
					</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo "<p> There are no booked slots! </p>";
		}

		$query = "SELECT *
			FROM Appointments A
			WHERE A.date BETWEEN $startDate AND $endDate AND A.facilityName = $facilityName
			AND pID IS NULL;";

		$result = $conn->query($query);

		if (mysqli_num_rows($result) > 0) 
		{
			echo "<h2> Available Slots </h2>";
			echo "
				<table>
					<tr>
						<th> Facility Name </th>
						<th> Date </th>
						<th> Time </th>
					</tr>";

			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<tr>
						<td> ".$row["facilityName"]." </td>
						<td> ".$row["date"]." </td>
						<td> ".$row["time"]." </td>
					</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo "<p> There are no available slots! </p>";
		}
		
	}



?>


<?php require("footer.php"); ?>