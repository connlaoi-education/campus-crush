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
<h3>Search for People - Old Friends, and New!</h3>
<p class="content"><?php echo $description; ?></p>

<hr />

<form class="w3-card w3-mobile" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

	<div class="w3-row">
		<?php
		//if the city is set
		if(isset($_COOKIE["CityCookie"]))
		{
			echo('<a href="./profile-city-select.php" style="font-style:italic; font-size:10pt;" class="w3-bar-item ">Change your selected Cities</a>');
			$_COOKIE["CityCookie"];
		}
		else
		{
			header("Location:profile-city-select.php");
			$message .= "Please select at least one City before continuing.";
		}	
		
		//build gender checkbox
		if(isset($_POST["gender"]))
		{
		  buildCheckBox("gender", "genders", "gender_type", sumCheckBox($_POST["gender"]), "Genders");
		}
		elseif(isset($_COOKIE['SearchCookie']) && isset(unserialize($_COOKIE["SearchCookie"])["genders"]))
		{
		  $array = unserialize($_COOKIE["SearchCookie"]);
		  buildCheckBox("gender", "genders", "gender_type", $array["genders"], "Genders");
		}
		else
		{
		  buildCheckBox("gender", "genders", "gender_type", 0, "Genders");
		}

		//build relationship checkbox
		if(isset($_POST["relationship"]))
		{
		  buildCheckBox("relationship", "relationships", "relationship_type", sumCheckBox($_POST["relationship"]), "Relationship Sought");
		}
		elseif(isset($_COOKIE['SearchCookie']) && isset(unserialize($_COOKIE["SearchCookie"])["relationships"]))
		{
		  $array = unserialize($_COOKIE["SearchCookie"]);
		  buildCheckBox("relationship", "relationships", "relationship_type", $array["relationships"], "Relationship Sought");
		}
		else
		{
		  buildCheckBox("relationship", "relationships", "relationship_type", 0, "Relationship Sought");
		}

		//build religion checkbox
		if(isset($_POST["religion"]))
		{
		  buildCheckBox("religion", "religions", "religion_name", sumCheckBox($_POST["religion"]), "Religion");
		}
		elseif(isset($_COOKIE['SearchCookie']) && isset(unserialize($_COOKIE["SearchCookie"])["religions"]))
		{
		  $array = unserialize($_COOKIE["SearchCookie"]);
		  buildCheckBox("religion", "religions", "religion_name", $array["religions"], "Religion");
		}
		else
		{
		  buildCheckBox("religion", "religions", "religion_name", 0, "Religion");
		}
		?>
	</div>
	<div class="w3-row">
		<input style="margin-left:45%; margin-right:45%;" type="submit" value="Search" class="btn" />
	</div>
<hr />

<?php

    $input = "";
	
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$genderFromCookie = "";
	}
	elseif($_SERVER["REQUEST_METHOD"] == "POST")
    {
		 //gender index of cookie
		  if(isset($_POST["gender"]))
		  {
			$search["genders"] = sumCheckBox($_POST["gender"]);
		  }
		  else
		  {
			$search["genders"] = 0;
		  }
		  
		  //relationship index of cookie
		  if(isset($_POST["relationship"]))
		  {
			  $search["relationships"] = sumCheckBox($_POST["relationship"]);
		  }
		  else
		  {
			  $search["relationships"] = 0;
		  }

		  //religion index of cookie
		  if(isset($_POST["religion"]))
		  {
			$search["religions"] = sumCheckBox($_POST["religion"]);
		  } 
		  else 
		  {
			$search["religions"] = 0;
		  }

		  //build final cookie
		  setcookie("SearchCookie", serialize($search), time() + COOKIE_DURATION);
		  
		  //generate search results based on what is selected
		  buildSearchResults($search["genders"], $search["relationships"], $search["religions"]);
		  
		  
		  
		  
		  // TESTING PURPOSES
		  print_r(unserialize($_COOKIE["SearchCookie"]));
		  print($_COOKIE["CityCookie"]);
	}

?>

<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>