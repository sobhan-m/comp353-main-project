<?php 
	require_once("header.php"); 
	fileHeader("Query 10");
?>

<form method = "post" class="form-input">
    <label for = "pID"> Worker ID * </label> 
	<input type = "text" id = "pID" name="pID" placeholder="2"  min = "0" max = "20" /> <br/>
    <label for = "facility_name"> Facility Name * </label> 
	<input type = "text" id = "facility_name" name="facility_name" placeholder="B"  min = "0" max = "20" /> <br/>
    <label for = "start_date"> Start Date * </label>
	<input type = "text" id = "start_date" name="start_date" placeholder="2020-1-1"  min = "0" max = "20" /> <br/>
    <label for = "end_date"> End Date </label>
	<input type = "text" id = "end_date" name="end_date" placeholder="2020-6-1"  min = "0" max = "20" /> <br/>
    <label for = "hourly_wage"> Hourly Wage </label>
	<input type = "text" id = "hourly_wage" name="hourly_wage" placeholder="12"  min = "0" max = "20" /> <br/>

	<button type = "submit" name = "insert" value = "insert"> Insert Value </button>

	<label for = "queryID"> Query Worker ID </label>
	<input type = "text" id = "queryID" name="queryID" placeholder="2"/>
    <label for = "queryFacilityName"> Query Facility Name </label>
	<input type = "text" id = "queryFacilityName" name="queryFacilityName" placeholder="B"/>
    <label for = "queryStartDate"> Query Start Date </label>
	<input type = "text" id = "queryStartDate" name="queryStartDate" placeholder="2020-1-1"/>

	<button type = "submit" name = "query" value = "query"> Query Table </button>
	<button type = "submit" name = "delete" value = "delete"> Delete Value </button>
	<button type = "submit" name = "update" value = "update"> Update Value </button>
</form>

<?php

	if ($_POST != null)
	{
		// Inserting stuff.
		if ($_POST["insert"] != NULL)
		{
            if ($_POST["pID"] != NULL && $_POST["facility_name"] != NULL && $_POST["start_date"] != NULL)
            {
                $pID = "'".$_POST["pID"]."'";
                $facilityName = "'".$_POST["facility_name"]."'";
                $startDate = "'".$_POST["start_date"]."'";
                $endDate = $_POST["end_date"] == "" ? "DEFAULT" : "'".$_POST["end_date"]."'";
                $hourlyWage = $_POST["hourly_wage"] == "" ? "DEFAULT" : "'".$_POST["hourly_wage"]."'";

                $insert = "
                INSERT INTO Assignments(pID, facilityName, startDate, endDate, hourlyWage)
                VALUES($pID, $facilityName, $startDate, $endDate, $hourlyWage);";

                if ($conn->query($insert) === TRUE) {
                    echo "<p> Successfully inserted!</p>";
                } else {
                    echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
                }
            }
            else
            {
                echo "<p> Please fill the 'Worker ID', 'Faciity Name', and 'Start Date' for inserting an assignment. </p>";
            }
		}

		// Querying stuff.
        if ($_POST["query"] != NULL)
		{
            if ($_POST["queryID"] != NULL && $_POST["queryFacilityName"] != NULL && $_POST["queryStartDate"] != NULL)
            {
                $pID = "'".$_POST["queryID"]."'";
                $facilityName = "'".$_POST["queryFacilityName"]."'";
                $startDate = "'".$_POST["queryStartDate"]."'";

                $query = "
                SELECT *
                FROM Assignments
                WHERE pID=$pID AND facilityName=$facilityName AND startDate=$startDate";
            }
            else
            {
                $query = "
                SELECT *
                FROM Assignments";
            }

            $result = $conn->query($query);

            if (mysqli_num_rows($result) > 0) 
            {
                echo "<h2> Province Information </h2>";
                echo "
                    <table>
                        <tr>
                            <th> Worker ID </th>
                            <th> Facility Name </th>
                            <th> Start Date </th>
                            <th> End Date </th>
                            <th> Worker ID at Facilities </th>
                            <th> Hourly Wage </th>
                        </tr>";

                while($row = mysqli_fetch_assoc($result)) 
                {
                    echo "<tr>
                            <td> ".$row["pID"]." </td>
                            <td> ".$row["facilityName"]." </td>
                            <td> ".$row["startDate"]." </td>
                            <td> ".$row["endDate"]." </td>
                            <td> ".$row["workerID"]." </td>
                            <td> ".$row["hourlyWage"]." </td>					
                        </tr>";
                }
                echo "</table>";
            }
            
		}

		if ($_POST["delete"] != NULL)
		{
			if ($_POST["queryID"] != NULL && $_POST["queryFacilityName"] != NULL && $_POST["queryStartDate"] != NULL)
			{
                $pID = "'".$_POST["queryID"]."'";
                $facilityName = "'".$_POST["queryFacilityName"]."'";
                $startDate = "'".$_POST["queryStartDate"]."'";

				$query = "
                DELETE FROM Assignments
                WHERE pID=$pID AND facilityName=$facilityName AND startDate=$startDate;";

				if ($conn->query($query) === TRUE) {
					echo "<p> Successfully deleted the entry!</p>";
				} else {
					echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
				}
			}
			else
			{
				echo "<p> Please fill the 'Query Worker ID', 'Query Faciity Name', and 'Query Start Date' for deleting an assignment. </p>";
			}
		}

		// Updating stuff.
		if ($_POST["update"] != NULL)
		{
			if ($_POST["queryID"] != NULL && $_POST["queryFacilityName"] != NULL && $_POST["queryStartDate"] != NULL
                 && $_POST["pID"] != NULL && $_POST["facility_name"] != NULL && $_POST["start_date"] != NULL)
			{
                $pID = "'".$_POST["pID"]."'";
                $facilityName = "'".$_POST["facility_name"]."'";
                $startDate = "'".$_POST["start_date"]."'";
                $endDate = $_POST["end_date"] == "" ? "DEFAULT" : "'".$_POST["end_date"]."'";
                $hourlyWage = $_POST["hourly_wage"] == "" ? "DEFAULT" : "'".$_POST["hourly_wage"]."'";

                $queryPID = "'".$_POST["queryID"]."'";
                $queryFacilityName = "'".$_POST["queryFacilityName"]."'";
                $queryStartDate = "'".$_POST["queryStartDate"]."'";

				$queryName = "'".$_POST["queryName"]."'";
				$insert = "
                UPDATE Assignments
                SET pID=$pID, facilityName=$facilityName, startDate=$startDate, endDate=$endDate, hourlyWage=$hourlyWage
                WHERE pID=$queryPID AND facilityName=$queryFacilityName AND startDate=$queryStartDate;";

				if ($conn->query($insert) === TRUE) {
					echo "<p> Successfully updated the entry!</p>";
				} else {
					echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
				}
			}
			else
			{
				echo "<p> Please fill the 'Query Worker ID', 'Query Faciity Name', and 'Query Start Date' with the one you want to modify.</p>
                            <p> and 'Worker ID', 'Faciity Name', and 'Start Date' with the new information </p>";
			}
			
		}
		
	}
?>


<?php require("footer.php"); ?>