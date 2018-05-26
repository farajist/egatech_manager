<?php

	define(DOMAIN, "http://faraji.dev.local");
	define(ROOT_DIR, DOMAIN."/Egatech/");
	define(PUBLIC_HTML_FOLDER, ROOT_DIR."public_html/");
	define(RESOURCES_FOLDER, ROOT_DIR."resources/");
	define(CSS_FOLDER, PUBLIC_HTML_FOLDER."css/");
	define(JS_FOLDER, PUBLIC_HTML_FOLDER."js/");
	define(IMG_FOLDER, PUBLIC_HTML_FOLDER."img/");




	$db_hostname = "localhost";
	$db_username = "root";
	$db_password = "CStar.hdb07_mysql";
	$db_database = "Egatech";

	$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	if($connection->connect_error) die($connection->connect_error);
?>