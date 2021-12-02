<?php 
	require_once("header.php"); 
	fileHeader("Appointment Creator");
?>

<div class="instructions">
	<p>
		Please enter a facility name and a date to fill it with slots for the entire day.
	</p>
</div>


<form method = "post" class="form-input">
	<label for = "facilityName"> Facility Name * </label>
	<input type = "text" id = "facilityName" name="facilityName" placeholder="A" required/>

	<label for = "date"> Date * </label>
	<input type = "date" id = "date" name="date" required/>

	<button type = "submit"> Submit </button>
</form>

<?php

	if ($_POST != null)
	{
		$facilityName = quote($_POST["facilityName"]);
		$date = quote($_POST["date"]);

		$result = $conn->query("SELECT * FROM FacilitySchedule WHERE name = $facilityName AND POSITION(DAYNAME($date) IN days);");

		if (mysqli_num_rows($result) > 0)
		{
			$row = mysqli_fetch_assoc($result);

			$openingTime = timeToNumbers("".$row["openingHour"]."");
			$closingTime = timeToNumbers("".$row["closingHour"]."");

			// Programmatically fills the day's appointment slots.
			for ($hour = (int)$openingTime[0]; $hour < (int)$closingTime[0]; ++$hour)
			{
				for($minutes = 0; $minutes < 60; $minutes += 20)
				{
					if ($hour == $openingTime[0] && $minutes < $openingTime[1])
						continue;
					$time = quote(numbersToHours($hour, $minutes));
					$conn->query("INSERT INTO Appointments (date, time, facilityName) VALUES ($date, $time, $facilityName);");
				}
			}
		}
		else
		{
			echo "The facility you mentioned does not have a usable schedule at the specified time.";
		}
		
	}



?>


<?php require("footer.php"); ?>