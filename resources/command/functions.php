<?php 
	require_once('../utils.php');
	
	function get_commands($client_code) {
		global $connection;
		$client_id = get_client_id_from_code($client_code);
		$query = "SELECT cmd.cmd_id, cmd.client_id, cmd.pm_id, cmd.num_cmd, cmd.`date`, cmd.total_ht FROM Commande cmd, Client clt 
		WHERE cmd.client_id = $client_id;";
		$commands = array();
		if ($result = execute_query($query)) {
		    while ($row = $result->fetch_assoc()) {
			    $commands[$row['cmd_id']]['client_id'] = $row['client_id'];
			    $commands[$row['cmd_id']]['pm_id'] = $row['pm_id'];
			    $commands[$row['cmd_id']]['num_cmd'] = $row['num_cmd'];
			    $commands[$row['cmd_id']]['date'] = $row['date'];
			    $commands[$row['cmd_id']]['total_ht'] = $row['total_ht'];
		    }
		    $result->free();
		}
		return $commands;
	}

	function print_commands_table($clt_code, $commands) {
		$tbody_text = "<tbody>";
		foreach ($commands as $index => $value) {
			$tbody_text .= "<tr>";
			$tbody_text .= "<td> Commande N° ".$commands[$index]['num_cmd']." - ". $commands[$index]['date']."</td>";
			$tbody_text .= "<td><a href=\"../command/print_command.php?clt_code=".$clt_code."&cmd_id=".$index."\">Imprimer</a></td>";
			// $tbody_text .= "<td><a href=\"../command/delete_command.php?clt_code=".$clt_code."&cmd_id=".$index."\">Supprimer</a></td>";
			// $tbody_text .= '<td><button name="del_cmd" class="btn btn-danger" id="delete_clt" onclick="location.href=\'../command/delete_command.php?clt_code='.$clt_code.'&cmd_id='.$index.'\'"><span class="glyphicon glyphicon-remove"></span>  Supprimer</button></td>';
			$tbody_text .= '<td><button name="del_cmd" data-toggle="modal" data-clt_code="'.$clt_code.'" data-id="'.$index.'" class="btn btn-danger open_cmd_del_confirm"><span class="glyphicon glyphicon-remove"></span>  Supprimer</button></td>';
			$tbody_text .= "</tr>";
		}
		$tbody_text .= "</tbody>";
		return $tbody_text;
	}
	/*
	* shows the array of commands history for each client
	**/
	function show_commands($client_code) {
			$commands = get_commands($client_code);
			$body = print_commands_table($client_code, $commands);
	        $html_text  = <<<HTML
	        <div class="col-lg-12">
		        <h1>Commandes :</h1>
		        <div style="margin-left: 8%; border-left:5px solid orange; padding-left:5%;">
		        	<button class="btn btn-warning" id="btn_add_command">Nouvelle commande</button>
		            <h3><b>Historique :</b></h3>
		            <div class="table-responsive">
		  				<table class="table table-striped">
		  					{$body}
		  				</table>
					</div>
		        </div>
		    </div>
HTML;
	        
	        return $html_text;
		}

	function add_command_line($cmd_id, $prod_id, $cmdl_num, $qte) {
		// global $connection;
		
		$gcmd_id = $gprod_id = $gcmdline_num = $gqte = '';
		
		$gcmd_id = $cmd_id;
		$gprod_id = $prod_id;
		$gcmdline_num = $cmdl_num;
		$gqte = $qte;

		// $add_cmdl = "INSERT INTO CommandLine VALUES (NULL, $gcmd_id, $gprod_id, $gcmdline_num, $gqte)";
		// echo "add_comman_line : ".$add_cmdl."<br><br>";

		if (($gcmd_id == '') or ($gprod_id == '') or ($gcmdline_num == '') or ($gqte == '')) {
			// echo "<script> alert('CommandLine data are corrupt !'); </script>";
			return 0;
		}

		$add_cmdl = "INSERT INTO CommandLine VALUES (NULL, $gcmd_id, $gprod_id, $gcmdline_num, $gqte)";
		// echo "add_comman_line : ".$add_cmdl."<br><br>";
		execute_query($add_cmdl);
		// echo "<script> alert('CommandLine added successfully !'); </script>";
		return 1;
	}

	function get_client_id_from_code($clt_code) {
		$id_query = "SELECT client_id FROM Client clt WHERE clt.client_code = '$clt_code';";
		$result = execute_query($id_query);
		if ($result) {
			$row = $result->fetch_assoc();
			$result->free();
			return $row['client_id'];
		}
		return -1;
	}


	function add_command ($client_code, $pm_id, $cmd_num, $total_ht) {
		$gclient_id = $gpm_id = $gcmd_num = $gtotal_ht = '';

		$gclient_id = get_client_id_from_code($client_code);
		if ($gclient_id == -1)
			return 0;
		$gpm_id = $pm_id;
		$gcmd_num = $cmd_num;
		$gtotal_ht = $total_ht; //for now

		date_default_timezone_set('Europe/London');
		$gdate = date('Y-m-d H:i:s');
		
		//tempo =======
		// $add_cmd = "INSERT INTO Commande VALUES (NULL, $gclient_id, $gpm_id, $gcmd_num, '$gdate', $gtotal_ht)";
		// echo "add_command : ".$add_cmd."<br><br>";
		//========
		if (($gclient_id == '') or ($gpm_id == '') or ($gcmd_num == '') ) {  //TODO:or ($gtotal_ht == '') missing 
			// echo "<script> alert('Command data are corrupt !'); </script>";
			return 0;
		}

		$add_cmd = "INSERT INTO Commande VALUES (NULL, $gclient_id, $gpm_id, $gcmd_num, '$gdate', $gtotal_ht)";
		// echo "add_command : ".$add_cmd."<br><br>";
		$result = execute_query($add_cmd);
		return $result;
	}

	//Returns an assoc array 
	function get_payment_assoc() {
		$get_payment_query = "SELECT pm_id, pm_desc FROM PaymentMode;";
		if ($result = execute_query($get_payment_query)) {
			return $result;
		}
		return NULL;
	}

	//returns pms 
	function get_pms () {
		$result = get_payment_assoc();
		$pms = array();
		while ($row = $result->fetch_assoc())
			$pms[$row['pm_id']]['pm_desc'] = $row['pm_desc'];
		return $pms;
	}


	function get_payment_modes() {
		$options = "";
		if ($result = get_payment_assoc()) {
			while ($row = $result->fetch_assoc())
				$options .= "<option value=".$row['pm_id'].">".$row['pm_desc']."</option>\n";
			$result->free();
		}
		return $options;
	}

	function add_product($ref, $label, $price) {

		global $connection;
		
		$gref = $glabel = $gprice = '';
		
		$gref   =  sanitizeMySQL($connection, $ref);
		$glabel =  sanitizeMySQL($connection, $label);
		$gprice = $price;

		if (($glabel == '') or ($gprice <= 0))
			return 0;

		$add_prod = "INSERT INTO Product VALUES (NULL, '$gref', '$glabel', $gprice)";
		// echo "add_product : ".$add_prod."<br><br>";
		$result = execute_query($add_prod);
		return $result;
	}
	/**
	* adds a products and its corresponding commandLine 
	*	$pid, $cid and $cnum are taken from database, to make sure that
	*	correct ids are being inserted !
	*
	**/
	function add_products_cmdlines($pid, $cid, $cnum, $cmdl_num, $refs, $names, $prices, $qtes) {

		foreach ($names as $index => $name) {
			//when creating a product : create it's fellow commandline !?

			$label = $name;
			$ref = $refs[$index];
			$price = $prices[$index];
			$qte = $qtes[$index];

			if (!add_product($ref, $label, $price))
				return 0;
			if (!add_command_line($cid, $pid, $cmdl_num, $qte))
				return 0;
			++$pid;
		}
		return 1;
	}

	function get_last_id ($status_query) {
		if ($result = execute_query($status_query)) {
			$row = $result->fetch_assoc();
			$result->free();
			return $row['Auto_increment'];
		}
		return -1;
	}

	function get_last_product_id () {
		$status_query = "SHOW TABLE STATUS LIKE 'Product';";
		// echo "get_last_product_id : ".$status_query."<br><br>";
		return get_last_id($status_query);

	}

	function get_last_command_id ($client_code) {
		$client_id = get_client_id_from_code($client_code);
		$count_query = "SELECT max(cmd_id) AS maxcmdid FROM Commande cmd WHERE cmd.client_id = $client_id; ";
		if ($result = execute_query($count_query)) {
			$row = $result->fetch_assoc();
			$result->free();
			return $row['maxcmdid'];
		}
		return -1;
	}

	function get_command_line_count ($client_code) {
		$count_query = "SELECT COUNT(*) AS total FROM CommandLine cmdl, Commande cmd, Client clt WHERE cmd.client_id = clt.client_id AND cmd.cmd_id = cmdl.cmd_id AND clt.client_code = '$client_code';";
		// echo "get_command_count : ".$count_query."<br><br>";
		return get_count($count_query);
	}

	function get_command_count ($client_code) {
		$count_query = "SELECT COUNT(*) AS total FROM Commande cmd, Client clt WHERE cmd.client_id = clt.client_id
		AND clt.client_code = '$client_code';";
		// echo "get_command_count : ".$count_query."<br><br>";
		return get_count($count_query);
	}

	function get_count ($count_query) {
		if ($result = execute_query($count_query)) {
			$row = $result->fetch_assoc();
			return $row['total'];
		}
		return -1;
	}

	function calculate_total_ht($prod_prices, $prod_qtes) {
		$total = 0;
		foreach ($prod_prices as $index => $value) {
			$total += $prod_prices[$index] * $prod_qtes[$index];
		}
		return $total;
	}

	function save_command ($client_code) {
		global $connection;

		if (isset($_POST['confirm_cmd'])) {

			$prod_refs = $_POST['prod_ref'];
			$prod_names = $_POST['prod_name'];
			$prod_prices = $_POST['price'];
			$prod_qtes = $_POST['qte'];
			$pay_mode = $_POST['payment_mode'];

			$pid = get_last_product_id();
			// echo "The pid is = ".$pid."<br><br>";
			//Getting number of commands for a specific client_id
			$cnum = get_command_count($client_code);
			$cnum = (($cnum == -1) ? 0 : ++$cnum);

			//Getting count of commandlines for a specific client_id
			$cmdl_num = get_command_line_count($client_code);
			$cmdl_num = (($cmdl_num == -1) ? 0 : ++$cmdl_num);

			//calculate total ht here !

			$total_ht = calculate_total_ht($prod_prices, $prod_qtes);
			//add command first, reason is cmdl's foreing key constraint 
			if (!add_command ($client_code, $pay_mode, $cnum, $total_ht))
				// echo "<script> alert('Failed to add command !'); </script>";
				return 0;
			else 
				// echo "<script> alert('Command added successfully !'); </script>";
				return 1;

			$cid = get_last_command_id($client_code);
			// echo "The cid is = ".$cid."<br><br>"; 


			if (add_products_cmdlines($pid, $cid, $cnum, $cmdl_num, $prod_refs, $prod_names, $prod_prices, $prod_qtes))
				// echo "<script> alert('Inside save_command function : CommandLine and Products added successfully !'); </script>";
				return 1;
			 else 
			 	// echo "<script> alert('Inside save_command function : CommandLine and Products  data are corrupt !'); </script>";
			 	return 0;
		}
		//create command => done 
		//save products => done
		//create command line for each product => done
		//save comand line => done 
		//-> link command lines to command => done
	}

	function delete_command($clt_code, $cmd_id) {
		$clt_id = get_client_id_from_code($clt_code);
		$delete_query = "DELETE FROM Commande WHERE cmd_id = $cmd_id AND client_id = $clt_id;";
		echo $delete_query;
		if ($result = execute_query($delete_query)) {
			return $result;
		}
		return NULL;
	}
?>