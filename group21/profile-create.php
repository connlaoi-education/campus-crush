<!-- Page Info -->
<?php
		$title = "Campus Crush - Create";
		$createddate = "September 19 2017";
		$updateddate = "xxxx xx 2017";
		$filename = "profile-create.php";
		$banner = "Campus Crush - Profile Creation";
		$description = "Define who you are - What makes you, you?";
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
<p class="content"><?php echo $description; ?></p>
<h3>
		Please Fill Out Your Details - Or We Cant Match You!
</h3>

<br />
<hr />
<?php
  $error = "";
	$error_2 = "";
	$results = "";
	$results2 = "";

	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
    if($_SESSION['account_type'] == INCOMPLETE) {
      //create empty variables for sticky form
      //0's for radio buttons and dropdowns (default index)
      $gender = "0";
      $gender_sought = "0";
      $city = "0";
      $image = "";
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
    else {
      //create array of user's profile options
      $results = pg_execute($connection, "select_all_profile", array($_SESSION['username']));
      $userArray = pg_fetch_array($results);

      //store them in variables to echo
      $gender = $userArray["gender"];
      $gender_sought = $userArray["gender_sought"];
      $city = $userArray["city"];
      $image = "";
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
    //retrieve variables from POST
		$gender = trim($_POST["gender"]);
		$gender_sought = trim($_POST["gender_sought"]);
		$city = trim($_POST["city"]);
		$image = 0;
		$headline = trim($_POST["headline"]);
		$self_description = trim($_POST["self_description"]);
		$match_description = trim($_POST["match_description"]);
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
        if($_SESSION['account_type'] == INCOMPLETE) {
			    $results = pg_execute($connection, "insert_profile", array($_SESSION['username'], $gender, $gender_sought, $city, 0, $headline, $self_description, $match_description, $relationship_sought, $relationship_status, $preferred_age_minimum, $preferred_age_maximum, $religion_sought, $education_experience, $race, $habits, $exercise, $residence_type, $campus));

        //complete their profile
				$results = pg_execute($connection, "update_account", array(CLIENT, $_SESSION['username']));
        $_SESSION['account_type'] = CLIENT;

        //otherwise, update
        } else {
          $results = pg_execute($connection, "update_profile", array($gender, $gender_sought, $city, 0, $headline, $self_description, $match_description, $relationship_sought, $relationship_status, $preferred_age_minimum, $preferred_age_maximum, $religion_sought, $education_experience, $race, $habits, $exercise, $residence_type, $campus));
        }
        header("Location: profile-create.php");
        ob_flush();
		}
	}
?>

<br />

<h2 class="highlight">
	<?php echo $error; ?>
  <?php  ?>
</h2>

<form name="input" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table>
		<tr>
			<?php $imageAddress = getProperty('images', 'image_address', 0, "image_id"); ?>
			
			<td>Image</td>
			<td><img style="height: 64px; width: 64px;" src="<?php echo($imageAddress); ?>"/></td>
			<td><button type="button">Browse</button></td>
		</tr>

		<tr>
			<td valign="top">Headline</td>
			<td ><input align="left" type="text" name="headline" value="<?php echo $headline; ?>"></input></td>
		</tr>

		<tr>
			<td valign="top">Self Description</td>
			<td ><textarea rows="4" cols="50" name="self_description"><?php echo $self_description; ?></textarea></td>
		</tr>

		<tr>
			<td valign="top">Match Description</td>
			<td><textarea rows="4" cols="50" name="match_description"><?php echo $match_description; ?></textarea></td>
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
			<td><input type="submit" value="Save" /></td>
		</tr>	
	</table>
</form>

<br />
<br />
<br />

<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>