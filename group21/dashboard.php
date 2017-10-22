<!-- Page Info -->
<?php
    $title = "Campus Crush - Dash";
    $createddate = "September 19 2017";
    $updateddate = "xxxx xx 2017";
    $filename = "dashboard.php";
    $banner = "Campus Crush - Dashboard";
    $description = "Hello, Welcome!";
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
  ?>


<!-- HTML -->
<p class="content"><?php 
  if(isset($_SESSION["message"])) {
    echo("<p>" . $_SESSION["message"] . "</p>");
    unset($_SESSION["message"]);
  }
   echo($_SESSION['output']);
   if(isset($_SESSION["output2"])) {
   echo($_SESSION['output2']);
   }
   $_SESSION["first"] = 1;
  if(isset($_SESSION["profile_insert"])) {
    echo("<p style=\"color: red\">"  . $_SESSION["profile_insert"] . "</p>");
    $_SESSION["first"] = 0;
  }
  ?></p>

<br />

<?php
$content = file_get_contents('http://loripsum.net/api'); // for testing
	
// if admin user
if($_SESSION["account_type"] == ADMIN)
{
	// LOAD ADMIN TOOLS in tabs(?)
	echo '<h2>ADMIN DASHBOARD</h2>';
	
	// Database Moderation (Delete Account, Send Password Reset Email,etc)
	// User Summaries (Graphs, Charts, etc)
	
}

// if complete user
elseif($_SESSION["account_type"] == CLIENT)
{
	// LOAD USER DASHBOARD
	echo '<h2>USER DASHBOARD</h2>';
	
	// User Profile Picture
	
	// Account Summary (User & Profile Information grouped for efficiency)
	
}

// if incomplete user
elseif($_SESSION["account_type"] == INCOMPLETE)
{
	  // Redirect  incomplete profiles to profile creation
	  header("Location:profile-create.php");
}
?>

<br />



<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>