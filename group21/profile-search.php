<!-- Page Info -->
<?php
	$title = "Campus Crush - Search";
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

<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table>
    <tr>
      <td style="padding-left:15%;"><input type="text" name="search" placeholder="Search for Friends, Crushes, etc..." size="45%" /></td>
      <td style="padding-right:15%;"><input class="btn" type="submit" value="Search" /></td>
    </tr>
  </table>

<hr />
<br />

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
			buildSearchResults(strtolower($input));
			echo('</form>');
		}
		else
		{
			echo('</form>');
			echo('<h3>Enter their <b>First Name</b> above to look them up!</h3>');
		}
	}

?>

<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>