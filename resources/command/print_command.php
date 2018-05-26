<?php
	require_once('../facture/bill_gen.php');
	require_once('functions.php');
	require_once('../product/functions.php');
	require_once('../client/functions.php');
	echo generate_bill();
	
?>