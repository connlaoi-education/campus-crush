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
	
	$connection = db_connect();
// <editor-fold>
	//SQL PREPARED STATEMENTS
	pg_prepare($connection, "date_update", 'UPDATE users SET last_access = current_date WHERE id = $1');

	pg_prepare($connection, "find_user", 'SELECT id, password, first_name, last_name, email_address, account_type, enroll_date, last_access FROM users WHERE id = $1');
	
	pg_prepare($connection, "display_user", 'SELECT id, first_name, last_name, email_address, birthday FROM users WHERE id = $1');

	pg_prepare($connection, "select_id_pass", 'SELECT id, password, first_name, last_name, email_address, enroll_date, last_access FROM users WHERE id = $1 AND password = $2');

	pg_prepare($connection, "select_all_profile", "SELECT user_id, gender, gender_sought, city, image, headline, self_description, match_description, relationship_sought, relationship_status, preferred_age_minimum, preferred_age_maximum, religion_sought, education_experience, race, habit, exercise, residence_type, campus FROM profiles WHERE user_id = $1");

	pg_prepare($connection, "insert_profile", 'INSERT INTO profiles (user_id, gender, gender_sought, city, image, headline, self_description, match_description, relationship_sought, relationship_status, preferred_age_minimum, preferred_age_maximum, religion_sought, education_experience, race, habit, exercise, residence_type, campus) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17, $18, $19)');

	pg_prepare($connection, "update_profile", "UPDATE profiles SET gender = $1, gender_sought = $2, city = $3, image = $4, headline = $5, self_description = $6, match_description = $7, relationship_sought = $8, relationship_status = $9, preferred_age_minimum = $10, preferred_age_maximum = $11, religion_sought = $12, education_experience = $13, race = $14, habit = $15, exercise = $16, residence_type = $17, campus = $18 WHERE user_id = $19");

	pg_prepare($connection, "update_account", 'UPDATE users SET account_type = $1 WHERE id = $2');
	
	
// <editor-fold>


//retrieves one piece of data from DB
	function getProperty($table, $property, $id, $idName) {
		$connection = db_connect();
		$sql = "SELECT " . $property . " FROM " . $table . " WHERE " . $idName . " = '" . $id . "'";
		$results = pg_query($connection, $sql);
		return pg_fetch_result($results, 0, $property);
	}

//retrieves a column of data as an array given the table and column name
	function getAllProperty($table, $property) {
		$connection = db_connect();
		$sql = "SELECT " . $property . " FROM " . $table;
		$results = pg_query($connection, $sql);
		return pg_fetch_all($results);
	}
		//creates a dropdown box given
		//$name - the name of the select object
		//$table - the table to retrieve data objects from
		//$property - the column to retrieve the values shown
		//$selected - the default option when created
    function buildDropDown($name, $table, $property, $selected) {
		
        $array = getAllProperty($table, $property);
		
        echo("<select name=\"" . $name . "\">\n");
		
        for ($i=0; $i < count($array); $i++) { 
		
            if ($selected == $i)
            {
                echo("<option value=\"" . $i . "\" selected>" . $array[$i][$property] . "</option>\n");
            }
			
            else
            {
                echo("<option value=\"" . $i . "\">" . $array[$i][$property] . "</option>\n");
            
            }
        }
        echo("</select>");
    }

		//creates radio buttons given
		//$name - the name of the radio buttons object
		//$table - the table to retrieve data objects from
		//$property - the column to retrieve the values shown
		//$selected - the default option when created
	function buildRadioButton($name, $table, $property, $selected) {
		
		$array = getAllProperty($table, $property);

		for ($i=0; $i < count($array); $i++) { 
			if ($selected == $i) 
			{
				echo("<input type=\"radio\" name=\"" . $name . "\" value=\"" . $i . "\" checked>" . $array[$i][$property] . "<br/>\n");
			} 
			else 
			{
				echo("<input type=\"radio\" name=\"" . $name . "\" value=\"" . $i . "\"/>" . $array[$i][$property] . "<br/>\n");
			}
		}
	}
	
	function buildSearchResults($search) {
		
		// do validation on input here eventually
		$connection = db_connect();
		$sql = "SELECT * FROM users WHERE first_name = '" . $search . "'";
		$results = pg_query($connection, $sql);
		$userIDs = pg_fetch_all($results);
		
		echo("
				<table style='width:100%; height:100%;'>
				
					<tr style='width:100%; height:0;'>
						<th style='height:100%; width:10%; text-align:left;'><h2></h2></th>
						<th style='height:100%; width:30%; text-align:left;'><h2></h2></th>
						<th style='height:100%; width:30%; text-align:left;'><h2></h2></th>
						<th style='height:100%; width:30%; text-align:left;'><h2></h2></th>
					</tr>
				");
					
		// FOR LOOP STARTS HERE
		
		for($i=0; $i < count($userIDs); $i++) {
			
			$firstName = ucwords($userIDs[$i]['first_name']);
			
			$lastName = ucwords($userIDs[$i]['last_name']);
				
			$userName = strtoupper($userIDs[$i]['id']);
			
			$sql = "SELECT image FROM profiles WHERE user_id = '" . $userIDs[$i]['id'] . "'";
			$results1 = pg_query($connection, $sql);
			$userProfiles = pg_fetch_all($results1);

			$image = getProperty('images', 'image_address', $userProfiles[0]['image'], 'image_id');
			
			echo("
					<tr style='width:100%; height:2%;'>\n
						<td style='height:100%; width:10%;'><img class='w3-animate-zoom' style='height:70px; width:70px; box-shadow: 5px 5px 5px #999;' src='" . $image . "'/></td>\n
						<td style='height:100%; width:30%; text-align:right; padding-left:5px;'><h3>" . $firstName . "</h3></td>\n
						<td style='height:100%; width:30%; text-align:left; padding-left:5px;'><h3>" . $lastName . "</h3></td>\n
						<td style='height:100%; width:30%; text-align:left; padding-left:5px;'><p class='content'>" . $userName . "</p></td>\n
					</tr>\n
					");
		}
		// FOR LOOP ENDS HERE
		echo("</table>\n");
    }
	
?>