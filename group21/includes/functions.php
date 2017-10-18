<?php
	// FILE FOR GENERAL FUNCTIONS
	$filename = "functions.php";
	$authors = "Connlaoi";
	
	$createddate = "September 19 2017";
	$updateddate = "xxxx xx 2017";

	// display the footer copyright information
	function display_copyright() {
		// save copyright year and group name to string for output
		$footer_info = "&copy; " . date("Y") . " Connlaoi Smith, Jeremy Power, Minh Tri Ly"; 
		return $footer_info;
	}

	function isLoggedIn() {
		if(isset($_SESSION['username'])) {
			return true;
		}
		else {
			return false;
		}
	}
	
	// NEW STUFF HERE
?>