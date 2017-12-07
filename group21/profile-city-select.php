<!-- Page Info -->
<?php
  $title = "CC - Cities";
  $createddate = "December 4 2017";
  $updateddate = "xxxx xx 2017";
  $filename = "profile-city-select.php";
  $banner = "Campus Crush";
  $description = "Select at least one City to Continue";
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
// if the user is not logged in
if(!isLoggedIn()) { 
  header("Location:user-login.php");
  ob_flush();
}
?>

<form class="w3-card w3-mobile" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">


	<div class="w3-row">
	<?php
		if($_SERVER["REQUEST_METHOD"] == "GET")
		{
			if(isset($_COOKIE["CityCookie"]))
			{
				setcookie("CityCookie", "", time() - 3600);
			}
			
			buildMapCheckBox("city", "cities", "city_name", 0, "Cities");

		}
		elseif($_SERVER["REQUEST_METHOD"] == "POST")
		{
			//if cookie is not stored
			if(!isset($_COOKIE["CityCookie"]))
			{
				if(isset($_POST["city"]))
				{
				$search = sumCheckBox($_POST["city"]);
				setcookie("CityCookie", $search, time() + COOKIE_DURATION);
				header("Location:profile-search.php"); //redirect
				}
			}
			else
			{
				header("Location:profile-search.php"); //redirect
			}
		}
	?>
	</div>
	<div class="w3-row">
		<input style="margin-left:45%; margin-right:45%;" type="submit" value="Continue" class="btn" />
	</div>
	
<hr />


	</form>	

  
<?php include 'footer.php';?>