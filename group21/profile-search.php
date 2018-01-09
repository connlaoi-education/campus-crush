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
			<h3 class="profileCardHeader">Search for People - Old Friends, and New!</h3>
		</header>
		<div class="w3-row" style="padding-left:10%; padding-right:10%;">
<?php
		echo('<div class="w3-half">');
			echo('<div class="w3-card w3-row" style="height:250px; margin:0 5px 10px 5px;">');
		
		//if the city is set
		if(isset($_COOKIE["CityCookie"]))
		{
			echo("<h2 style='text-align:center;'>Cities</h2>");
			buildMapCheckBox("city", "cities", "city_name", sumCheckBox(unserialize($_COOKIE["CityCookie"])), false);
			echo("<br /><br />");
			echo('<a href="./profile-city-select.php" style="font-weight:bold; font-size:12pt; padding-left:30%;margin-bottom:10px; color:#73D45F;" class="w3-bar-item">Change City Selection</a>');
			$_COOKIE["CityCookie"];
		}
		else
		{
			header("Location:profile-city-select.php");
			$message .= "Please select at least one City before continuing.";
		}	
		
		echo('</div>');
		echo('<div class="w3-card w3-row" style="height:150px; margin:0 5px 10px 5px;">');
		
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
		
		echo('</div></div>');
		echo('<div class="w3-half">');
			echo('<div class="w3-card w3-row" style="height:250px; margin:0 5px 10px 5px;">');
		
			//build religion checkbox
			if(isset($_POST["religion"]))
			{
			  buildCheckBox("religion", "religions", "religion_name", sumCheckBox($_POST["religion"]), "Religions");
			}
			elseif(isset($_COOKIE['SearchCookie']) && isset(unserialize($_COOKIE["SearchCookie"])["religions"]))
			{
			  $array = unserialize($_COOKIE["SearchCookie"]);
			  buildCheckBox("religion", "religions", "religion_name", $array["religions"], "Religions");
			}
			else
			{
			  buildCheckBox("religion", "religions", "religion_name", 0, "Religions");
			}

		echo('</div>');
		echo('<div class="w3-card w3-row" style="height:150px; margin:0 5px 10px 5px;">');
		
			//build relationship checkbox
			if(isset($_POST["relationship"]))
			{
			  buildCheckBox("relationship", "relationships", "relationship_type", sumCheckBox($_POST["relationship"]), "Relationships");
			}
			elseif(isset($_COOKIE['SearchCookie']) && isset(unserialize($_COOKIE["SearchCookie"])["relationships"]))
			{
			  $array = unserialize($_COOKIE["SearchCookie"]);
			  buildCheckBox("relationship", "relationships", "relationship_type", $array["relationships"], "Relationships");
			}
			else
			{
			  buildCheckBox("relationship", "relationships", "relationship_type", 0, "Relationships");
			}
			
		echo('</div></div>');
		?>
		</div>
	</div>
	<div class="w3-row">
		<button style="margin-left:45%;" type="submit" class="btn">Search</button>
	</div>
<?php

    $input = "";
	
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
    	if(isset($_GET['page']))
    	{
    		$page = $_GET['page'];
    	}
    	else
    	{
    		$page = 1;
    	}
		if(isset($_SESSION["Searched"]))
		{
			buildSearchResults($_SESSION["gender"], $_SESSION["relationship"], $_SESSION["religion"], $_COOKIE["CityCookie"], $page);
		}
	}
	elseif($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	if(isset($_GET['page']))
    	{
    		$page = $_GET['page'];
    	}
    	else
    	{
    		$page = 1;
    	}
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
			$_SESSION["Searched"] = true;
		  $_SESSION["gender"] = $_POST["gender"];
		  $_SESSION["relationship"] = $_POST["relationship"];
		  $_SESSION["religion"] = $_POST["religion"];

		  buildSearchResults($_POST["gender"], $_POST["relationship"], $_POST["religion"], $_COOKIE["CityCookie"], $page);
		  
	}
?>

<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>