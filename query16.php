<?php
require_once("header.php");
fileHeader("Home");
?>
<form method="POST">
    <!-- VALUES(1, 9, 'AstraZeneca', '2021-02-24', 13, 'I', NULL, 'Tunisia', 2); -->
    <input type="text" name="fName" placeholder="First Name">
    <input type="text" name="mInitial" placeholder="Middle Initial">
    <input type="text" name="lName" placeholder="Last Name">
    <input type="text" name="id" placeholder="ID">
    <input type="text" name="nurseID" placeholder="Nurse ID">
    <input type="text" name="vaccineName" placeholder="Vaccine Name">
    <input type="text" name="dateOfVaccination" placeholder="Date of Vaccination">
    <input type="text" name="lotNumber" placeholder="Lot Number">
    <input type="text" name="facilityName" placeholder="Name of facility">
    <input type="text" name="province" placeholder="Province">
    <input type="text" name="country" placeholder="Country">
    <input type="text" name="doseNumber" placeHolder="Dose number">
    <button type="submit" name="sub1" value="1"> Submit </button>
</form>
<br>
<form method="POST">
    <input type="text" name="ageToDelete" placeholder="Min age of age group">
    <button type="submit" name="sub1" value="2"> Submit </button>
</form>
<?php
if ($_POST != null && $_POST["sub1"] != null && $_POST["sub1"] == "1") {

    $fName = $_POST["fName"];
    $mInitial = $_POST["mInitial"];
    $lName = $_POST["lName"];
    $id = $_POST["id"];
    $nurseID = $_POST["nurseID"];
    $vaccineName = $_POST["vaccineName"];
    $dateOfVaccination = $_POST["dateOfVaccination"];
    $lotNumber = $_POST["lotNumber"];
    $facilityName = $_POST["facilityName"];
    $province = $_POST["province"];
    $country = $_POST["country"];
    $doseNumber = $_POST["doseNumber"];
    $sql = "SELECT firstName AS 'First name', middleInitial AS 'Middle initial', lastName AS 'Last name', phf.address AS 'Address', phf.province AS 'Province', phf.country AS 'Country', MAX(doseNumber) AS 'Total dose number'
    FROM Person
     INNER JOIN  Appointments a ON Person.id = a.pID
     INNER JOIN PublicHealthFacilities phf ON phf.name = a.facilityName 
     LEFT JOIN Vaccinations v ON Person.id = v.id
    WHERE firstName = '$fName' AND middleInitial = '$mInitial' AND lastName = '$lName'
    GROUP BY Person.id
    ORDER BY Person.id";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    if ($row["Total dose number"] >= 2) {
        echo "This person is fully vaccinated already!" . "<br>";
    } elseif ($doseNumber <= 2 && $doseNumber >= 1){
        $sql1 = "INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber) VALUES('$id', '$nurseID', '$vaccineName', '$dateOfVaccination', '$lotNumber', '$facilityName', '$province', '$country', '$doseNumber')";
        $result = $conn->query($sql1);
        echo "This person received his vaccine!" . "<br>";
    }
    

    $sql2 = "SELECT * FROM Vaccinations";
    $result1 = $conn->query($sql2);
    $resultCheck1 = mysqli_num_rows($result1);

    if($resultCheck1 > 0){
        while($rows1 = mysqli_fetch_assoc($result1)){
            echo $rows1["id"] . " " . $rows1["doseNumber"] . "<br>";
        }
    }

}
?>
<?php require("footer.php"); ?>