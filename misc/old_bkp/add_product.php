<?php  
	require_once('functions.php');
	if (isset($_POST['add'])) {

		$gref = $glabel = $gprice = '';
	
		if(isset($_POST['prod_ref'])) 
				$gref =  sanitizeMySQL($connection, $_POST['prod_ref']);

		if(isset($_POST['prod_label'])) 
				$glabel =  sanitizeMySQL($connection, $_POST['prod_label']);

		if(isset($_POST['prod_pu'])) 
				$gprice =  sanitizeMySQL($connection, $_POST['prod_pu']);

		$sql = "INSERT INTO Client VALUES (NULL, $gref, $glabel, $gprice)";
		echo $sql;
	
	}




?>
<!DOCTYPE html>
<html>
<head>
	<title>Add product</title>
	<meta charset="utf-8">
</head>
<body>
	<fieldset>
		<legend>New product</legend>
		<form method="post" action="add_client.php">
			<label for-"prod_ref">Reference </label>
			<input type="text" name="prod_ref" required><br><br>

			<label for-"prod_label">Designation </label>
			<input type="text" name="prod_label" required><br><br>

			<label for-"prod_pu">Prix unitaire </label>
			<input type="number" name="prod_pu"><br><br>

			<input type="submit" name="add" value="Ajouter">
		</form>
	</fieldset>
</body>
</html>