<?php 
	require_once("header.php"); 
	fileHeader("Register");
?>

<div class="instructions">
	<p>
		Enter the information to register a person.
	</p>
</div>


<form method = "post" class="form-input">

	<label for = "firstName"> First Name * </label>
	<input type = "text" id = "firstName" name="firstName" placeholder="First Name" required/>

	<label for = "middleInitial"> Middle Initial * </label>
	<input type = "text" id = "middleInitial" name="middleInitial" placeholder="Middle Initial" required/>
    
	<label for = "lastName"> Last Name * </label>
	<input type = "text" id = "lastName" name="lastName" placeholder="Last Name" required/>

	<label for = "medicareCardNum"> Medicare Card Number * </label>
	<input type = "text" id = "medicareCardNum" name="medicareCardNum" placeholder="Medicare Card Number" required/>

	<label for = "medicareIssueDate"> Medicare Issue Date * </label>
	<input type = "date" id = "medicareIssueDate" name="medicareIssueDate" required />

	<label for = "medicareExpiryDate"> Medicare Expiry Date * </label>
	<input type = "date" id = "medicareExpiryDate" name="medicareExpiryDate" required />

	<button type = "submit" name = "insert" value = "insert"> Insert Value </button>


</form>

<?php

	if ($_POST != null && $_POST["insert"] != NULL)
	{
		$firstName = quote($_POST["firstName"]);
		$middleInitial = quote($_POST["middleInitial"]);
		$lastName = quote($_POST["lastName"]);
		$medicareCardNum = quote($_POST["medicareCardNum"]);
		$medicareIssueDate = quote($_POST["medicareIssueDate"]);
		$medicareExpiryDate = quote($_POST["medicareExpiryDate"]);

		$id = getPersonId($firstName, $middleInitial, $lastName, $conn);

		if ($id == null)
		{
			echo "<p> The name does match any person in our database. Please try again. </p>";
		}
		else
		{
			$insert = "
			INSERT INTO Registered (id, medicareCardNum, medicareIssueDate, medicareExpiryDate)
			VALUES($id, $medicareCardNum, $medicareIssueDate, $medicareExpiryDate);";

			if ($conn->query($insert) === TRUE) {
				echo "<p> Successfully registered the person!</p>";
			} else {
				echo "<p> Error: " . $insert . ": <br>" . $conn->error . "</p>";
			}
		}
	}
?>



<?php require("footer.php"); ?>