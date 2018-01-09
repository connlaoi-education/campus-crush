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
  Created:     <?php echo $createddate; ?>
  Updated:     <?php echo $updateddate; ?>
  Description: <?php echo $description; ?>
-->

<!-- Include Header PHP -->
<?php include 'header.php';
 // Display and Manage Errors/Redirects/Success

	if(isset($error))
	{
		echo('<p class="highlight" style="color:red; font-weight:bold;">$error</p>');
		unset($error);
	}
	if(isset($error_2))
	{
		echo('<p class="highlight" style="color:red; font-weight:bold;">$error_2</p>');
		unset($error_2);
	}
	if(isset($_SESSION["redirected"]))
	{
		echo('<p class="highlight" style="color:red; font-weight:bold;">$_SESSION["redirected"]</p>');
		unset($_SESSION["redirected"]);
	}
	if(isset($completed))
	{
		echo('<p class="highlight" style="color:green;">' . $completed . '</p>');
		unset($completed);
	}

	// If the current session is NOT an admin
	if($_SESSION['account_type'] != ADMIN)
	{
		//Redirect to the home page w/ error message
		$_SESSION['redirected'] = 'Restricted Access - If you should have access to this page contact your system admin!';
		header("Location:index.php");
	}

	// Database Moderation (Delete Account, Send Password Reset Email,etc)
	// User Summaries (Graphs, Charts, etc)
?>

<!-- Offensive User Management -->

<div class="w3-card">

	<header class="w3-container" style="background-color: #4A7C59;">
		<h2 class="profileCardHeader" style="color:#73D45F;text-shadow:1px 1px 0 #444;"><?php echo($_SESSION["admin_message"]); ?></h2>
	</header>

	<div class="tab">
		<button class="tablinks w3-button w3-hover-blue" style="background-color:#285C9B; color:snow;" onclick="openTool(event, 'offensive')">Offensive</button>
		<button class="tablinks w3-button w3-hover-blue" style="background-color:#285C9B; color:snow;" onclick="openTool(event, 'disabled')">Disabled</button>
		<button class="tablinks w3-button w3-hover-blue" style="background-color:#285C9B; color:snow;" onclick="openTool(event, 'log')" id="defaultTab" >Change Log</button>
	</div>

	<div id="offensive" class="tabcontent">
		<h3>Offensive Accounts</h3>
		<p>--- User Cards here ---</p>
		<!-- load offensive users -->
		<?php // buildOffensiveUsers(); ?>
	</div>

	<div id="disabled" class="tabcontent">
		<h3>Disabled Accounts</h3>
		<p>--- User Cards here ---</p>
		<!-- load disabled users -->
		<?php // buildDisabledUsers(); ?>
	</div>

	<div id="log" class="tabcontent">
		<h3>Change Log</h3>
		<!-- Display the Last Login timestamp -->
		<p style='display:inline-block; color:#285C9B;'>Last Login:</p>
		&nbsp;
		<p style='display:inline-block; color:green;'><?php echo($_SESSION['output']); ?></p>
		<!-- Load admin change log -->
		<?php // buildChangeLog(); ?>
	</div>

</div>

<script>
function openTool(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
	
}
// Get the element with id="defaultTab" and click on it
document.getElementById("defaultTab").click();
</script>

<!-- Include Footer PHP -->
<?php include 'footer.php';?>