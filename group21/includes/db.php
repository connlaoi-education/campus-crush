<?php
	// FILE FOR DATABASE CONNECTIVITY
	$filename = "db.php";
	$authors = "Connlaoi Smith";
	$createddate = "September 19 2017";
	$updateddate = "December 11 2017";

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
	pg_prepare($connection, "date_update", 'UPDATE users SET last_access = $2 WHERE id = $1');

	pg_prepare($connection, "find_user", 'SELECT id, password, first_name, last_name, email_address, account_type, enroll_date, last_access FROM users WHERE id = $1');
	
	pg_prepare($connection, "display_user", 'SELECT id, first_name, last_name, email_address, birthday FROM users WHERE id = $1');

	pg_prepare($connection, "select_id_pass", 'SELECT id, password, first_name, last_name, email_address, enroll_date, last_access FROM users WHERE id = $1 AND password = $2');

	pg_prepare($connection, "select_all_profile", 'SELECT * FROM profiles WHERE user_id = $1');

	pg_prepare($connection, "insert_profile", 'INSERT INTO profiles (user_id, gender, gender_sought, city, image, headline, self_description, match_description, relationship_sought, relationship_status, preferred_age_minimum, preferred_age_maximum, religion_sought, education_experience, race, habit, exercise, residence_type, campus) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17, $18, $19)');

	pg_prepare($connection, "insert_user", 'INSERT INTO users (id, password, first_name, last_name, email_address, account_type, birthday, enroll_date, last_access) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)');

	pg_prepare($connection, "check_interest", 'SELECT * FROM interests WHERE sender = $1 and target = $2');

	pg_prepare($connection, "check_offensive", 'SELECT * FROM offensives WHERE sender = $1 and target = $2');
	
	pg_prepare($connection, "update_profile", 'UPDATE profiles SET gender = $1, gender_sought = $2, city = $3, image = $4, headline = $5, self_description = $6, match_description = $7, relationship_sought = $8, relationship_status = $9, preferred_age_minimum = $10, preferred_age_maximum = $11, religion_sought = $12, education_experience = $13, race = $14, habit = $15, exercise = $16, residence_type = $17, campus = $18 WHERE user_id = $19');

	pg_prepare($connection, "insert_offensive", 'INSERT INTO offensives (sender, target, time_sent) VALUES ($1, $2, $3)');

	pg_prepare($connection, "insert_interest", 'INSERT INTO interests (sender, target, time_sent) VALUES ($1, $2, $3)');

	pg_prepare($connection, "remove_interest", 'DELETE FROM interests WHERE sender = $1 and target = $2');
	
	pg_prepare($connection, "update_account", 'UPDATE users SET account_type = $1 WHERE id = $2');
	
	pg_prepare($connection, "user_update", 'UPDATE users SET password = $1, first_name = $2, last_name = $3, email_address = $4  WHERE id = $5');
	
	pg_prepare($connection, "update_password", 'UPDATE users SET password = $1 WHERE id = $2');
	
	pg_prepare($connection, "update_email", 'UPDATE users SET email_address = $1 WHERE id = $2');
	
	pg_prepare($connection, "select_all_user_info", 'SELECT * FROM users WHERE first_name = $1');
	
	pg_prepare($connection, "select_user_image", 'SELECT * FROM images WHERE user_id = $1');
	
	pg_prepare($connection, "count_user_image", 'SELECT COUNT(*) FROM images WHERE user_id = $1');
	
	pg_prepare($connection, "insert_user_image", 'INSERT INTO images (user_id, image_address) VALUES ($1, $2)');
	
	pg_prepare($connection, "delete_user_image", 'DELETE FROM images WHERE image_id = $1');
	pg_prepare($connection, "get_main_image", 'SELECT image FROM profiles WHERE user_id = $1');

	pg_prepare($connection, "update_user_default_image", 'UPDATE profiles SET image = $1 WHERE user_id = $2');


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

	function buildCheckBox($name, $table, $property, $selected, $label)
	{
		$array = getAllProperty($table, $property);
		
		echo("<h2 style='text-align:center;'>" . $label . "</h2>");
		
		for ($i=1; $i < count($array)+1; $i++)
		{ 
			if(isBitSet($i, $selected))
			{
				echo("<label class=\"container\">" . $array[$i-1][$property]);
				echo("<input type=\"checkbox\" name=\"" .$name . "[]\" value=\"" . pow(2, $i) . "\" checked>");
				echo("<span class=\"checkmark\"></span></label>");

			}
			else
			{
				echo("<label class=\"container\">" . $array[$i-1][$property]);
				echo("<input type=\"checkbox\" name=\"" .$name . "[]\" value=\"" . pow(2, $i) . "\" >");
				echo("<span class=\"checkmark\"></span></label>");
			}
		}
	}
	
	function buildMapCheckBox($name, $table, $property, $selected, $enabled)
	{
		$array = getAllProperty($table, $property);
		
		if($enabled)
		{
			for ($i=1; $i < count($array)+1; $i++)
			{ 
				if(isBitSet($i, $selected))
				{
					echo("<label for=\"city" . $i . "\" class=\"container\">" . $array[$i-1][$property]);
					echo("<input type=\"checkbox\" name=\"" .$name . "[]\" value=\"" . pow(2, $i) . "\" onchange=\"filterMarkers();\" id=\"city" . $i . "\" checked />");
					echo("<span class=\"checkmark\"></span></label>");
					
					//echo("<label for=\"city" . $i . "\"><input type=\"checkbox\" name=\"" . $name . "[]\" value=\"" . pow(2, $i) . "\" onchange=\"filterMarkers();\" id=\"city" . $i . "\" checked>" . $array[$i-1][$property] . "</label>\n");
	
				}
				else
				{
					echo("<label for=\"city" . $i . "\" class=\"container\">" . $array[$i-1][$property]);
					echo("<input type=\"checkbox\" name=\"" .$name . "[]\" value=\"" . pow(2, $i) . "\" onchange=\"filterMarkers();\" id=\"city" . $i . "\" />");
					echo("<span class=\"checkmark\"></span></label>");
					
					//echo("<label for=\"city" . $i . "\"><input type=\"checkbox\" name=\"" . $name . "[]\" value=\"" . pow(2, $i) . "\" onchange=\"filterMarkers();\" id=\"city" . $i . "\"/>" . 	$array[$i-1][$property] . "</label>\n");
				}
			}
		}
		else
		{
			for ($i=1; $i < count($array)+1; $i++)
			{ 
				if(isBitSet($i, $selected))
				{
					echo("<label for=\"city" . $i . "\" class=\"container\">" . $array[$i-1][$property]);
					echo("<input type=\"checkbox\" name=\"" .$name . "[]\" value=\"" . pow(2, $i) . "\" onchange=\"filterMarkers();\" id=\"city" . $i . "\" checked disabled />");
					echo("<span class=\"checkmark\"></span></label>");
					
					//echo("<label for=\"city" . $i . "\"><input type=\"checkbox\" name=\"" . $name . "[]\" value=\"" . pow(2, $i) . "\" onchange=\"filterMarkers();\" id=\"city" . $i . "\" checked disabled>" . $array[$i-1][$property] . "</label>\n");
				}
				else
				{
					echo("<label for=\"city" . $i . "\" class=\"container\">" . $array[$i-1][$property]);
					echo("<input type=\"checkbox\" name=\"" .$name . "[]\" value=\"" . pow(2, $i) . "\" onchange=\"filterMarkers();\" id=\"city" . $i . "\" disabled />");
					echo("<span class=\"checkmark\"></span></label>");
					
					//echo("<label for=\"city" . $i . "\"><input type=\"checkbox\" name=\"" . $name . "[]\" value=\"" . pow(2, $i) . "\" onchange=\"filterMarkers();\" id=\"city" . $i . "\" disabled/>" . 	$array[$i-1][$property] . "</label>\n");
				}
			}
		}
	}

	function buildSearchResults($genders, $relationships, $religions, $cities, $page)
	{
		// do validation on input here eventually
		$connection = db_connect();
		/*$sql = "SELECT * FROM profiles, users WHERE profiles.gender = '" . $genders . "', profiles.religion_sought = '" . $religions . "', profiles.relationship_sought = '" . $relationships . "' ORDER BY users.last_access DESC LIMIT 200";*/

		$sql = "SELECT *
		FROM profiles, users 
		WHERE (profiles.user_id = users.id) AND users.account_type <> 'd' AND users.account_type <> 'i' AND";

		if(sizeof($genders) > 0)
		{
			$sql .= "(";
			$sumOfGenders = sumCheckBox($genders);
			for ($i=1; $i <= 3; $i++) { 
				if (isBitSet($i, $sumOfGenders)) {
					$sql .= "profiles.gender = '" . ($i-1) . "' OR ";
				}
			}
		}

		$sql = substr($sql, 0, -4) . ") AND ";

		if(sizeof($relationships) > 0)
		{
			$sql .= "(";
			$sumOfRelationships = sumCheckBox($relationships);
			for ($i=1; $i <= 5; $i++) { 
				if (isBitSet($i, $sumOfRelationships)) {
					$sql .= "profiles.relationship_sought = '" . ($i-1) . "' OR ";
				}
			}
		}

		$sql = substr($sql, 0, -4) . ") AND ";

		if(sizeof($religions) > 0)
		{
			$sql .= "(";
			$sumOfReligions = sumCheckBox($religions);
			for ($i=1; $i <= 10; $i++) { 
				if (isBitSet($i, $sumOfReligions)) {
					$sql .= "profiles.religion_sought = '" . ($i-1) . "' OR ";
				}
			}
		}

		$sql = substr($sql, 0, -4) . ") AND ";

		if(isset($_COOKIE["CityCookie"]))
		{
			$sql .= "(";
			$sumOfCities = sumCheckBox(unserialize($_COOKIE["CityCookie"]));
			for ($i=1; $i <= 6; $i++) { 
				if (isBitSet($i, $sumOfCities)) {
					$sql .= "profiles.city = '" . ($i-1) . "' OR ";
				}
			}
		}

		$sql2 = substr($sql, 0, -4) . ") ORDER BY users.last_access DESC LIMIT " . SEARCH_LIMIT . ";";
		define("results_per_page", 20);

		$results = pg_query($connection, $sql2);
		$userInfo = pg_fetch_all($results);
		$count = pg_num_rows($results);

		if(!isset($page))
		{
			$page=1;
		}

		$number_of_pages = ceil($count/results_per_page);
		if(isset($_SESSION["Searched"]))
		{
				$sql3 = substr($sql, 0, -4) . ") LIMIT " . results_per_page . " OFFSET " . 		results_per_page*($page-1);
				$results = pg_query($connection, $sql3);
				$userInfo = pg_fetch_all($results);
		}

		if($count == 1)
		{
			buildUserProfile($userinfo[0]["id"]);
		}

		elseif($count > 0)
		{
			echo("
					<table>
					");
						
			// FOR LOOP STARTS HERE
			//var_dump($userInfo);
			for($i=0; $i < count($userInfo); $i++)
			{
					
				$userName = strtolower($userInfo[$i]['id']);
				
				$age = calculate_Age($userInfo[$i]['birthday']);
				
				if($age == 0)
				{
					$age = "";
				}

				$sql = "SELECT * FROM profiles WHERE user_id = '" . $userInfo[$i]['user_id'] . "'";
				$results1 = pg_query($connection, $sql);
				$userProfiles = pg_fetch_all($results1);
				
				$name = ucwords($userInfo[$i]["first_name"]) ." ". ucwords($userInfo[$i]["last_name"]);
				$image = getProperty('images', 'image_address', $userProfiles[0]['image'], 'image_id');
				$gender = ucwords(getProperty('genders', 'gender_type', $userProfiles[0]['gender'], 'gender_id'));
				$city = ucwords(getProperty('cities', 'city_name', $userProfiles[0]['city'], 'city_id'));
				$relationship = ucwords(getProperty('relationships', 'relationship_type', $userProfiles[0]['relationship_sought'], 'relationship_id'));
				$religion = ucwords(getProperty('religions', 'religion_name', $userProfiles[0]['religion_sought'], 'religion_id'));
				
				if($_SESSION['account_type'] == CLIENT || $_SESSION['account_type'] == ADMIN)
				{
				echo("<tr class='w3-card w3-round' style='width:100%;>
								<td style='min-width:60%; max-width:80%; height:2%; padding-left:10%; padding-right:10%;'>\n
									<td style='height:100%; width:auto;'>
										<a href='profile-display.php?user=" . $userName . "'><img class='w3-animate-zoom hero-image w3-round' style='height:100px; width:100px; box-shadow: 3px 3px 3px #999;background-size: cover; position: relative;' src='" . $image . "'/></a>
									</td>\n
									<td style='height:100%; width:auto; text-align:left; padding-left:5px; color:#285C9B;'><h3>" . $name . "</h3></td>\n
									<td style='height:100%; width:auto; text-align:right; padding-left:5px;'><p>" . $relationship . "</p></td>\n
									<td style='height:100%; width:auto; text-align:right; padding-left:5px;'><p>" . $religion . "</p></td>\n
									<td style='height:100%; width:auto; text-align:right; padding-left:5px;'><p>" . $city . "</p></td>\n
									<td style='height:100%; width:auto; text-align:center; padding-left:5px;'><p>" . $gender . "</p></td>\n
									<td style='height:100%; width:auto; text-align:center; padding-left:5px;'><p>" . $age . "</p></td>\n
								</td>\n
							</tr>
						");
				}
				else
				{
				echo("<tr class='w3-card w3-round' style='width:100%;>
								<td style='min-width:60%; max-width:80%; height:2%; padding-left:10%; padding-right:10%;'>\n
									<td style='height:100%; width:auto;'>
										<a href='profile-display.php?user=" . $userName . "'>
									</td>\n
									<td style='height:100%; width:auto; text-align:left; padding-left:5px; color:#285C9B;'><h3>" . $name . "</h3></td>\n
									<td style='height:100%; width:auto; text-align:right; padding-left:5px;'><p>" . $city . "</p></td>\n
									<td style='height:100%; width:auto; text-align:center; padding-left:5px;'><p>" . $gender . "</p></td>\n
								</td>\n
							</tr>
						");
				}
			}
			// FOR LOOP ENDS HERE
			echo("</table>\n");
		echo("<div class=\"w3-center\">");
    echo("<div class=\"w3-bar\" text-align:center>");
    for ($page=1; $page <= $number_of_pages; $page++) { 
    	echo("<a href=\"" . $_SERVER['PHP_SELF'] . "?page=" . $page . "\" class=\"w3-button\">" . $page . "</a>");
    }
		
		echo("</div>");
		echo("</div>");
		}
		else
		{
			echo('<h3 style="text-align:center;">No users that fit that criteria <b> </b> exist on our site, Please try again!</h3>');
		}
    }
	
	function buildUserProfile($user)
	{
		// do validation on input here eventually
		$output = "header('Location:profile-display.php?user=$user');";
		return $output;
	}
	
	function buildPictureSelect($username, $mainImageID)
	{
		$connection = db_connect();
		$resImages = pg_execute($connection, "select_user_image", array($username));
		$dataArray = pg_fetch_all($resImages);
		echo("<table>\n");
		//create radio button for each picture
		echo("<tr>\n");
		?>
		<form action="setMain.php" method="get">
		<?php
		for ($i=0; $i < pg_num_rows($resImages); $i++) {
			if($dataArray[$i]["image_id"] == $mainImageID)
			{
				echo("<td align='center'>\n");
				echo("<input type='radio' name='mainImage' value='" . $dataArray[$i]["image_id"] . "' checked>\n");
				echo("</td>\n");
			}
			else
			{
				echo("<td align='center'>\n");
				echo("<input type='radio' name='mainImage' value='" . $dataArray[$i]["image_id"] . "'>\n");
				echo("</td>\n");
			}
		}
		?>
		<input type="hidden" name="main" value="main">
		<input class="btn" type="submit" style="width:200px;" value="Set Main Image" />
	</form>
		<?php
		echo("</tr>\n");

		//create image for each picture
		echo("<tr>\n");
		for ($i=0; $i < pg_num_rows($resImages); $i++) {
			echo("<td align='center'>\n");
			echo("<img style='max-width:260px; min-height:100px; max-height:150px; box-shadow:5px 5px 5px #999;' src='" . $dataArray[$i]["image_address"] . "'/>\n");
			echo("</td>\n");
		}
		echo("</tr>\n");

		
		
		?>
		<form action="deleteImages.php" method="get">
		<?php
		//create checkbox for each picture
		echo("<tr>\n");
		for ($i=0; $i < pg_num_rows($resImages); $i++) {
			echo("<td align='center'>\n");
			echo("<input type='checkbox' name='delImage[]' value='" . pow(2, $dataArray[$i]["image_id"]) . "'>\n");
			echo("</td>\n");
		}
		?>
		<input type="hidden" name="delete" value="delete" />
		<input class="btn" type="submit" style="width:200px;" value="Delete Checked Images" />
	</form>
		<?php
		echo("</tr>\n");
		echo("</table>\n");
	}

function buildUserImages($username)
    {
        $connection = db_connect();
        $resImages = pg_execute($connection, "select_user_image", array($username));
        $dataArray = pg_fetch_all($resImages);

        echo('<div class="w3-content w3-display-container" style="min-width: 300px;min-height: 150px;max-height: 200px;max-width: 500px;float: left;">');

        for ($i=0; $i < pg_num_rows($resImages); $i++)
        {
			$picnum = $i + 1;
			$imgAddress = $dataArray[$i]["image_address"];
            echo('<img class="mySlides" src="'.$imgAddress.'" style="max-width:400px;max-height:200px;" />');
        }

          echo('<div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
                <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
                <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>');

        for ($i=0; $i < pg_num_rows($resImages); $i++)
        {
                echo('<span class="w3-badge togs w3-border w3-transparent w3-hover-green" onclick="currentDiv('.$i.')"></span>');
        }
            echo('</div>
        </div>');
    }
?>