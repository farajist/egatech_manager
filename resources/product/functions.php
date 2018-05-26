<?php

	require_once $_SERVER['DOCUMENT_ROOT']."/Egatech/resources/utils.php";

	function get_command_products($cmd_id) {
		global $connection;
		$query = "SELECT p.product_id, product_ref, designation, unit_price FROM Product p, CommandLine cl
		WHERE p.product_id = cl.product_id AND cl.cmd_id = $cmd_id;";
		$products = array();
		if ($result = execute_query($query)) {
		    while ($row = $result->fetch_assoc()) {
			    $products[$row['product_id']]['product_ref'] = $row['product_ref'];
			    $products[$row['product_id']]['designation'] = $row['designation'];
			    $products[$row['product_id']]['unit_price'] = $row['unit_price'];
		    }
		    $result->free();
		}
		return $products;
	}

	function get_command_commandlines ($cmd_id) {
		global $connection;
		$query = "SELECT cmd_line_id, product_id, cmd_line_num, qte FROM CommandLine cl, Commande cmd WHERE cl.cmd_id = cmd.cmd_id AND cmd.cmd_id = '$cmd_id';";
		$cmdlines = array();
		if ($result = execute_query($query)) {
		    while ($row = $result->fetch_assoc()) {
			    $cmdlines[$row['cmd_line_id']]['product_id'] = $row['product_id'];
			    $cmdlines[$row['cmd_line_id']]['cmd_line_num'] = $row['cmd_line_num'];
			    $cmdlines[$row['cmd_line_id']]['qte'] = $row['qte'];
		    }
		    $result->free();
		}
		return $cmdlines;
	}

	function get_product_cmdline($cmd_id, $prod_id) {
		$cmdlines = get_command_commandlines($cmd_id);
		foreach ($cmdlines as $cmd_id => $data) {
			if ($data['product_id'] == $prod_id)
				return $data;
		}
		return NULL;
	}

	function print_bill_products ($cmd_id) {
		$products = get_command_products($cmd_id);
		// echo count($products); 
		$products_tbody = "<tbody>";
		foreach ($products as $index => $value) {
			$cmdline = get_product_cmdline($cmd_id, $index);
			$products_tbody .= "<tr>";
			$products_tbody .= "<td>".$products[$index]['product_ref']."</td>";
			$products_tbody .= "<td>".$products[$index]['designation']."</td>";
			$products_tbody .= "<td>".$cmdline['qte']."</td>";
			$products_tbody .= "<td>".$products[$index]['unit_price']."</td>";
			$products_tbody .= "<td>".$products[$index]['unit_price']*$cmdline['qte']."</td>";
			$products_tbody .= "</tr>";
		}
		//removed cuz added later in rendering function
		// $products_tbody .= "</tbody>";
		return $products_tbody;
	}


?>