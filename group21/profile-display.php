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

	if(isset($_POST['deactivate']))
	{

	}
	if(isset($_POST['interest_user']))
	{
		
	}
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
if ($_GET['user'] != $_SESSION['username']) {
	echo('<form action="' . $_SERVER['PHP_SELF'] . '">');
	echo('<input type="hidden" name="interest_user" value="' . $_GET['user'] . '" />');
	echo('<input type="button" name="interested_in" value="Interested In" />');
}
if ($_SESSION['account_type'] == ADMIN) {
	echo('<form action="' . $_SERVER['PHP_SELF'] . '">');
	echo('<input type="hidden" name="deactivate" value="' . $_GET['user'] . '" />');
	echo('<input type="button" name="deactivate_user" value="Deactivate User" />');
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