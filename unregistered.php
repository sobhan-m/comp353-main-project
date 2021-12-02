<?php 
	require_once("header.php"); 
	fileHeader("Unregistered");
?>

<div class="instructions">
	<p>
		Enter the information to add an unregistered person.
	</p>
</div>


<form method = "post" class="form-input">

	<label for = "firstName"> First Name * </label>
	<input type = "text" id = "firstName" name="firstName" placeholder="First Name" required/>

	<label for = "middleInitial"> Middle Initial * </label>
	<input type = "text" id = "middleInitial" name="middleInitial" placeholder="Middle Initial" required/>
    
	<label for = "lastName"> Last Name * </label>
	<input type = "text" id = "lastName" name="lastName" placeholder="Last Name" required/>

	<label for = "passportNum"> Passport Number * </label>
	<input type = "text" id = "passportNum" name="passportNum" placeholder="Passport Number" required/>

	<button type = "submit" name = "insert" value = "insert"> Insert Value </button>


</form>

<?php

	if ($_POST != null && $_POST["insert"] != NULL)
	{
		$firstName = quote($_POST["firstName"]);
		$middleInitial = quote($_POST["middleInitial"]);
		$lastName = quote($_POST["lastName"]);
		$passportNum = quote($_POST["passportNum"]);

		$id = getPersonId($firstName, $middleInitial, $lastName, $conn);

		if ($id == null)
		{
			echo "<p> The name does match any person in our database. Please try again. </p>";
		}
		else
		{
			$insert = "
			INSERT INTO Unregistered(id, passportNum)
			VALUES ($id, $passportNum)";

			if ($conn->query($insert) === TRUE) {
				echo "<p> Successfully added the person's unregistered information!</p>";
			} else {
				echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
			}
		}
	}
?>



<?php require("footer.php"); ?>