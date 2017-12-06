<!-- Page Info -->
<?php
	$title = "CC - City";
	$createddate = "September 19 2017";
	$updateddate = "October 20 2017";
	$filename = "profile-city-select.php";
	$banner = "Campus Crush";
	$description = "Select the Cities you wish to Search";
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
	
	// SELECT * FROM users WHERE first_name = 'carol';
		// create array from select statement
		// for each row in the array
			// create a new table row
				// create a new table div for each property value in the row
				// make the userid clickable -> redirect to profile-display using GET (?user=csmith) for sharing purposes
	
	$prompt = "<h3 style='text-align:center;'>Narrow your results to look someone up!</h3>";
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{ 
		if(isset($_COOKIE["Search"]["City"]))
		{
			header("Location: profile-search.php");
        }
		else
		{
			buildCheckBox("city", "cities", "city_name", $_COOKIE["Search"]["Cities"]);
		}
	}
	else if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		//buildImageMap(0);
	}
	else
	{
		echo($prompt);
	}
	
	echo('</form>'); // close the form

?>

<!-- HTML -->
<h3>Search for People - Old Friends, and New!</h3>
<p class="content"><?php echo $description; ?></p>

<hr />

<form class="w3-card w3-mobile" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

      <div class="w3-row">
        <?php buildCheckBox("city", "cities", "city_name", 0); ?>
		  <input class="w3-center" style="margin-top:10px; margin-left:25%; margin-right:25%; width:50%;" type="text" name="search" placeholder="Enter a first name..." />
		  <input style="margin-left:45%; margin-right:45%;" type="submit" value="Search" class="btn" />
	  </div>

<hr />

<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>