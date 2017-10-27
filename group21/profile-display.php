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
$gender = $userProfileArray["gender"];
$gender_sought = $userProfileArray["gender_sought"];
$city = $userArray["city"];
$headline = $userProfileArray["headline"];
$self_description = $userProfileArray["self_description"];
$match_description = $userProfileArray["match_description"];
$relationship_sought = getProperty('relationships', 'relationship_type', $userProfileArray["relationship_sought"], 'relationship_id');
$relationship_status = getProperty('statuses', 'status_type', $userProfileArray["relationship_status"], 'status_id');
$preferred_age_minimum = $userProfileArray["preferred_age_minimum"];
$preferred_age_maximum = $userProfileArray["preferred_age_maximum"];
$religion_sought = $userProfileArray["religion_sought"];
$race = $userProfileArray["race"];
$education_experience = $userProfileArray["education_experience"];
$habits = $userProfileArray["habit"];
$exercise = $userProfileArray["exercise"];
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

$firstName = ucwords($userInfoArray['first_name']);

$lastName = ucwords($userInfoArray['last_name']);
	
$userName = strtoupper($userInfoArray['id']);

?>

<!-- HTML -->

<div class="w3-row">
  <div class="w3-third w3-container">
    <h2>Overview</h2> 
	<div class="w3-card-4">
		<img class="w3-image" style="width:100%; max-height:450px;" src="<?php echo($image) ?>" alt="" />
		<div class="w3-container">
			<h4><b><?php echo($firstName . " " . $lastName);?></b></h4>
			<p><?php echo($headline);?></p>
			<p><?php echo($self_description);?></p>
		</div>
	</div>
  </div>
  <div class="w3-twothird w3-container">
    <h2>Status</h2> 
	<div class="w3-card-4">
		<div class="w3-container">
			<h4><b><?php echo($match_description);?></b></h4>
			<p>Looking For <?php echo($relationship_sought);?></p>
			<p>Currently <?php echo($relationship_status);?></p>
		</div>
	</div>
  </div>
</div>

<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>