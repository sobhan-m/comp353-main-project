<?php
require_once("header.php");
fileHeader("Query 5 - Infection Types");
?>

<!-- Code Goes Here -->

<form method="POST">
	<input type="text" name="newInfection" placeholder="Infection to add">
	<button type="submit" name="sub1" value="1"> Submit </button>

</form>
<br>
<form method="POST">
	<input type="text" name="deleteInfection" placeholder="Infection to delete">
	<button type="submit" name="sub1" value="2"> Submit </button>
</form>
<br>
<form method="POST">
	<input type="text" name="infectionChanged" placeholder="Change infection to">
	<input type="text" name="updateInfection" placeholder="Infection to update">
	<button type="submit" name="sub1" value="3"> Submit </button>
</form>
<br>
<form method="POST">
	<input type="text" name="selectInfection" placeholder="Infection to display">
	<button type="submit" name="sub1" value="4"> Submit </button>
</form>
<br>

<?php
if ($_POST != null && $_POST["sub1"] != null && $_POST["sub1"] == "1") {
	$newInfections;
	$newInfections = $_POST["newInfection"];
	$sql = "INSERT INTO InfectionTypes(name) VALUES('$newInfections') ON DUPLICATE KEY UPDATE name = '$newInfections'";
	$result = $conn->query($sql);

	$sql1 = "SELECT * FROM InfectionTypes";
	$result1 = $conn->query($sql1);
	$resultCheck = mysqli_num_rows($result1);

	if ($resultCheck > 0) {
		while ($row = mysqli_fetch_assoc($result1)) {
			echo "<p>" . $row["name"] . "</p>";
		}
	}
}

?>
<?php
if ($_POST != null && $_POST["sub1"] != null && $_POST["sub1"] == "2") {
	$infectionToDelete;
	$infectionToDelete = $_POST["deleteInfection"];

	$sql = "DELETE FROM InfectionTypes WHERE name = '$infectionToDelete'";
	$result = $conn->query($sql);

	$sql2 = "SELECT * FROM InfectionTypes";
	$result2 = $conn->query($sql2);
	$resultCheck = mysqli_num_rows($result2);

	//if ($resultCheck0 == $resultCheck){
	//	echo "Key Constraint: Failed to delete";
	if ($resultCheck > 0) {
		while ($row = mysqli_fetch_assoc($result2)) {
			echo "<p>" . $row["name"] . "</p>";
		}
	}
}
?>
<?php
if ($_POST != null && $_POST["sub1"] != null && $_POST["sub1"] == "3") {
	$infectionChanged;
	$updateInfection;
	$infectionChanged = $_POST["infectionChanged"];
	$updateInfection = $_POST["updateInfection"];
	$sql = "UPDATE InfectionTypes SET name = '$infectionChanged' WHERE name = '$updateInfection'";
	$result = $conn->query($sql);

	$sql3 = "SELECT * FROM InfectionTypes";
	$result3 = $conn->query($sql3);
	$resultCheck = mysqli_num_rows($result3);

	if ($resultCheck > 0) {
		while ($row = mysqli_fetch_assoc($result3)) {
			echo "<p>" . $row["name"] . "</p>";
		}
	}
}
?>
<?php
if ($_POST != null && $_POST["sub1"] != null && $_POST["sub1"] == "4") {
	$selectInfection;
	$selectInfection = $_POST["selectInfection"];

	$sql = "SELECT * FROM InfectionTypes WHERE name = '$selectInfection'";
	$result4 = $conn->query($sql);
	$resultCheck = mysqli_num_rows($result4);

	if ($resultCheck > 0) {
		while ($row = mysqli_fetch_assoc($result4)) {
			echo "<p>" . $row["name"] . "</p>";
		}
	} else {
        echo "<p> Values not found in database! </p>";
	}
}
?>

<?php require("footer.php"); ?>






<!-- ________________________________________________________ -->
<!--
$sql = "SELECT * FROM Person;";
		$result = mysqli_query($db, $sql);
		$resultCheck = mysqli_num_rows($result);
		
		if($resultCheck > 0){
			while($row = mysqli_fetch_assoc($result)){
				echo $row["firstName"]."<br>";
			}
		
		}
-->
<!-- ________________________________________________________ -->
<!--
<form action="main.php" method="get">
		First name: <input type="text" name="firstname">
		Age: <input type="number" name="age">
		<input type="submit">
		
	</form>
	<br/>

	Name: <?php echo $_GET["firstname"]; ?>
	Age : <?php echo $_GET["age"]; ?>
-->
<!-- ________________________________________________________ -->