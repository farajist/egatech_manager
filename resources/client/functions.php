<?php 
	require_once $_SERVER['DOCUMENT_ROOT']."/Egatech/resources/utils.php";

	function print_clients_links_list() {
		$clts = get_clients();
		echo show_linked_clients($clts);
	}

	function print_clients_normal_list() {
		$clts = get_clients();
		echo show_simple_clients($clts);
	}
	
	function show_linked_clients ($clients) {
		$text = '<ul class="live-search-list">';
		//FIXME: This sort changes the order of keys => GET recieved id is not the same as the one 
		// put here
		sort($clients);
		foreach ($clients as $key => $value) {
			//echo "Key is : ". print_r($key)."\t Values is : ".print_r($value); 
			$id = $key + 1; 
			$text .= "\t\t";
			$text .= '<li><a href='.DOMAIN.'/Egatech/resources/client/client_detail.php?id='.$value["client_code"].'>'.$value["client_code"].' - '.$value["client_name"].'</a></li>';
			$text .= "\n";
		}
		$text .= "</ul>";
		return $text;
	}

	function show_simple_clients ($clients) {
		$text = '<ul class="live-search-list">';
		sort($clients);
		foreach ($clients as $key => $value) {
			//echo "Key is : ". print_r($key)."\t Values is : ".print_r($value); 
			$id = $key + 1; 
			$text .= "\t\t";
			$text .= '<li>'.$value["client_code"].' - '.$value["client_name"].'</li>';
			$text .= "\n";
		}
		$text .= "</ul>";
		return $text;
	}


	function get_clients() {

		global $connection;
		$query = "SELECT client_id, client_code, client_name, address, phone, email FROM Client";
		$clients = array();
		if ($result = execute_query($query)) {
		    while ($row = $result->fetch_assoc()) {
			    $clients[$row['client_id']]['client_code'] = $row['client_code'];
			    $clients[$row['client_id']]['client_name'] = $row['client_name'];
			    $clients[$row['client_id']]['address'] = $row['address'];
			    $clients[$row['client_id']]['phone'] = $row['phone'];
			    $clients[$row['client_id']]['email'] = $row['email'];
		    }
		    $result->free();
		}
		return $clients;
	}

	function show_clients_list() {
		$html_text = '<!DOCTYPE html>
		<html>
		<head>
			<title>Subscribe to our website !</title>
			<link rel="stylesheet" type="text/css" href="lib/w3.css">
			<meta charset="utf-8">

		</head>
		<body>';
		$clts = get_clients();

		$html_text .= show_clients($clts);

		$html_text .= '</body></html>';
		return $html_text;
	}

	function get_client($gid) {
		global $connection;
		$clients = get_clients();
		foreach ($clients as $key => $detail) {
			if ($detail['client_code'] == $gid)
				return $clients[$key];
		}
		//return $clients[$gid];
	}

	function add_client() {
		global $connection;
		
		$gcode = $gname = $gaddress = $gphone = $gmail = '';
		
		if(isset($_POST['clt_code'])) 
			$gcode =  sanitizeMySQL($connection, $_POST['clt_code']);

		if(isset($_POST['clt_name'])) 
			$gname =  sanitizeMySQL($connection, $_POST['clt_name']);

		if(isset($_POST['clt_address'])) 
			$gaddress =  sanitizeMySQL($connection, $_POST['clt_address']);

		if(isset($_POST['clt_phone'])) 
			$gphone =  sanitizeMySQL($connection, $_POST['clt_phone']);

		if(isset($_POST['clt_email'])) 
			$gmail =  sanitizeMySQL($connection, $_POST['clt_email']);

		$add_clt = "INSERT INTO Client VALUES (NULL, '$gcode', '$gname', '$gaddress', '$gphone', '$gmail');";
		// echo $add_clt;
		$result = execute_query($add_clt);
		return $result;
	}

	function show_client_detail() {

		$id = $_GET['id'];

		$clt = get_client($id);
		if ($clt == NULL) {
			echo "<script> location.href='../404.html'</script>";
        }
        $link = DOMAIN."/Egatech/public_html/index.php";
        $logo = IMG_FOLDER."logo.png";
        $html_text  = <<<HTML
        <div class="col-lg-12">
        
        <a href="{$link}" ><img class="img-responsive" src="{$logo}" alt="logo" width="55%" height="10%" style="margin-left: 20%;"> </a>
        <h1>Client name : {$clt['client_name']}</h1>
        <div style="margin-left: 8%; border-left:5px solid orange; padding-left:5%;">
            <h3><b>Informations générals:</b></h3>
            <h5><u>Code client </u></h5><code>{$clt['client_code']}</code>
            <h5><u>Nom </u></h5><code>{$clt['client_name']}</code>
            <h5><u>Adresse </u></h5><code>{$clt['address']}</code>
            <h5><u>Email </u></h5><code>{$clt['email']}</code>
            <h5><u>Telephone </u></h5><code>{$clt['phone']}</code>
            <br>
            <button style="margin-left: 30%;margin-top: 30px;" type="button" class="btn btn-warning" id="myBtn" data-dismiss="modal">Modifier</button> 
            <button style="margin-left: 2%;margin-top: 30px;" type="button" name="del_btn" class="btn btn-danger" id="delete_clt"><span class="glyphicon glyphicon-remove"></span>  Supprimer</button>
        </div>
HTML;
        
        return $html_text;
	}
	
	function edit_client_data()
	{
		global $connection;

		$gnclt_code = $gnclt_name = $gnclt_address = $gnclt_mail = $gnclt_phone = '';

		if(isset($_POST['btn_edit']))
		{
			require_once('../utils.php');
			session_start();
			$gnclt_code = $_POST['nclt_code'];
			if(isset($_POST['nclt_name'])) 
				$gnclt_name =  sanitizeMySQL($connection, $_POST['nclt_name']);

			if(isset($_POST['nclt_address'])) 
				$gnclt_address =  sanitizeMySQL($connection, $_POST['nclt_address']);

			if(isset($_POST['nclt_mail'])) 
				$gnclt_mail =  sanitizeMySQL($connection, $_POST['nclt_mail']);

			if(isset($_POST['nclt_phone'])) 
				$gnclt_phone =  sanitizeMySQL($connection, $_POST['nclt_phone']);

			$update_query = "UPDATE Client SET client_name = '$gnclt_name', address = '$gnclt_address', 
							email = '$gnclt_mail', phone = '$gnclt_phone' WHERE client_code = '$gnclt_code';";
			
			// echo "Update query is : ".$update_query;
			$result = execute_query($update_query);
			if (!$result)
				echo "<script> alert('For some reason, updating client data failed !'); </script>";
			else 
				echo "<script> alert('Update success !'); </script>";
			echo "<script> location.href='client_detail.php?id=$gnclt_code'</script>";
		}
	}


	function get_last_clt_code() {
		$clts = get_clients();
		$last_code = 000;
		foreach ($clts as $key => $value) {
			if ($value['client_code'] > $last_code)
				$last_code = $value['client_code'];
		}
		// return '00'.($last_code+20);
		return sprintf("%03d", $last_code+1);

	}

	function delete_client($client_code) {
		$delete_query = "DELETE FROM Client WHERE client_code = $client_code; ";
		if ($result = execute_query($delete_query)) {
			return $result;
		}
		return NULL;
	}

	/**
	*
	* Encodes client as JSON data coming from database 
	*
	*@see client_detail.php
	**/
	function encode_client() {
		if (isset($_GET['id'])) { 
			header('Content-type: application/json');
			// $gid = $_GET['id'];
			$gid = '001';
			$query_client = "SELECT * FROM Client WHERE client_code = '$gid';";
			$result = execute_query($query_client);
			$client_obj = $result->fetch_object();
			echo json_encode($client_obj);
			return;
			// exit;
		}
	}


?>