<?php
	// FILE FOR DATABASE CONNECTIVITY
	$filename = "db.php";
	$authors = "Connlaoi";
	
	$createddate = "September 19 2017";
	$updateddate = "xxxx xx 2017";
	
	// open a database connection
	function db_connect(){	
		// set the connection values
		// to change the host switch between DATABASE_HOST_SERVER and DATABASE_HOST_LOCAL
		$conn = pg_connect("host=". DATABASE_HOST_SERVER . " dbname=" . DATABASE_NAME . " user=" . DATABASE_USER . " password=" . DATABASE_PASSWORD);
		return $conn;
	}

	function getProperty($table, $property, $id) {
		$connection = db_connect();
		$results = pg_prepare($connection, "get_property", "SELECT " . $property . " FROM " . $table . " WHERE id = $1");
		$results = pg_execute($connection, "get_property", array($id));
		return pg_fetch_result($results, 0, $property);
	}
?>