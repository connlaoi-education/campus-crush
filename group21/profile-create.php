<!-- Page Info -->
<?php
		$title = "CC - Profile";
		$createddate = "September 19 2017";
		$updateddate = "xxxx xx 2017";
		$filename = "profile-create.php";
		$banner = "Campus Crush";
		$description = "What makes you stand out? What are you looking for?";
?>
<!--
	Creator:      Connlaoi Smith
	Filename:    <?php echo $filename; ?>
	Created:      <?php echo $createddate; ?>
	Updated:     <?php echo $updateddate; ?>
	Description: <?php echo $description; ?>
-->

<!-- Include Header PHP -->
<?php include 'header.php';

if(!isLoggedIn()) { 
  header("Location:user-login.php");
  ob_flush();
}
?>

<!-- HTML -->

<h3>Define your Campus Presence</h3>
<p class="content"><?php echo $description; ?></p>

<?php
    $error = "";
	$error_2 = "";
	$results = "";
	$results2 = "";
	$completed = "";
	
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		if($_SESSION['account_type'] == INCOMPLETE)
		{
			//create empty variables for sticky form
			//0's for radio buttons and dropdowns (default index)
			$gender = "0";
			$gender_sought = "0";
			$city = "0";
			$imageID = "0";
			$imageAddress = "./images/users/default_user.jpg";
			$headline = "";
			$self_description = "";
			$match_description = "";
			$relationship_sought = "0";
			$relationship_status = "0";
			$preferred_age_minimum = "";
			$preferred_age_maximum = "";
			$religion_sought = "0";
			$race = "0";
			$education_experience = "0";
			$habits = "0";
			$exercise = "0";
			$residence_type = "0";
			$campus = "0";
		}
		else 
		{
			//create array of user's profile options
			$connection = db_connect();
			$results = pg_execute($connection, "select_all_profile", array($_SESSION['username']));
			$userArray = pg_fetch_array($results);

			//store them in variables to echo
			$gender = $userArray["gender"];
			$gender_sought = $userArray["gender_sought"];
			$city = $userArray["city"];
			$imageID = $userArray["image"];
			$imageAddress = getProperty('images', 'image_address', $userArray["image"], 'image_id');
			$headline = $userArray["headline"];
			$self_description = $userArray["self_description"];
			$match_description = $userArray["match_description"];
			$relationship_sought = $userArray["relationship_sought"];
			$relationship_status = $userArray["relationship_status"];
			$preferred_age_minimum = $userArray["preferred_age_minimum"];
			$preferred_age_maximum = $userArray["preferred_age_maximum"];
			$religion_sought = $userArray["religion_sought"];
			$race = $userArray["race"];
			$education_experience = $userArray["education_experience"];
			$habits = $userArray["habit"];
			$exercise = $userArray["exercise"];
			$residence_type = $userArray["residence_type"];
			$campus = $userArray["campus"];
		}
	}
	elseif($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//create array of user's profile options
		$connection = db_connect();
		$results = pg_execute($connection, "select_all_profile", array($_SESSION['username']));
		$userArray = pg_fetch_array($results);
		
		//retrieve variables from POST
		$gender = trim($_POST["gender"]);
		$gender_sought = trim($_POST["gender_sought"]);
		$city = trim($_POST["city"]);
		$imageID = trim($userArray["image"]);
		$defaultImage = DEFAULT_IMAGEID;
		$imageUpdate = getProperty('images', 'image_id', $_FILES["fileToUpload"]["tmp_name"], 'image_address');
		$imageAddress = getProperty('images', 'image_address', $userArray["image"], 'image_id');
		$headline = trim(htmlspecialchars($_POST["headline"]));
		$self_description = trim(htmlspecialchars($_POST["self_description"]));
		$match_description = trim(htmlspecialchars($_POST["match_description"]));
		$relationship_sought = trim($_POST["relationship_sought"]);
		$relationship_status = trim($_POST["relationship_status"]);
		$preferred_age_minimum = trim($_POST["preferred_age_minimum"]);
		$preferred_age_maximum = trim($_POST["preferred_age_maximum"]);
		$religion_sought = trim($_POST["religions"]);
		$race = trim($_POST["races"]);
		$education_experience = trim($_POST["education_experience"]);
		$habits = trim($_POST["habit"]);
		$exercise = trim($_POST["exercise"]);
		$residence_type = trim($_POST["residence_type"]);
		$campus = trim($_POST["campuses"]);
		
		if($error == "")
		{	
			$connection = db_connect();

			//if user is creating profile, insert
			if($_SESSION['account_type'] == INCOMPLETE)
			{
				$results1 = pg_execute($connection, "insert_profile", array($_SESSION['username'], $gender, $gender_sought, $city, $defaultImage, $headline, $self_description, $match_description, $relationship_sought, $relationship_status, $preferred_age_minimum, $preferred_age_maximum, $religion_sought, $education_experience, $race, $habits, $exercise, $residence_type, $campus));

				//complete their profile
				$results2 = pg_execute($connection, "update_account", array(CLIENT, $_SESSION['username']));
				//update their session/cookie
				$_SESSION['account_type'] = CLIENT;
			}
			//otherwise, update their profile
			else
			{
				$results3 = pg_execute($connection, "update_profile", array($gender, $gender_sought, $city, $imageID, $headline, $self_description, $match_description, $relationship_sought, $relationship_status, $preferred_age_minimum, $preferred_age_maximum, $religion_sought, $education_experience, $race, $habits, $exercise, $residence_type, $campus, $_SESSION['username']));
			}

		header("Location: profile-create.php");
		ob_flush();
		}
	}
?>

<hr />

<p class="highlight" style="color:red;">
	<?php echo($error); ?>
	<?php echo($error_2);
		  if(isset($_SESSION["redirected"]))
		  {
			echo($_SESSION["redirected"]);
			unset($_SESSION["redirected"]);
		  }
	  ?>
</p>
<p class="highlight" style="color:green;">
	<?php
		  echo($completed);
	?>
<br />

<form enctype="multipart/form-data" name="input" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
	<table>
		<tr>
			<td>Image</td>
			<td><img style="max-width:260px; min-height:100px; max-height:150px; box-shadow:5px 5px 5px #999;" src="<?php echo $imageAddress; ?>"/></td>
		</tr>
		<tr>
		<td></td>
		<td>
				<?php
			if($_SESSION['account_type'] != INCOMPLETE)
			{
				echo('<a href="./profile-images.php" style="font-weight:bold; font-size:12pt; padding-top:30%;margin-bottom:10px; color:#73D45F;" class="w3-bar-item">Update your Images</a>');
			}
		?>
		</td></tr>

		<tr>
			<td valign="top">Headline</td>
			<td ><input align="left" type="text" name="headline" maxlength="100" value="<?php echo htmlspecialchars($headline); ?>"></input></td>
		</tr>

		<tr>
			<td valign="top">Self Description</td>
			<td ><textarea rows="4" cols="25" name="self_description" maxlength="1000" ><?php echo htmlspecialchars($self_description); ?></textarea></td>
		</tr>

		<tr>
			<td valign="top">Match Description</td>
			<td><textarea rows="4" cols="25" name="match_description" maxlength="1000" ><?php echo htmlspecialchars($match_description); ?></textarea></td>
		</tr>

		<tr>
			<td>Gender</td>
			<td><?php  buildRadioButton("gender", "genders", "gender_type", $gender);?></td>
		</tr>

		<tr>
			<td valign="top">Gender Sought</td>
			<td><?php  buildRadioButton("gender_sought", "genders", "gender_type", $gender_sought);?></td>
		</tr>

		<tr>
			<td valign="top">City</td>
			<td><?php buildDropDown("city", "cities", "city_name", $city);?></td>
		</tr>

		<tr>
			<td valign="top">Residence</td>
			<td><?php buildDropDown("residence_type", "residences", "residence_type", $residence_type); ?></td>
		</tr>

		<tr>
			<td valign="top">Campus</td>
			<td><?php buildDropDown("campuses", "campuses", "campus_name", $campus); ?></td>
		</tr>

		<tr>
			<td valign="top">Relationship Sought</td>
			<td><?php buildDropDown("relationship_sought", "relationships", "relationship_type", $relationship_sought); ?></td>
		</tr>

		<tr>
			<td valign="top">Relationship Status</td>
			<td><?php buildDropDown("relationship_status", "statuses", "status_type", $relationship_status); ?></td>
		</tr>

		<tr>
			<td>Minimum Age</td>
			<td><input type="text" name="preferred_age_minimum" value="<?php echo $preferred_age_minimum; ?>" size="20" /></td>
		</tr>

		<tr>
			<td>Maximum Age</td>
			<td><input type="text" name="preferred_age_maximum" value="<?php echo $preferred_age_maximum; ?>" size="20" /></td>
		</tr>

		<tr>
			<td valign="top">Religion</td>
			<td><?php buildDropDown("religions", "religions", "religion_name", $religion_sought); ?></td>
		</tr>

		<tr>
			<td valign="top">Education</td>
			<td><?php buildDropDown("education_experience", "education", "education_type", $education_experience); ?></td>
		</tr>

		<tr>
			<td valign="top">Race</td>
			<td><?php buildDropDown("races", "races", "race_name", $race); ?></td>
		</tr>

		<tr>
			<td valign="top">Habits</td>
			<td><?php buildDropDown("habit", "habits", "habit_type", $habits); ?></td>
		</tr>

		<tr>
			<td valign="top">Exercise</td>
			<td><?php buildDropDown("exercise", "exercises", "exercise_type", $exercise); ?></td>
		</tr>

		<tr>
			<td></td>
			<td><input class="btn" type="submit" value="Save" /></td>
		</tr>	
	</table>
</form>

<br />
<br />
<br />

<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>