<!-- Page Info -->
<?php
    $title = "Campus Crush - Dash";
    $createddate = "September 19 2017";
    $updateddate = "xxxx xx 2017";
    $filename = "dashboard.php";
    $banner = "Campus Crush - Dashboard";
    $description = "Hello";
?>

<!--
  Creator:      Jeremy Power
  Filename:    <?php echo $filename; ?>
  Created:      <?php echo $createddate; ?>
  Updated:     <?php echo $updateddate; ?>
  Description: <?php echo $description; ?>
-->

<!-- Include Header PHP -->
<?php 
include 'header.php';
require('mass-create-script.php');
	
if(!isLoggedIn()) { 
  header("Location:user-login.php");
  ob_flush();
}
  ?>


<!-- HTML -->
<p class="content"><?php 
  if(isset($_SESSION["message"])) {
    echo("<p>" . $_SESSION["message"] . "</p>");
    unset($_SESSION["message"]);
  }
   echo($_SESSION['output']);
  if(isset($_SESSION["profile_insert"])) {
    echo("<p>" . $_SESSION["profile_insert"] . "</p>");
  }
  ?></p>

<br />

<?php
	
// if admin user
if($_SESSION["account_type"] == ADMIN)
{
	// LOAD ADMIN TOOLS in tabs(?)
	echo "<h1>WELCOME TO THE ADMIN DASHBOARD</h1>";
			// for running 1000 users

		
	// Database Moderation (Delete Account, Send Password Reset Email,etc)


	// User Summaries (Graphs, Charts, etc)
	
}

// if complete user
elseif($_SESSION["account_type"] == CLIENT)
{
	// LOAD USER DASHBOARD
		echo "<h1>WELCOME TO THE USER DASHBOARD</h1>";
	// User Profile Picture
	// Account Summary (User & Profile Information grouped for efficiency)
	
}

// if incomplete user
elseif($_SESSION["account_type"] == INCOMPLETE)
{
	  	echo "<h1>PLEASE COMPLETE YOUR PROFILE</h1>";
	  // Redirect  incomplete profiles to profile creation
	  header("Location:profile-create.php");
}
?>

<br />



<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>