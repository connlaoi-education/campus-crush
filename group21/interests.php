<!-- Page Info -->
<?php
	$title = "CC - Search";
	$createddate = "September 19 2017";
	$updateddate = "October 20 2017";
	$filename = "profile-search.php";
	$banner = "Campus Crush";
	$description = "Find your Friends - Or your Crush";
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
?>

<!-- HTML -->
<form class="w3-mobile" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
	<div class="w3-card w3-round">
		<header class="w3-container" style="background-color: #4A7C59;">
			<h3 class="profileCardHeader">The one you are interest in</h3>
		</header>
		
<?php
		
$connection = db_connect();
//$sql = "SELECT * FROM profiles, users WHERE profiles.user_id = users.id";
$sql = "SELECT * FROM profiles JOIN users ON profiles.user_id = users.id WHERE profiles.user_id = 'jpower'";
$results = pg_query($connection, $sql);
$userInfo = pg_fetch_all($results);
echo('<div class="w3-row w3-border">');


		echo('<div class="w3-half">');
			echo('<div class="w3-card w3-row" style="height:250px; margin:0 5px 10px 5px;">');
			echo('<h3 class="profileCardHeader">Not interest</h3>');
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
		echo('</div>');
		echo('</div>');



$sql = "SELECT * FROM profiles JOIN users ON profiles.user_id = users.id WHERE profiles.user_id = 'lyminh99'";
$results = pg_query($connection, $sql);
$userInfo = pg_fetch_all($results);


//THE OTHER HALF
		echo('<div class="w3-half">');
echo('<div class="w3-card w3-row" style="height:250px; margin:0 5px 10px 5px;">');
			echo('<h3 class="profileCardHeader">Absolute Hate</h3>');
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
		echo('</div>');
		echo('</div>');
echo('</div>');

?>



<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>