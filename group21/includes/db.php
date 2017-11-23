<?php
	// FILE FOR DATABASE CONNECTIVITY
	$filename = "db.php";
	$authors = "Connlaoi";
	
	$createddate = "September 19 2017";
	$updateddate = "xxxx xx 2017";
	

	// open a database connection
	function db_connect()
	{	
		// set the connection values
		// to change the host switch between DATABASE_HOST_SERVER and DATABASE_HOST_LOCAL
		$conn = pg_connect("host=". DATABASE_HOST_SERVER . " dbname=" . DATABASE_NAME . " user=" . DATABASE_USER . " password=" . DATABASE_PASSWORD);
		return $conn;
	}
	
	$connection = db_connect();

	//SQL PREPARED STATEMENTS
	pg_prepare($connection, "date_update", 'UPDATE users SET last_access = current_date WHERE id = $1');

	pg_prepare($connection, "find_user", 'SELECT id, password, first_name, last_name, email_address, account_type, enroll_date, last_access FROM users WHERE id = $1');
	
	pg_prepare($connection, "display_user", 'SELECT id, first_name, last_name, email_address, birthday FROM users WHERE id = $1');

	pg_prepare($connection, "select_id_pass", 'SELECT id, password, first_name, last_name, email_address, enroll_date, last_access FROM users WHERE id = $1 AND password = $2');
	
	// which one is the required one
	pg_prepare($connection, "select_all_profile", 'SELECT * FROM profiles WHERE user_id = $1');

	pg_prepare($connection, "insert_profile", 'INSERT INTO profiles (user_id, gender, gender_sought, city, image, headline, self_description, match_description, relationship_sought, relationship_status, preferred_age_minimum, preferred_age_maximum, religion_sought, education_experience, race, habit, exercise, residence_type, campus) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17, $18, $19)');

	pg_prepare($connection, "insert_user", 'INSERT INTO users (id, password, first_name, last_name, email_address, account_type, birthday, enroll_date, last_access) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)');
	
	pg_prepare($connection, "update_profile", 'UPDATE profiles SET gender = $1, gender_sought = $2, city = $3, image = $4, headline = $5, self_description = $6, match_description = $7, relationship_sought = $8, relationship_status = $9, preferred_age_minimum = $10, preferred_age_maximum = $11, religion_sought = $12, education_experience = $13, race = $14, habit = $15, exercise = $16, residence_type = $17, campus = $18 WHERE user_id = $19');
	
	pg_prepare($connection, "update_account", 'UPDATE users SET account_type = $1 WHERE id = $2');
	
	pg_prepare($connection, "select_all_user_info", "SELECT * FROM users WHERE first_name = $1");


//retrieves one piece of data from DB
	function getProperty($table, $property, $id, $idName)
	{
		$connection = db_connect();
		$sql = "SELECT " . $property . " FROM " . $table . " WHERE " . $idName . " = '" . $id . "'";
		$results = pg_query($connection, $sql);
		return pg_fetch_result($results, 0, $property);
	}

//retrieves a column of data as an array given the table and column name
	function getAllProperty($table, $property)
	{
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
    function buildDropDown($name, $table, $property, $selected)
	{
		
        $array = getAllProperty($table, $property);
		
        echo("<select name=\"" . $name . "\">\n");
		
        for ($i=0; $i < count($array); $i++)
		{ 
		
            if ($selected == $i)
            {
                echo("<option value=\"" . $i . "\" selected='selected'>" . $array[$i][$property] . "</option>\n");
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
	function buildRadioButton($name, $table, $property, $selected)
	{
		
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
	
	function buildSearchResults($search)
	{
		
		// do validation on input here eventually
		$connection = db_connect();
		$sql = "SELECT * FROM users WHERE first_name = '" . $search . "'";
		$results = pg_query($connection, $sql);
		$userIDs = pg_fetch_all($results);
		$count = pg_num_rows($results);


		if($count > 0)
		{
			echo("
					<table>
					");
						
			// FOR LOOP STARTS HERE
			
			for($i=0; $i < count($userIDs); $i++) {
				
				$firstName = ucwords($userIDs[$i]['first_name']);
				
				$lastName = ucwords($userIDs[$i]['last_name']);
					
				$userName = strtoupper($userIDs[$i]['id']);
				$user = strtolower($userIDs[$i]['id']);
				
				$age = calculate_Age($userIDs[$i]['birthday']);
				
				if($age == 0)
				{
					$age = "";
				}
				
				$sql = "SELECT gender, image, campus FROM profiles WHERE user_id = '" . $userIDs[$i]['id'] . "'";
				$results1 = pg_query($connection, $sql);
				$userProfiles = pg_fetch_all($results1);

				$image = getProperty('images', 'image_address', $userProfiles[0]['image'], 'image_id');
				$gender = ucwords(getProperty('genders', 'gender_type', $userProfiles[0]['gender'], 'gender_id'));
				$campus = ucwords(getProperty('campuses', 'campus_name', $userProfiles[0]['campus'], 'campus_id'));
				
				echo("<tr class='w3-card w3-round' style='width:100%;>
								<td style='min-width:60%; max-width:80%; height:2%; padding-left:10%; padding-right:10%;'>\n
									<td style='height:100%; width:auto;'><a href='profile-display.php?user=" . $user . "'><img class='w3-animate-zoom hero-image w3-round' style='height:100px; width:100px; box-shadow: 3px 3px 3px #999;background-size: cover; position: relative;' src='" . $image . "'/></a></td>\n
									<td style='height:100%; width:auto; text-align:right; padding-left:5px;'><h3>" . $firstName . "</h3></td>\n
									<td style='height:100%; width:auto; text-align:left; padding-left:5px;'><h3>" . $lastName . "</h3></td>\n
									<td style='height:100%; width:auto; text-align:left; padding-left:5px;'><p>" . $gender . "</p></td>\n
									<td style='height:100%; width:auto; text-align:left; padding-left:5px;'><p>" . $age . "</p></td>\n
								</td>\n
							</tr>
						");
			}
			// FOR LOOP ENDS HERE
			echo("</table>\n");
		}
		else
		{
			echo('<h3 style="text-align:center;">No users named <b>' . $search . '</b> exist on our site, Please try again!</h3>');
		}
    }
	
	function buildUserProfile($user)
	{
		// do validation on input here eventually
		$output = "header('Location:profile-display.php?user=$user');";
		return $output;
	}
	
?>