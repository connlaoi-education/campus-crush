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

if(!isLoggedIn()) { 
  header("Location:user-login.php");
  ob_flush();
}
  ?>

<!-- HTML -->
<h3>Search for People - Old Friends, and New!</h3>
<p class="content"><?php echo $description; ?></p>

<hr />

<form class="w3-card w3-mobile" method="get" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

      <div class="w3-row">
		  <input class="w3-center" style="margin-top:10px; margin-left:25%; margin-right:25%; width:50%;" type="text" name="search" placeholder="Enter a first name..." />
		  <input style="margin-left:45%; margin-right:45%;" type="submit" value="Search" class="btn" />
	  </div>

<hr />

<?php
	
	// SELECT * FROM users WHERE first_name = 'carol';
		// create array from select statement
		// for each row in the array
			// create a new table row
				// create a new table div for each property value in the row
				// make the userid clickable -> redirect to profile-display using GET (?user=csmith) for sharing purposes

	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$input = $_GET["search"];
		
		if($input != "")
		{
			// add logic for user exists (count results array, == 0, display No Results prompt)
			buildSearchResults(strtolower(htmlspecialchars($input)));
		}
		else
		{
			echo('<h3 style="text-align:center;">Enter a <b>First Name</b> above to look someone up!</h3>');
		}
		echo('</form>');
	}
	else
	{
		echo('<h3 style="text-align:center;">Enter a <b>First Name</b> above to look someone up!</h3>');
		echo('</form>');
	}

?>

<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>