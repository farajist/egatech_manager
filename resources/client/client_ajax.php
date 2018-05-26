<?php
	// require_once('functions.php');
	// encode_client();
	require_once('../utils.php');
	header('Content-type: application/json');
	$gid = $_GET['id'];
	// $gid = '001';
	$query_client = "SELECT * FROM Client WHERE client_code = '$gid';";
	$result = execute_query($query_client);
	$client_obj = $result->fetch_object();
	echo json_encode($client_obj);
	exit;
?>