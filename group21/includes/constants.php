<?php
	// FILE FOR DEFINED CONSTANTS
	$filename = "constants.php";
	$authors = "Connlaoi";
	
	$createddate = "September 19 2017";
	$updateddate = "xxxx xx 2017";

	
	// define the lengths of values for validation
	define(MINIMUM_ID_LENGTH, 5, false);
	define(MAXIMUM_ID_LENGTH, 20, false);
	define(MINIMUM_PASSWORD_LENGTH, 6, false);
	define(MAXIMUM_PASSWORD_LENGTH, 15, false);
	define(MAXIMUM_FIRST_NAME_LENGTH, 20, false);
	define(MAXIMUM_LAST_NAME_LENGTH, 30, true);
	define(MAXIMUM_EMAIL_LENGTH, 255, true);
	
	// define the user types
	define(ADMIN, 'a', true);
	define(CLIENT, 'c', true);
	define(INCOMPLETE, 'i', true);
	define(DISABLED, 'd', true);
	
	// define database connector values for BOTH local and server for easy swapping
	define(DATABASE_HOST_LOCAL, '127.0.0.1', false);
	define(DATABASE_HOST_SERVER, 'opentech2.durhamcollege.org', true);
	// define group database name
	define(DATABASE_NAME, 'group21_db', true);
	// define admin user and password
	define(DATABASE_USER, 'smithc', true);
	define(DATABASE_PASSWORD, '100483385', false);
	
?>