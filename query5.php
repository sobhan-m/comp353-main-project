<?php 
	require_once("header.php"); 
	fileHeader("Home");
?>

<!-- Code Goes Here -->

	<form action="query5.php" method="POST">
		<input type="text" name="newInfection" placeholder="Infection to add">
		<button type="submit" name="sub1"> Submit </button>
		
	</form>
	<br>
	<form action="query5.php" method="POST">
		<input type="text" name="deleteInfection" placeholder="Infection to delete">
		<button type="submit" name="sub2"> Submit </button>
	</form>
	<br>
	
	<?php
		if($_POST != null){
			$newInfections;
			$newInfections = $_POST["newInfection"];
			$sql = "INSERT INTO InfectionTypes(name) VALUES('$newInfections') ON DUPLICATE KEY UPDATE name = '$newInfections'";
			$result = $conn->query($sql);
			
			$sql1 = "SELECT * FROM InfectionTypes";
			$result1 = $conn->query($sql1);
			$resultCheck = mysqli_num_rows($result1);
		
			if($resultCheck > 0){
				while($row = mysqli_fetch_assoc($result1)){
					echo $row["name"]."<br>";
				}
		
			}
		}

	?>
	<?php
			if($_POST != null){
			$infectionToDelete;
			$infectionToDelete = $_POST["deleteInfection"];
			$sql = "DELETE FROM InfectionTypes WHERE name = '$infectionToDelete'";
			$result = $conn->query($sql);
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

	Name: <?php echo $_GET["firstname"];?>
	Age : <?php echo $_GET["age"];?>
-->
<!-- ________________________________________________________ -->