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

//create array of user's profile options and user info
$connection = db_connect();
$results1 = pg_execute($connection, "select_all_profile", array($_SESSION['username']));
$userProfileArray = pg_fetch_array($results1);

// profile data
$gender = getProperty('genders', 'gender_type', $userProfileArray["gender"], 'gender_id');
$gender_sought = getProperty('genders', 'gender_type', $userProfileArray["gender_sought"], 'gender_id');
$city = $userArray["city"];
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
$residence_type = $userProfileArray["residence_type"];
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

?>

<!-- HTML -->

<div class="w3-row">
  <div class="w3-third w3-container">
	<div class="w3-card-4">
		<header class="w3-container" style="background-color: #4A7C59;">
			<h3><?php echo($firstName . " " . $lastName);?></h3>
		</header>
		<img class="w3-image index" style="width:100%;" src="<?php echo($image) ?>" alt="" />
		<div class="w3-container w3-light-grey">
			<h4><b><?php echo($age . " Years Old");?></b></h4>
			<h4><b><?php echo($education_experience . " Educated");?></b></h4>
			<p><?php echo($headline);?></p>
			<p><?php echo($self_description);?></p>
		</div>
	</div>
  </div>
  <div class="w3-twothird w3-container"> 
	<div class="w3-card-4">
		<header class="w3-container"  style="background-color: #4A7C59;">
		<h3>Overview</h3>
		</header>
		<div class="w3-container w3-light-grey">
			<h4><b><?php echo($match_description);?></b></h4>
			<p>Looking For <?php echo($gender_sought . "s for " . $relationship_sought);?></p>
			<p>Currently <?php echo($relationship_status);?></p>
		</div>
	</div>
	<div class="w3-card-4">
	<header class="w3-container"  style="background-color: #4A7C59;">
	<h3>Lifestyle</h3>
	</header>
	<div class="w3-container w3-light-grey" style="margin-bottom:15%;" >
		<h5><b>Race: <?php echo($race);?></b></h5>
		<h5><b>Religion: <?php echo($religion_sought);?></b></h5>
		<h5><b>Exercise: <?php echo($exercise);?></b></h5>
		<h5><b>Habit: <?php echo($habits);?></b></h5>
	</div>
</div>
  </div>
</div>

<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>