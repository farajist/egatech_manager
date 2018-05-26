<?php
	require_once( $_SERVER['DOCUMENT_ROOT']."/Egatech/resources/config.php");

	function get_css_res() {
		echo "\t<link rel=\"stylesheet\" href=\"".CSS_FOLDER."bootstrap.min.css\">\n";
		echo "\t<link rel=\"stylesheet\" href=\"".CSS_FOLDER."facture.css\">\n";
		echo "\t<link rel=\"stylesheet\" href=\"".CSS_FOLDER."simple-sidebar.css\">\n";
		echo "\t<link rel=\"stylesheet\" href=\"".CSS_FOLDER."topbar.css\">\n";

	}

	function get_js_res() {
		echo "\t<script src=\"".JS_FOLDER."jquery-3.2.1.min.js\"></script>\n";
    	echo "\t<script src=\"".JS_FOLDER."bootstrap.min.js\"></script>\n";
    	echo "\t<script src=\"".JS_FOLDER."searchbar.js\"></script>\n";
	}

	function get_img_res() {
		echo "\t<link rel=\"icon\" href=\"".IMG_FOLDER."logo.png\" sizes=\"32x32\" />\n";
	}

	function get_metadata() {
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\n";
		echo "\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
	}


	function execute_query($query) {
		global $connection;
		$result = $connection->query($query);
		if (!$result) die ($connection->error);
		return $result;
	}

	function sanistize_string($var)
	{
		$var = stripcslashes($var);
		$var = htmlentities($var);
		$var = strip_tags($var);
		return $var;
	}

	//Epuration des elements SQL 
	function sanitizeMySQL($cnx, $var)
	{
		$var = $cnx->real_escape_string($var);
		$var = sanistize_string($var);
		return $var;
	}
?>