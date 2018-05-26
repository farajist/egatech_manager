<?php
	
	function encode_client() {
		if (isset($_GET['id'])) { 
			header('Content-type: application/json');
			$gid = $_GET['id'];
			$query_client = 'SELECT * FROM Client WHERE Client.client_code = $gid;';
			$result = execute_query($query_client);
			$client_obj = $result->fetch_object();
			echo json_encode($client_obj);
			exit;
		}
	}

?>