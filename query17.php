<?php
require_once("header.php");
fileHeader("Query 17 - Perform Appointment-Less Vaccine");
?>
<form method="POST">
    <input type="text" name="firstName" placeholder="First Name">
    <input type="text" name="middleInitial" placeholder="Middle Initial">
    <input type="text" name="lastName" placeholder="Last Name">
    <input type="text" name="id" placeholder="ID">
    <input type="text" name="nurseID" placeholder="Nurse ID">
    <input type="text" name="vaccineName" placeholder="Vaccine Name">
    <input type="date" name="dateOfVaccination" placeholder="Date of Vaccination">
    <input type="text" name="lotNumber" placeholder="Lot Number">
    <input type="text" name="facilityName" placeholder="Facility Name">
    <input type="text" name="province" placeholder="Province">
    <input type="text" name="country" placeholder="Country">
    <button type="submit" name="sub1" value="1"> Submit </button>

</form>
<br>

<?php
if ($_POST != null && $_POST["sub1"] != null && $_POST["sub1"] == "1") {
    $firstName = $_POST["firstName"];
    $middleInitial = $_POST["middleInitial"];
    $lastName = $_POST["lastName"];
    $id = $_POST["id"];
    $nurseID = $_POST["nurseID"];
    $vaccineName = $_POST["vaccineName"];
    $dateOfVaccination = $_POST["dateOfVaccination"];
    $lotNumber = $_POST["lotNumber"];
    $facilityName = $_POST["facilityName"];
    $province = $_POST["province"];
    $country = $_POST["country"];
    echo "<p></p>";
    $sql = "SELECT firstName AS 'First name', middleInitial AS 'Middle initial', lastName AS 'Last name', doseNumber AS 'Dose Number' 
    FROM Person p 
    INNER JOIN Vaccinations v ON p.id = v.id 
    WHERE firstName = '$firstName' AND middleInitial = '$middleInitial' AND lastName = '$lastName'";
    $result = $conn->query($sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck >= 2) {
        echo "<p>" . $firstName . " " . $middleInitial . " " . $lastName . " is already fully vaccinated! </p>";
    } else if ($resultCheck == 1) {
        $doseNumber = 2;
        $sql = "INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber) 
        VALUES('$id', '$nurseID', '$vaccineName', '$dateOfVaccination', '$lotNumber', '$facilityName', '$province', '$country', '$doseNumber')";
        $result = $conn->query($sql);
        echo "<p>" . $firstName . " " . $middleInitial . " " . $lastName . " received dose number: " . $doseNumber . "</p>";
    } else if ($resultCheck == 0){
        $doseNumber = 1;
        $sql = "INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber) 
        VALUES('$id', '$nurseID', '$vaccineName', '$dateOfVaccination', '$lotNumber', '$facilityName', '$province', '$country', '$doseNumber')";
        $result = $conn->query($sql);
        echo "<p>" . $firstName . " " . $middleInitial . " " . $lastName . " received dose number: " . $doseNumber . "</p>";
        
    }

    $sql = "SELECT * FROM Vaccinations ORDER BY Vaccinations.id";
    $result = $conn->query($sql);
    $resultCheck = mysqli_fetch_row($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>" . "ID: " . $row["id"] . " " . "Dose Number: " . $row["doseNumber"] . "</p>";
        }
    }
}
?>

<?php require("footer.php"); ?>