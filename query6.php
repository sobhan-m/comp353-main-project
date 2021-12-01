<?php
require_once("header.php");
fileHeader("Home");
?>
<form method="POST">
    <input type="text" name="newAgeGroupID" placeholder="Age group to add">
    <input type="text" name="newAgeGroupMinAge" placeholder="Min">
    <input type="text" name="newAgeGroupMaxAge" placeholder="Max">
    <button type="submit" name="sub1" value="1"> Submit </button>
</form>
<br>
<form method="POST">
    <input type="text" name="ageToDelete" placeholder="Min age of age group">
    <button type="submit" name="sub1" value="2"> Submit </button>
</form>
<br>
<form method="POST">
    <input type="text" name="currentMinAge" placeholder="Current min age">
    <input type="text" name="newMinAge" placeholder="New min">
    <input type="text" name="newMaxAge" placeholder="new Max">
    <button type="submit" name="sub1" value="3"> Submit </button>
</form>
<br>
<form method="POST">
    <input type="text" name="selectAllFromMinAge" placeholder="Min age of age group to display">
    <button type="submit" name="sub1" value="4"> Submit </button>
</form>
<br>
<?php
if ($_POST != null && $_POST["sub1"] != null && $_POST["sub1"] == "1") {
    $newAgeGroupID = $_POST["newAgeGroupID"];
    $newAgeGroupMinAge = $_POST["newAgeGroupMinAge"];
    $newAgeGroupMaxAge = $_POST["newAgeGroupMaxAge"];
    if ($newAgeGroupMinAge > $newAgeGroupMaxAge || $newAgeGroupID < 0) {
        echo "<p> There is an error in the entered values </p>";
    } else {
        $sql = "INSERT INTO AgeGroup(groupID, minAge, maxAge) VALUES('$newAgeGroupID', '$newAgeGroupMinAge', '$newAgeGroupMaxAge')";
        $result = $conn->query($sql);
    }

    $sql1 = "SELECT * FROM AgeGroup";
    $result1 = $conn->query($sql1);
    $resultCheck1 = mysqli_num_rows($result1);

    if ($resultCheck1 > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
            echo "<p> Group ID: " . $row["groupID"] . " " . "Minimum age of the group: " . $row["minAge"] . " " . "Maximum age of the group: " . $row["maxAge"] . "</p>";
        }
    }

}

?>

<?php
if ($_POST != null && $_POST["sub1"] != null && $_POST["sub1"] == "2") {

    $ageToDelete = $_POST["ageToDelete"];
    $sql = "DELETE FROM AgeGroup WHERE minAge = '$ageToDelete'";
    $result = $conn->query($sql);

    $sql2 = "SELECT * FROM AgeGroup";
    $result2 = $conn->query($sql2);
    $resultCheck2 = mysqli_num_rows($result2);

    if ($resultCheck2 > 0) {
        while ($row = mysqli_fetch_assoc($result2)) {
            echo "<p> Group ID: " . $row["groupID"] . " " . "Minimum age of the group: " . $row["minAge"] . " " . "Maximum age of the group: " . $row["maxAge"] . "</p>";
        }
    } 
}

?>

<?php
if ($_POST != null && $_POST["sub1"] != null && $_POST["sub1"] == "3") {

    $currentMinAge = $_POST["currentMinAge"];
    $newMinAge = $_POST["newMinAge"];
    $newMaxAge = $_POST["newMaxAge"];
    if ($newMinAge > $newMaxAge) {
        echo "There is some errors in the entered values!" . "<br>";
    }
    $sql = "UPDATE AgeGroup SET minAge = '$newMinAge', maxAge = '$newMaxAge' WHERE minAge = '$currentMinAge'";
    $result = $conn->query($sql);

    $sql3 = "SELECT * FROM AgeGroup";
    $result3 = $conn->query($sql3);
    $resultCheck3 = mysqli_num_rows($result3);

    if ($resultCheck3 > 0) {
        while ($row = mysqli_fetch_assoc($result3)) {
            echo "<p> Group ID: " . $row["groupID"] . " " . "Minimum age of the group: " . $row["minAge"] . " " . "Maximum age of the group: " . $row["maxAge"] . "</p>";
        }
    } 
}

?>

<?php
if ($_POST != null && $_POST["sub1"] != null && $_POST["sub1"] == "4") {

    $selectAllFromMinAge = $_POST["selectAllFromMinAge"];

    $sql = "SELECT * FROM AgeGroup WHERE minAge = '$selectAllFromMinAge'";
    $result = $conn->query($sql);

    $sql4 = "SELECT * FROM AgeGroup";
    $result4 = $conn->query($sql);
    $resultCheck4 = mysqli_num_rows($result4);

    if ($resultCheck4 > 0) {
        while ($row = mysqli_fetch_assoc($result4)) {
            echo "<p> Group ID: " . $row["groupID"] . " " . "Minimum age of the group: " . $row["minAge"] . " " . "Maximum age of the group: " . $row["maxAge"] . "</p>";
        }
    } else {
        echo "<p> Values not found in database! </p>";
    }
}

?>

<?php require("footer.php"); ?>