<?php
require_once("header.php");
fileHeader("Query 16 - Perform Appointment Vaccine");
?>
<form method="POST">
    <!-- VALUES(1, 9, 'AstraZeneca', '2021-02-24', 13, 'I', NULL, 'Tunisia', 2); -->
    <input type="text" name="fName" placeholder="First Name">
    <input type="text" name="mInitial" placeholder="Middle Initial">
    <input type="text" name="lName" placeholder="Last Name">
    <input type="text" name="id" placeholder="ID">
    <input type="text" name="nurseID" placeholder="Nurse ID">
    <input type="text" name="vaccineName" placeholder="Vaccine Name">
<!-- <input type="text" name="dateOfVaccination" placeholder="Date of Vaccination">-->
    <input type="text" name="lotNumber" placeholder="Lot Number">
    <input type="text" name="province" placeholder="Province">
    <input type="text" name="country" placeholder="Country">
    <button type="submit" name="sub1" value="1"> Submit </button>
</form>
<br>
<?php
if ($_POST != null && $_POST["sub1"] != null && $_POST["sub1"] == "1") {

    $fName = $_POST["fName"];
    $mInitial = $_POST["mInitial"];
    $lName = $_POST["lName"];
    $id = $_POST["id"];
    $nurseID = $_POST["nurseID"];
    $vaccineName = $_POST["vaccineName"];
    $lotNumber = $_POST["lotNumber"];
    $province = $_POST["province"];
    $country = $_POST["country"];

    $sql = "SELECT firstName AS 'First name', middleInitial AS 'Middle initial', lastName AS 'Last name', phf.address AS 'Address', phf.province AS 'Province', phf.country AS 'Country', MAX(doseNumber) AS 'Total dose number', a.facilityName AS 'Facility Name', a.date AS 'Date'
    FROM Person
     INNER JOIN  Appointments a ON Person.id = a.pID
     INNER JOIN PublicHealthFacilities phf ON phf.name = a.facilityName 
     LEFT JOIN Vaccinations v ON Person.id = v.id
    WHERE firstName = '$fName' AND middleInitial ='$mInitial' AND lastName = '$lName'
    GROUP BY Person.id
    ORDER BY Person.id, a.date";

    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {

        if ($row["Total dose number"] == 2) {
            echo "<p> This person is fully vaccinated already! </p>";

        } else if ($row["Total dose number"] == 1) {
            $dateOfVaccination = $row["Date"];
            
            $facilityName = $row["Facility Name"];
            $doseNumber = 2;
            $secondVaccineTest = "SELECT * FROM Vaccinations ORDER BY Vaccinations.id";
            $result = $conn->query($secondVaccineTest);
            $appointmentVerification = mysqli_fetch_assoc($result);
            if(mysqli_num_rows($result) > 0){
                $correctDateOfVaccinationSearch = "SELECT a.date FROM Appointments a WHERE a.date <> '$dateOfVaccination' AND pID = '$id'";
                $result = $conn->query($correctDateOfVaccinationSearch);
                $realDateOfVaccination = mysqli_fetch_assoc($result);
                $dateOfVaccination = $realDateOfVaccination["date"];
            }
            echo $dateOfVaccination . "<br>";
            $sql1 = "INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber)
                    VALUES('$id', '$nurseID', '$vaccineName', '$dateOfVaccination', '$lotNumber', '$facilityName', '$province', '$country', '$doseNumber')";
            $result = $conn->query($sql1);
            echo "<p> This person received his vaccine! </p>";

        } else if ($row["Total dose number"] == 0) {
            $dateOfVaccination = $row["Date"];
            echo $dateOfVaccination . "<br>";
            $facilityName = $row["Facility Name"];
            $doseNumber = 1;
            $sql1 = "INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber)
                    VALUES('$id', '$nurseID', '$vaccineName', '$dateOfVaccination', '$lotNumber', '$facilityName', '$province', '$country', '$doseNumber')";
            $result = $conn->query($sql1);

        }
    } else {
        echo "<p> This person does not have an appointment </p>";

    }

    $sql2 = "SELECT * FROM Vaccinations ORDER BY Vaccinations.id";
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