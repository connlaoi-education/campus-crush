<?php
	// FILE FOR DATABASE CONNECTIVITY
	$filename = "constants.php";
	$authors = "Connlaoi";
	
	$createddate = "September 19 2017";
	$updateddate = "xxxx xx 2017";
	
	// open a database connection
	function db_connect(){	
		// set the connection values
		// to change the host (local use: host=127.0.0.1) or (server use: host=??)
		$conn = pg_connect("host=127.0.0.1 dbname=group21_db user=smithc password=100483385");
		return $conn;
	}

?>