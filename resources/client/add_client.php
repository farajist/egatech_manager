<?php  
	require_once('functions.php');
	$clt_code = $_POST['clt_code'];
	if (!add_client())
		echo "<script> alert('add failure !'); </script>";
	else
		echo "<script> location.href='../../public_html/index.php'</script>";
	
?>