<?php
	require_once('functions.php');

	$client_code = $_GET['client_code'];
	if ($client_code) {
		if (!delete_client($client_code))
			echo "<script> alert('delete failure !'); </script>";
		else
			echo "<script> location.href='../../public_html/index.php'</script>";
	}
?>