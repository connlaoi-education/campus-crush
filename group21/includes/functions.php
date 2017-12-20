<?php
	// FILE FOR GENERAL FUNCTIONS
	$filename = "functions.php";
	$authors = "Connlaoi";
	
	$createddate = "September 19 2017";
	$updateddate = "xxxx xx 2017";

	// display the footer copyright information
	function display_copyright() {
		// save copyright year and group name to string for output
		$footer_info = "&copy; " . date("Y") . " Connlaoi Smith, Jeremy Power, Tri Minh Ly"; 
		return $footer_info;
	}

	    // returns the users age as an integer based on registration birthdate
    function calculate_Age($birthdate) {
        //calculate age
        $age = date_diff(date_create($birthdate), date_create('now'))->y;
        return $age;
    }

	function isLoggedIn() {
		if(isset($_SESSION['username'])) {
			return true;
		}
		else {
			return false;
		}
	}
	

	/*
		this function should be passed a integer power of 2, and any 
		decimal number,	it will return true (1) if the power of 2 is 
		contain as part of the decimal argument
	*/
	function isBitSet($power, $decimal) {
		if((pow(2,$power)) & ($decimal)) 
			return 1;
		else
			return 0;
	} 
	
	/*
		this function can be passed an array of numbers 
		(like those submitted as part of a named[] check 
		box array in the $_POST array).
	*/
	function sumCheckBox($array)
	{
		$num_checks = count($array); 
		$sum = 0;
		for ($i = 0; $i < $num_checks; $i++)
		{
		  $sum += $array[$i]; 
		}
		return $sum;
	}

	function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
	// NEW STUFF HERE
?>