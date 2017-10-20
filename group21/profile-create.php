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
		Please Create your profile
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
		$gender = "";
		$gender_sought = "";
		$city = "";
		$image = "";
		$headline = "";
		$self_description = "";
		$match_description = "";
		$relationship_sought = "";
		$relationship_status = "";
		$preferred_age_minimum = "";
		$preferred_age_maximum = "";
		$religion_sought = "";
		$education_experience = "";
		$habits = "";
		$exercise = "";
		$residence_type = "";
		$campus = "";
		$account_type = CLIENT;
	}
	
	elseif($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$gender = trim($_POST["gender"]);
		$gender_sought = trim($_POST["gender_sought"]);
		$city = trim($_POST["city"]);
		$image = trim($_POST["image"]);
		$headline = trim($_POST["headline"]);
		$self_description = trim($_POST["self_description"]);
		$match_description = trim($_POST["match_description"]);
		$relationship_sought = trim($_POST["relationship_sought"]);
		$relationship_status = trim($_POST["relationship_status"]);
		$preferred_age_minimum = trim($_POST["preferred_age_minimum"]);
		$preferred_age_maximum = trim($_POST["preferred_age_maximum"]);
		$religion_sought = trim($_POST["religions"]);
		$education_experience = trim($_POST["education_experience"]);
		$habits = trim($_POST["habit"]);
		$exercise = trim($_POST["exercise"]);
		$residence_type = trim($_POST["residence_type"]);
		$campus = trim($_POST["campuses"]);
		$account_type = CLIENT;

	
	
	if($error == "")
		{	
				$connection = db_connect();
				
				$results = pg_prepare($connection, "insert_profile", 'INSERT INTO profiles (user_id, gender, gender_sought, city, image, headline, self_description, match_description, relationship_sought, relationship_status, preferred_age_minimum, preferred_age_maximum, religion_sought, education_experience, habit, exercise, residence_type, campus) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17, $18)');
			    $results = pg_execute($connection, "insert_profile", array($_SESSION['username'], $gender, $gender_sought, $city, $image, $headline, $self_description, $match_description, $relationship_sought, $relationship_status, $preferred_age_minimum, $preferred_age_maximum, $religion_sought, $education_experience, $habits, $exercise, $residence_type, $campus));
	            
				$_SESSION['profile_insert'] = "New profile insert";
				$results = pg_prepare($connection, "update_account", 'UPDATE users SET account_type = $1 WHERE id = $2');
				$results = pg_execute($connection, "update_account", array($account_type, $_SESSION['username']));
                $_SESSION['account_type'] = CLIENT;
                header("Location:dashboard.php");
				
				
				ob_flush();
                
		}
  }
	
?>
	<br />
	<h2 class="highlight">
		<?php echo $error; ?>
	</h2>
<!-- Will be changed if the function dropdown work -->
<form name="input" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table class="size1">
    <tr>
      <td valign="top">Gender:</td>
      <td>
		<?php  buildRadioButton("gender", "genders", "gender_type");?>
    </tr>
    <tr>
      <td valign="top">Gender Sought:</td>
      <td>
		<?php  buildRadioButton("gender_sought", "genders", "gender_type");?>
    </tr>
	<tr>
      <td valign="top">City:</td>
      <td>
	       <?php buildDropDown("city", "cities", "city_name");
         $imageAddress = getProperty('images', 'image_address', 0, "image_id"); ?>
    </tr>
    <tr>
      <td>Image</td>
      <td><img style="height: 64px; width: 64px;" src="<?php echo($imageAddress); ?>"/></td>
    </tr>
    <tr>
      <td></td>
      <td><button type="button">Browse</button></td>
    </tr>
    <tr>
	
    <tr>
      <td valign="top">Headline:</td>
      <td ><textarea rows="4" cols="50" name="headline">Enter text here...</textarea></td>
    </tr>
	
    <tr>
      <td valign="top">Self Description:</td>
      <td ><textarea rows="4" cols="50" name="self_description">Enter text here...</textarea></td>
    </tr>
    <tr>
      <td valign="top">Match Description:</td>
      <td><textarea rows="4" cols="50" name="match_description">Enter text here...</textarea></td>
    </tr>
		<tr>
      <td valign="top">Relationship Sought:</td>
      <td>
	<?php buildDropDown("relationship_sought", "relationships", "relationship_type"); ?>
    </tr>
    <tr>
		<tr>
      <td valign="top">Relationship Status:</td>
      <td>
	<?php buildDropDown("relationship_status", "statuses", "status_type"); ?>
    </tr>
    <tr>
		<tr>
      <td>Prefered age minimum</td>
      <td><input type="text" name="preferred_age_minimum" value="" size="20" /></td>
    </tr>
	
    <tr>
		<tr>
      <td>Prefered age maximum</td>
      <td><input type="text" name="preferred_age_maximum" value="" size="20" /></td>
        </tr>
    </tr>
	
		<tr>
      <td valign="top">Religion sought:</td>
      <td>
	<?php buildDropDown("religions", "religions", "religion_name"); ?>
    </tr>
    <tr>
		<tr>
      <td valign="top">Education experience:</td>
      <td>
    <?php buildDropDown("education_experience", "education", "education_type"); ?>
    </tr>
    <tr>
		<tr>
      <td valign="top">Habits:</td>
      <td>
    <?php buildDropDown("habit", "habits", "habit_type"); ?>

    </tr>
    <tr>
		<tr>
      <td valign="top">Exercise:</td>
      <td>
    <?php buildDropDown("exercise", "exercises", "exercise_type"); ?>
    </tr>
    <tr>
		<tr>
      <td valign="top">Residence type:</td>
      <td>
    <?php buildDropDown("residence_type", "residences", "residence_type"); ?>
    </tr>
    <tr>
		<tr>
      <td valign="top">Campus:</td>
      <td>
    <?php buildDropDown("campuses", "campuses", "campus_name"); ?>
    </tr>
    <tr>
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