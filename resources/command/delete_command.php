<?php
	require_once('functions.php');
	$client_code = $_GET['clt_code'];
	$cmd_id = $_GET['cmd_id'];
	if ($client_code && $cmd_id) {
		if (!delete_command($client_code, $cmd_id))
			echo "<script> alert('delete failure !'); </script>";
		else
			echo "<script> location.href='../client/client_detail.php?id=".$client_code."'</script>";
	}
?>