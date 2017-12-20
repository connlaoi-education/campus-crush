<!-- Page Info -->
<?php
    $title = "CC - Home";
    $createddate = "September 19 2017";
    $updateddate = "xxxx xx 2017";
    $filename = "dashboard.php";
    $banner = "Campus Crush";
    $description = "Hello, Welcome!";
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

<p class="conetn" style="color:green;">
 <?php
	 if(isset($_SESSION["redirected"]))
	  {
		echo($_SESSION["redirected"]);
		unset($_SESSION["redirected"]);
	  }
  ?>
</p>
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
  if(isset($_SESSION["password_change"])) {
    echo("<p style=\"color: red\">"  . $_SESSION["password_change"] . "</p>");
  }
  ?></p>

<br />

<?php
$content = file_get_contents('http://loripsum.net/api'); // for testing
	
// if admin user
if($_SESSION["account_type"] == ADMIN)
{
	// LOAD ADMIN TOOLS
	header("Location:admin.php");
  ob_flush();
	
}

// if complete user
elseif($_SESSION["account_type"] == CLIENT)
{
	// LOAD USER DASHBOARD
	$firstName = trim(ucwords($_SESSION['first_name']));
	$lastName = trim(ucwords($_SESSION['last_name']));
	echo '<h2>Welcome back, ' . $firstName . ' ' . $lastName . '!</h2>';
	
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