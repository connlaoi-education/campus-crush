<!-- Page Info -->
<?php
    $title = "Campus Crush - Dash";
    $createddate = "September 19 2017";
    $updateddate = "xxxx xx 2017";
    $filename = "dashboard.php";
    $banner = "Campus Crush - Dashboard";
    $description = "Hello, ";
	$userFirstName = ""
?>
<!--
  Creator:      Jeremy Power
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
$description .= getProperty('users','first_name',$_SESSION['username']);
  ?>


<!-- HTML -->
<p class="content"><?php 
  if(isset($_SESSION["message"])) {
    echo("<p>" . $_SESSION["message"] . "</p>");
    unset($_SESSION["message"]);
  }
   echo($_SESSION['output']);
  ?></p>
<p class="content"><?php 
  if(isset($_SESSION["profile_insert"])) {
	      echo("<p>" . $_SESSION["profile_insert"] . "</p>");

  ?></p>
<br />
<?php
// if admin user
if(getUserAccount('id', 'account_type') == 'a')
{
	// LOAD ADMIN TOOLS in tabs(?)
	
	// Database Moderation (Delete Account, Send Password Reset Email,etc)
	// User Summaries (Graphs, Charts, etc)
	
}

// if complete user
elseif(getUserAccount('id', 'account_type') == 'c')
{
	// LOAD USER DASHBOARD
	
	$content = file_get_contents('http://loripsum.net/api'); // for testing
	echo($content); // for testing
	
	// User Profile Picture
	// Account Summary (User & Profile Information grouped for efficiency)
	
}

// if incomplete user
elseif(getUserAccount('id', 'account_type') == 'i')
{
	  // Redirect  incomplete profiles to profile creation
	  header("Location:profile-create.php");
}
?>

<br />



<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>