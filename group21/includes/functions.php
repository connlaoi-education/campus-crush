<?php
	// FILE FOR GENERAL FUNCTIONS
	$filename = "functions.php";
	$authors = "Connlaoi";
	
	$createddate = "September 19 2017";
	$updateddate = "xxxx xx 2017";

	// display the footer copyright information
	function display_Copyright() {
		// save copyright year and group name to string for output
		$footer_info = "&copy; " . date("Y") . " Connlaoi Smith, Jeremy Power, Minh Tri Ly"; 
		return $footer_info;
	}
	
	// returns the users age as an integer based on registration birthdate
	function calculate_Age($birthdate) {
		//calculate age
		$age = date_diff(date_create($birthdate), date_create('now'))->y;
		return $age;
	}
	
	// NEW STUFF HERE
?>