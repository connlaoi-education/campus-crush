<!-- Page Info -->
<?php
  $title = "CC - Admin";
  $createddate =  "December 04 2017";
  $updateddate = "December 11 2017";
  $filename = "admin.php";
  $banner = "Campus Crush";
  $description = "Change your Username, Password, First or Last Name, and Email";
?>
<!--
  Creator:      Connlaoi Smith
  Filename:    <?php echo $filename; ?>
  Created:      <?php echo $createddate; ?>
  Updated:     <?php echo $updateddate; ?>
  Description: <?php echo $description; ?>
-->

<!-- Include Header PHP -->
<?php include 'header.php'; ?>

	<?php
		
		if($_SESSION['account_type'] != ADMIN)
		{
			header("Location:index.php");
		}
		
		if(isset($_SESSION["admin_message"])) 
		{
			echo("<p style='color: green;'>"  . $_SESSION["admin_message"] . "</p>");
		}
		
		echo("<p style='color: red;'>"  . $_SESSION['output'] . "</p>");

/* 		require('mass-create-script.php');
		generateUsers();
		if(generateUsers())
		{
				echo '<h3>Success</h3>';
		}
		else
		{
				echo '<h3>Failure</h3>';
		}
			 */
		// Database Moderation (Delete Account, Send Password Reset Email,etc)
		// User Summaries (Graphs, Charts, etc)
	?>

<!-- Include Footer PHP -->
<?php include 'footer.php';?>