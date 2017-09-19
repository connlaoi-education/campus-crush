<?php
	// FILE FOR DATABASE CONNECTIVITY
	$filename = "db.php";
	$authors = "Connlaoi";
	
	$createddate = "September 19 2017";
	$updateddate = "xxxx xx 2017";
	
	// open a database connection
	function db_connect(){	
		// set the connection values
		// to change the host (local use: host=127.0.0.1) or (server use: host=??)
		$conn = pg_connect("host="DATABASE_HOST_LOCAL "dbname="DATABASE_NAME "user="DATABASE_USER "password="DATABASE_PASSWORD);
		return $conn;
	}

?>