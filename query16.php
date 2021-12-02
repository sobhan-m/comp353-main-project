<?php
require_once("header.php");
fileHeader("Query 16 - Perform Appointment Vaccine");
?>
<div class="row button-prompts">
    <button type="button" onclick="DisplayRegistered();"> Registered </button>
    <button type="button" onclick="DisplayUnregistered();"> Unregistered </button>
</div>

<form method="POST">
    <input type="text" name="identification" placeholder="Identification number" class="registered unregistered">
    <input type="text" name="fName" placeholder="First Name" class="registered unregistered">
    <input type="text" name="mInitial" placeholder="Middle Initial" class="registered unregistered">
    <input type="text" name="lName" placeholder="Last Name" class="registered unregistered">
    <input type="text" name="id" placeholder="ID" class="registered unregistered">
    <input type="text" name="nurseID" placeholder="Nurse ID" class="registered unregistered">
    <input type="text" name="vaccineName" placeholder="Vaccine Name" class="registered unregistered">
    <input type="text" name="lotNumber" placeholder="Lot Number" class="registered unregistered">
    <input type="text" name="province" placeholder="Province" class="registered unregistered">
    <input type="date" name="dateOfBirth" class="unregistered">
    <input type="text" name="telephoneNumber" placeholder="Telephone Number" class="unregistered">
    <input type="text" name="address" placeholder="Adress" class="unregistered">
    <input type="text" name="city" placeholder="City" class="unregistered">
    <input type="text" name="postalCode" placeholder="Postal Code" class="unregistered">
    <input type="text" name="citizenship" placeholder="Citizenship" class="unregistered">
    <input type="text" name="country" placeholder="Country" class="registered unregistered">
    <input type="email" name="email" placeholder="E-mail" class="unregistered">
    <button type="submit" name="sub1" value="1" class="registered"> Submit Re </button>
    <button type="submit" name="sub1" value="2" class="unregistered"> Submit Unre </button>
</form>
<br>

<script type="text/javascript">
    var registered = document.getElementsByClassName("registered");
    var unregistered = document.getElementsByClassName("unregistered");

    function HideAll(input) {
        for (let i = 0; i < input.length; ++i) {
            if (input[i].required == true)
                input[i].required = false;
            input[i].style.display = "none";
        }
    }

    function DisplayAll(input) {
        for (let i = 0; i < input.length; ++i) {
            input[i].style.display = "block";
        }

        buttons = document.getElementsByTagName("button");
        for (let i = 0; i < buttons.length; ++i) {
            if (buttons[i].style.display == "none") {
                buttons[i].disabled = true;
            } else {
                buttons[i].disabled = false;
            }
        }
    }

    function DisplayRegistered() {
        HideAll(unregistered);
        DisplayAll(registered);
    }

    function DisplayUnregistered() {
        HideAll(registered);
        DisplayAll(unregistered);
    }

    HideAll(registered);
    HideAll(unregistered);
</script>

<?php
if ($_POST != null && $_POST["sub1"] != null && $_POST["sub1"] == "1") 
{

    $identificaiton = $_POST["identification"];
    $fName = $_POST["fName"];
    $mInitial = $_POST["mInitial"];
    $lName = $_POST["lName"];
    $id = $_POST["id"];
    $nurseID = $_POST["nurseID"];
    $vaccineName = $_POST["vaccineName"];
    $lotNumber = $_POST["lotNumber"];
    $province = $_POST["province"];
    $country = $_POST["country"];
    

    $query = "
    SELECT * FROM Registered 
    WHERE medicareCardNum = $identificaiton";
    $result = $conn->query($query);

    if (mysqli_num_rows($result) > 0)
    {

        $sql = "
        SELECT firstName AS 'First name', middleInitial AS 'Middle initial', lastName AS 'Last name', phf.address AS 'Address', phf.province AS 'Province', phf.country AS 'Country', MAX(doseNumber) AS 'Total dose number', a.facilityName AS 'Facility Name', a.date AS 'Date'
        FROM Person
        INNER JOIN  Appointments a ON Person.id = a.pID
        INNER JOIN PublicHealthFacilities phf ON phf.name = a.facilityName 
        LEFT JOIN Vaccinations v ON Person.id = v.id
        WHERE firstName = '$fName' AND middleInitial ='$mInitial' AND lastName = '$lName'
        GROUP BY Person.id
        ORDER BY Person.id, a.date";
        
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        
        if (mysqli_num_rows($result) > 0) 
        {

            if ($row["Total dose number"] == 2) 
            {
                echo "<p> This person is fully vaccinated already! </p>";
            } else if ($row["Total dose number"] == 1) 
            {
                $dateOfVaccination = $row["Date"];
                $facilityName = $row["Facility Name"];
                $doseNumber = 2;
                $appointmentCount = "
                SELECT * 
                FROM Appointments A
                WHERE A.pID = '$id'";
                $result = $conn->query($appointmentCount);
                $counter = mysqli_num_rows($result);

                if($counter == 2)
                {
                    $secondDate = "
                    SELECT A.date
                    FROM Appointments A
                    WHERE pID = '$id'
                    AND a.date <> '$dateOfVaccination'";
                    $result = $conn->query($secondDate);
                    $appointmentArray = mysqli_fetch_assoc($result);
                    $dateOfVaccination = $appointmentArray["date"];
                }
            
                $sql1 = "
                INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber)
                VALUES('$id', '$nurseID', '$vaccineName', '$dateOfVaccination', '$lotNumber', '$facilityName', '$province', '$country', '$doseNumber')";
                $result = $conn->query($sql1);
                echo "<p> This person received his vaccine! </p>";

            } else if ($row["Total dose number"] == 0) 
            {
                $dateOfVaccination = $row["Date"];
                echo $dateOfVaccination . "<br>";
                $facilityName = $row["Facility Name"];
                $doseNumber = 1;
                $sql1 = "
                INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber)
                VALUES('$id', '$nurseID', '$vaccineName', '$dateOfVaccination', '$lotNumber', '$facilityName', '$province', '$country', '$doseNumber')";
                $result = $conn->query($sql1);
            }
        } else {
            echo "<p> This person does not have an appointment </p>";
        }
    } else  {
        echo "<p> You are not registered! </p>";
    }

    $sql2 = "
    SELECT * 
    FROM Vaccinations 
    ORDER BY Vaccinations.id";
    $result1 = $conn->query($sql2);
    $resultCheck1 = mysqli_num_rows($result1);

    if ($resultCheck1 > 0) {
        while ($rows1 = mysqli_fetch_assoc($result1)) {
            echo "<p>" . $rows1["id"] . " " . $rows1["doseNumber"] . "</p>";
        }
    }    
}

if ($_POST != null && $_POST["sub1"] != null && $_POST["sub1"] == "2") 
{
    $identification = ($_POST["identification"]);
    $fName = ($_POST["fName"]);
    $mInitial = ($_POST["mInitial"]);
    $lName = ($_POST["lName"]);
    $id = ($_POST["id"]);
    $nurseID = ($_POST["nurseID"]);
    $vaccineName = ($_POST["vaccineName"]);
    $lotNumber = ($_POST["lotNumber"]);
    $province = ($_POST["province"]);
    $country = ($_POST["country"]);
    $city = ($_POST["city"]);
    $email = ($_POST["email"]);
    $address = ($_POST["address"]);
    $postalCode = ($_POST["postalCode"]);
    $citizenship = ($_POST["citizenship"]);
    $tNumber = ($_POST["telephoneNumber"]);
    $dateOfBirth = ($_POST["dateOfBirth"]);

    $query = "
    SELECT * 
    FROM Unregistered U
    INNER JOIN Person P ON P.id = U.id
    WHERE firstName = '$fName '
    AND lastName = '$lName '
    AND middleInitial = '$mInitial'
    AND dateOfBirth = '$dateOfBirth'
    AND telephoneNumber = '$tNumber'
    AND city = '$city'
    AND province = '$province'
    AND postalCode = '$postalCode'
    AND citizenship = '$citizenship'
    AND emailAddress ='$email'
    AND address = '$address'
    AND U.passportNum = '$identification'";
    $result = $conn->query($query);

    if (mysqli_num_rows($result) > 0)
    {

        $sql = "
        SELECT firstName AS 'First name', middleInitial AS 'Middle initial', lastName AS 'Last name', phf.address AS 'Address', phf.province AS 'Province', phf.country AS 'Country', MAX(doseNumber) AS 'Total dose number', a.facilityName AS 'Facility Name', a.date AS 'Date'
        FROM Person
        INNER JOIN  Appointments a ON Person.id = a.pID
        INNER JOIN PublicHealthFacilities phf ON phf.name = a.facilityName 
        LEFT JOIN Vaccinations v ON Person.id = v.id
        WHERE firstName = '$fName' AND middleInitial ='$mInitial' AND lastName = '$lName'
        GROUP BY Person.id
        ORDER BY Person.id, a.date";
        
        $result = $conn->query($sql);
        
        
        if (mysqli_num_rows($result) > 0) 
        {
            $row = mysqli_fetch_assoc($result);

            if ($row["Total dose number"] == 2) 
            {
                echo "<p> This person is fully vaccinated already! </p>";
            } else if ($row["Total dose number"] == 1) 
            {
                $dateOfVaccination = $row["Date"];
                $facilityName = $row["Facility Name"];
                $doseNumber = 2;
                $appointmentCount = "
                SELECT * 
                FROM Appointments A
                WHERE A.pID = '$id'";
                $result = $conn->query($appointmentCount);
                $counter = mysqli_num_rows($result);

                if($counter == 2)
                {
                    $secondDate = "
                    SELECT A.date
                    FROM Appointments A
                    WHERE pID = '$id'
                    AND a.date <> '$dateOfVaccination'";
                    $result = $conn->query($secondDate);
                    $appointmentArray = mysqli_fetch_assoc($result);
                    $dateOfVaccination = $appointmentArray["date"];
                }
                echo $dateOfVaccination . "<br>";
                $sql1 = "
                INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber)
                VALUES('$id', '$nurseID', '$vaccineName', '$dateOfVaccination', '$lotNumber', '$facilityName', '$province', '$country', '$doseNumber')";
                $result = $conn->query($sql1);
                echo "<p> This person received his vaccine! </p>";

            } else if ($row["Total dose number"] == 0) 
            {
                $dateOfVaccination = $row["Date"];
                echo $dateOfVaccination . "<br>";
                $facilityName = $row["Facility Name"];
                $doseNumber = 1;
                $sql1 = "
                INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber)
                VALUES('$id', '$nurseID', '$vaccineName', '$dateOfVaccination', '$lotNumber', '$facilityName', '$province', '$country', '$doseNumber')";
                $result = $conn->query($sql1);
            }
        } else {
            echo "<p> This person does not have an appointment </p>";
        }
    } else  {
        echo "<p> You are not registered! </p>";
    }

    $sql2 = "
    SELECT * 
    FROM Vaccinations 
    ORDER BY Vaccinations.id";
    $result1 = $conn->query($sql2);
    $resultCheck1 = mysqli_num_rows($result1);

    if ($resultCheck1 > 0) {
        while ($rows1 = mysqli_fetch_assoc($result1)) {
            echo "<p>" . $rows1["id"] . " " . $rows1["doseNumber"] . "</p>";
        }
    }
}
?>

<?php require("footer.php"); ?>