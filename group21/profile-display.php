<!-- Page Info -->
<?php
		$title = "Campus Crush";
		$createddate = "September 19 2017";
		$updateddate = "xxxx xx 2017";
		$filename = "profile-display.php";
		$banner = "Campus Crush";
		$description = "Displays a Users Profile Summary";
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

if(!isLoggedIn())
{ 
	header("Location:user-login.php");
	ob_flush();
}

elseif($_SERVER["REQUEST_METHOD"] == "GET")
{
	$input = $_GET["user"];
	
	if($input != "")
	{
		// add logic for user exists (count results array, == 0, display No Results prompt)
		
		//create array of user's profile options and user info
		$connection = db_connect();
		$results = pg_execute($connection, "select_all_profile", array($_GET['user']));
		$userProfileArray = pg_fetch_array($results);

		// profile data
		$gender = getProperty('genders', 'gender_type', $userProfileArray["gender"], 'gender_id');
		$gender_sought = getProperty('genders', 'gender_type', $userProfileArray["gender_sought"], 'gender_id');
		$city = getProperty('cities', 'city_name', $userProfileArray["city"], 'city_id');
		$headline = $userProfileArray["headline"];
		$self_description = $userProfileArray["self_description"];
		$match_description = $userProfileArray["match_description"];
		$relationship_sought = getProperty('relationships', 'relationship_type', $userProfileArray["relationship_sought"], 'relationship_id');
		$relationship_status = getProperty('statuses', 'status_type', $userProfileArray["relationship_status"], 'status_id');
		$preferred_age_minimum = $userProfileArray["preferred_age_minimum"];
		$preferred_age_maximum = $userProfileArray["preferred_age_maximum"];
		$religion_sought = getProperty('religions', 'religion_name', $userProfileArray["religion_sought"], 'religion_id');
		$race = getProperty('races', 'race_name', $userProfileArray["race"], 'race_id');
		$education_experience = getProperty('education', 'education_type', $userProfileArray["education_experience"], 'education_id');
		$habits = getProperty('habits', 'habit_type', $userProfileArray["habit"], 'habit_id');
		$exercise = getProperty('exercises', 'exercise_type', $userProfileArray["exercise"], 'exercise_id');
		$residence_type = getProperty('residences', 'residence_type', $userProfileArray["residence_type"], 'residence_id');
		$campus = $userProfileArray["campus"];
		$image = getProperty('images', 'image_address', $userProfileArray["image"], 'image_id');

		// do validation on input here eventually
		$sql = "SELECT * FROM users WHERE id = '" . strtolower($_GET['user']) . "'";
		$results = pg_query($connection, $sql);
		$userInfoArray = pg_fetch_array($results);

		// user data
		$username = $userInfoArray["id"];
		$birthday = $userInfoArray["birthday"];
		$strBday = date_create($birthday);
		$firstName = ucwords($userInfoArray['first_name']);
		$lastName = ucwords($userInfoArray['last_name']);
		$userName = strtoupper($userInfoArray['id']);
		$age = calculate_Age($userInfoArray["birthday"]);
	}
	else
	{
		echo('<h3 style="text-align:center;">Looking for someone?<b>Try again...</b></h3>');
	}
}
else
{
	//create array of user's profile options and user info
	$connection = db_connect();
	$results = pg_execute($connection, "select_all_profile", array($_SESSION['username']));
	$userProfileArray = pg_fetch_array($results);

	// profile data
	$gender = getProperty('genders', 'gender_type', $userProfileArray["gender"], 'gender_id');
	$gender_sought = getProperty('genders', 'gender_type', $userProfileArray["gender_sought"], 'gender_id');
	$city = $userProfileArray["city"];
	$headline = $userProfileArray["headline"];
	$self_description = $userProfileArray["self_description"];
	$match_description = $userProfileArray["match_description"];
	$relationship_sought = getProperty('relationships', 'relationship_type', $userProfileArray["relationship_sought"], 'relationship_id');
	$relationship_status = getProperty('statuses', 'status_type', $userProfileArray["relationship_status"], 'status_id');
	$preferred_age_minimum = $userProfileArray["preferred_age_minimum"];
	$preferred_age_maximum = $userProfileArray["preferred_age_maximum"];
	$religion_sought = getProperty('religions', 'religion_name', $userProfileArray["religion_sought"], 'religion_id');
	$race = getProperty('races', 'race_name', $userProfileArray["race"], 'race_id');
	$education_experience = getProperty('education', 'education_type', $userProfileArray["education_experience"], 'education_id');
	$habits = getProperty('habits', 'habit_type', $userProfileArray["habit"], 'habit_id');
	$exercise = getProperty('exercises', 'exercise_type', $userProfileArray["exercise"], 'exercise_id');
	$residence_type = getProperty('residences', 'residence_type', $userProfileArray["residence_type"], 'residence_id');
	$campus = $userProfileArray["campus"];
	$image = getProperty('images', 'image_address', $userProfileArray["image"], 'image_id');


	// do validation on input here eventually
	$sql = "SELECT id, first_name, last_name, birthday FROM users WHERE id = '" . $_SESSION['username'] . "'";
	$results = pg_query($connection, $sql);
	$userInfoArray = pg_fetch_array($results);

	// user data
	$username = $userInfoArray["id"];
	$birthday = $userInfoArray["birthday"];
	$strBday = date_create($birthday,"Month-Day-Y");

	$firstName = ucwords($userInfoArray['first_name']);

	$lastName = ucwords($userInfoArray['last_name']);
		
	$userName = strtoupper($userInfoArray['id']);

	$age = calculate_Age($userInfoArray["birthday"]);
}

?>

<!-- HTML -->
<?php
if ($_GET['user'] == $_SESSION['username']) {
echo("<h3>This is what your profile will look to other users!</h3>");
}
?>
<div class="w3-row">
  <div class="w3-third w3-container">
	<div class="w3-card-4">
		<header class="w3-container" style="background-color: #4A7C59;">
			<h3 class="profileCardHeader"><?php echo($firstName . " " . $lastName);?></h3>
		</header>
		<img class="w3-image w3-animate-zoom hero-image" style="width:auto; max-height:400px;" src="<?php echo($image) ?>" alt="" />
		<div class="w3-container w3-light-grey">
			<div class="w3-row">
<?php
$interestResult = pg_execute($connection, "check_interest", array($_SESSION['username'], $_GET['user']));
$interestResultCount = pg_num_rows($interestResult);


if ($_GET['user'] != $_SESSION['username'] && $_SESSION['account_type'] == CLIENT && $interestResultCount == 0) {
	echo('<form method="post" action="interested-add.php">');
	echo('<input type="hidden" name="interest_user" value="' . $_GET['user'] . '" />');
	echo('<input class="btn" type="submit" name="interested_in" value="Show Interest" />');
	echo('</form>');
}
elseif($interestResultCount > 0)
{
	echo('<form method="post" action="interested-remove.php">');
	echo('<input type="hidden" name="interest_user" value="' . $_GET['user'] . '" />');
	echo('<input class="btn" type="submit" name="interested_in" value="Unshow Interest" />');
	echo('</form>');
}
echo("\n");
$offensiveResult = pg_execute($connection, "check_offensive", array($_SESSION['username'], $_GET['user']));
$offensiveResultCount = pg_num_rows($offensiveResult);
$targetAccType = getProperty("users", "account_type", $_GET['user'], "id");

if ($_SESSION['account_type'] == ADMIN && $targetAccType != DISABLED)
{
	echo('<form method="post" action="deactivate.php">');
	echo('<input type="hidden" name="deactivate" value="' . $_GET['user'] . '" />');
	echo('<input class="btn" type="submit" name="deactivate_user" value="Deactivate User" />');
	echo('</form>');
}
elseif($_SESSION['account_type'] == ADMIN)
{
	echo('<form method="post" action="reactivate.php">');
	echo('<input type="hidden" name="reactivate" value="' . $_GET['user'] . '" />');
	echo('<input class="btn" type="submit" name="reactivate_user" value="Reactivate User" />');
	echo('</form>');
}
elseif($_SESSION['account_type'] == CLIENT && $_GET['user'] != $_SESSION['username'] && $offensiveResultCount == 0)
{
	echo('<form method="post" action="report.php">');
	echo('<input type="hidden" name="deactivate" value="' . $_GET['user'] . '" />');
	echo('<input class="btn" type="submit" name="deactivate_user" value="Report Profile" />');
	echo('</form>');
}
?>
</div>
			<h4><b><?php echo($age . " Year Old " . $race);?></b></h4>
			<h4><b><?php echo($education_experience . " Educated");?></b></h4>
			<p><?php echo($headline);?></p>
			<p><?php echo($self_description);?></p>
		</div>
	</div>
  </div>
  <div class="w3-twothird w3-container"> 
	<div class="w3-card-4">
		<header class="w3-container"  style="background-color: #4A7C59;">
		<h3 class="profileCardHeader">Overview</h3>
		</header>
		<div class="w3-container w3-light-grey">
			<h4><b><?php echo($match_description);?></b></h4>
			<p>Looking For <?php echo($gender_sought . "s between " . $preferred_age_minimum . " and " . $preferred_age_maximum . " for " . $relationship_sought);?></p>
			<p>Currently <?php echo($relationship_status);?></p>
		</div>
	</div>
	<div class="w3-card-4">
	<header class="w3-container"  style="background-color: #4A7C59;">
	<h3 class="profileCardHeader">Lifestyle</h3>
	</header>
	<div class="w3-container w3-light-grey" style="margin-bottom:15%;" >
		<h5><b><?php echo("Living at " . $residence_type . " in " . $city); ?></b></h5>
		<h5><b>Religion:</b> <?php echo($religion_sought);?></h5>
		<h5><b>Exercise:</b> <?php echo($exercise);?></h5>
		<h5><b>Habit:</b> <?php echo($habits);?></h5>
	</div>
</div>
  </div>
</div>

<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>