<?php
	require_once('functions.php');
	$client_id = $_POST['client_id'];
	// echo "save_command got id = ". $client_id." ";
	if ($client_id) {
		if (save_command($client_id))
			echo "<script> alert('Command added successfully !'); </script>";
		else
			echo "<script> alert('Failed to add command !'); </script>";
	echo "<script> location.href='../client/client_detail.php?id=".$client_id."'</script>";

	}
		
?>