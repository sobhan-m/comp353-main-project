<?php
require_once("header.php");
fileHeader("Query 17 - Perform Appointment-Less Vaccine");
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
    <input type="date" name="dateOfVaccination" class="registered unregistered">
    <input type="text" name="telephoneNumber" placeholder="Telephone Number" class="unregistered">
    <input type="text" name="address" placeholder="Adress" class="unregistered">
    <input type="text" name="city" placeholder="City" class="unregistered">
    <input type="text" name="postalCode" placeholder="Postal Code" class="unregistered">
    <input type="text" name="citizenship" placeholder="Citizenship" class="unregistered">
    <input type="text" name="country" placeholder="Country" class="registered unregistered">
    <input type="email" name="email" placeholder="E-mail" class="unregistered">
    <input type="text" name="facilityName" placeholder="Facility Name" class="registered unregistered">
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
if ($_POST != null && $_POST["sub1"] != null && $_POST["sub1"] == "1") {

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
    $dateOfVaccination = $_POST["dateOfVaccination"];
    $facilityName = $_POST["facilityName"];
    $query = "
    SELECT * FROM Registered 
    WHERE medicareCardNum = $identificaiton";
    $result = $conn->query($query);

    if (mysqli_num_rows($result) > 0) {
        echo "<p></p>";
        $sql = "SELECT firstName AS 'First name', middleInitial AS 'Middle initial', lastName AS 'Last name', doseNumber AS 'Dose Number' 
        FROM Person p 
        INNER JOIN Vaccinations v ON p.id = v.id 
        WHERE firstName = '$fName' AND middleInitial = '$mInitial' AND lastName = '$lName'";
        $result = $conn->query($sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck >= 2) {
            echo "<p>" . $fName . " " . $mInitial . " " . $lName . " is already fully vaccinated! </p>";
        } else if ($resultCheck == 1) {
            $doseNumber = 2;
            $sql = "INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber) 
            VALUES('$id', '$nurseID', '$vaccineName', '$dateOfVaccination', '$lotNumber', '$facilityName', '$province', '$country', '$doseNumber')";
            $result = $conn->query($sql);
            echo "<p>" . $fName . " " . $mInitial . " " . $lName . " received dose number: " . $doseNumber . "</p>";
        } else if ($resultCheck == 0) {
            $doseNumber = 1;
            $sql = "INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber) 
            VALUES('$id', '$nurseID', '$vaccineName', '$dateOfVaccination', '$lotNumber', '$facilityName', '$province', '$country', '$doseNumber')";
            $result = $conn->query($sql);
            echo "<p>" . $fName . " " . $mInitial . " " . $lName . " received dose number: " . $doseNumber . "</p>";
        }

        $sql = "SELECT * FROM Vaccinations ORDER BY Vaccinations.id";
        $result = $conn->query($sql);
        $resultCheck = mysqli_fetch_row($result);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<p> ID: " . $row["id"] . " " . "Dose Number: " . $row["doseNumber"] . "</p>";
            }
        }
    } else {
        echo "<p> You are not registered! </p>";
    }
}
if ($_POST != null && $_POST["sub1"] != null && $_POST["sub1"] == "2") {
    $identification = $_POST["identification"];
    $fName = $_POST["fName"];
    $mInitial = $_POST["mInitial"];
    $lName = $_POST["lName"];
    $id = $_POST["id"];
    $nurseID = $_POST["nurseID"];
    $vaccineName = $_POST["vaccineName"];
    $lotNumber = $_POST["lotNumber"];
    $province = $_POST["province"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $postalCode = $_POST["postalCode"];
    $citizenship = $_POST["citizenship"];
    $tNumber = $_POST["telephoneNumber"];
    $dateOfBirth = $_POST["dateOfBirth"];
    $dateOfVaccination = $_POST["dateOfVaccination"];
    $facilityName = $_POST["facilityName"];

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

    if (mysqli_num_rows($result) > 0) {
        echo "<p></p>";
        $sql = "SELECT firstName AS 'First name', middleInitial AS 'Middle initial', lastName AS 'Last name', doseNumber AS 'Dose Number' 
        FROM Person p 
        INNER JOIN Vaccinations v ON p.id = v.id 
        WHERE firstName = '$fName' AND middleInitial = '$mInitial' AND lastName = '$lName'";
        $result = $conn->query($sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck >= 2) {
            echo "<p>" . $fName . " " . $mInitial . " " . $lName . " is already fully vaccinated! </p>";
        } else if ($resultCheck == 1) {
            $doseNumber = 2;
            $sql = "INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber) 
            VALUES('$id', '$nurseID', '$vaccineName', '$dateOfVaccination', '$lotNumber', '$facilityName', '$province', '$country', '$doseNumber')";
            $result = $conn->query($sql);
            echo "<p>" . $fName . " " . $mInitial . " " . $lName . " received dose number: " . $doseNumber . "</p>";
        } else if ($resultCheck == 0) {
            $doseNumber = 1;
            $sql = "INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber) 
            VALUES('$id', '$nurseID', '$vaccineName', '$dateOfVaccination', '$lotNumber', '$facilityName', '$province', '$country', '$doseNumber')";
            $result = $conn->query($sql);
            echo "<p>" . $fName . " " . $mInitial . " " . $lName . " received dose number: " . $doseNumber . "</p>";
        }

        $sql = "SELECT * FROM Vaccinations ORDER BY Vaccinations.id";
        $result = $conn->query($sql);
        $resultCheck = mysqli_fetch_row($result);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<p> ID: " . $row["id"] . " " . "Dose Number: " . $row["doseNumber"] . "</p>";
            }
        }
    } else {
        echo "<p> This person doesn't exists! </p>";
    }
}
?>

<?php require("footer.php"); ?>