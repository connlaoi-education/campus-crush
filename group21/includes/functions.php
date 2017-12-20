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

	function createPictureSelect($username) {
		$connection = db_connect();
		$results = pg_execute($connection, "select_user_image", array($username));
		$dataArray = pg_fetch_all($results);
		echo("<table>\n");

		//create radio button for each picture
		echo("<tr>\n");
		for ($i=0; $i < pg_num_rows($results); $i++) {
			echo("<td align='center'>\n");
			echo("<input type='radio' name='mainImage' value=" . $i . ">\n");
			echo("</td>\n");
		}
		echo("</tr>\n");

		//create image for each picture
		echo("<tr>\n");
		for ($i=0; $i < pg_num_rows($results); $i++) {
			echo("<td align='center'>\n");
			echo("<img style='max-width:260px; min-height:100px; max-height:150px; box-shadow:5px 5px 5px #999;' src='" . $dataArray[$i]["image_address"] . "'/>\n");
			echo("</td>\n");
		}
		echo("</tr>\n");

		//create checkbox for each picture
		echo("<tr>\n");
		for ($i=0; $i < pg_num_rows($results); $i++) {
			echo("<td align='center'>\n");
			echo("<input type='checkbox' name='delImage[]' value='" . pow(2, $i) . "'>\n");
			echo("</td>\n");
		}
		echo("</tr>\n");
		echo("</table>\n");
	}
	// NEW STUFF HERE
?>