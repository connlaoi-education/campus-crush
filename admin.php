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

	// If the current session is NOT an admin
	if($_SESSION['account_type'] != ADMIN)
	{
		//Redirect to the home page w/ error message
		$_SESSION['redirected'] = 'Restricted Access - If you should have access please contact your system admin!';
		header("Location:index.php");
	}

	// Display and Manage Errors/Redirects/Success
	if(isset($_SESSION["error"]))
	{
		echo('<p class="highlight" style="color:red; font-weight:bold;">$_SESSION["error"]</p>');
		unset($_SESSION["error"]);
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

	// Database Moderation (Delete Account, Send Password Reset Email,etc)
	// User Summaries (Graphs, Charts, etc)
?>

<!-- Offensive User Management -->

<div class="w3-card" style="width:80%;margin:0 10% 0 10%;">

	<header class="w3-container" style="background-color: #4A7C59;">
		<h2 class="profileCardHeader" style="color:#73D45F;text-shadow:1px 1px 0 #444;"><?php echo($_SESSION["admin_message"]); ?></h2>
	</header>

	<div class="tab" style="width:100%; padding:0 5% 0 5%;">
		<button class="tablinks w3-button w3-blue-gray w3-hover-blue" style="width:33.333%;" onclick="openTool(event, 'log')" id="defaultTab" >Change Log</button>
		<button class="tablinks w3-button w3-blue-gray w3-hover-blue" style="width:33.333%;" onclick="openTool(event, 'offensive')">Offensive</button>
		<button class="tablinks w3-button w3-blue-gray w3-hover-blue" style="width:33.333%;" onclick="openTool(event, 'disabled')">Disabled</button>
	</div>

	<div id="offensive" class="tabcontent">
		<h3>Offensive Accounts</h3>
		<p>--- User Cards here ---</p>
		<!-- load offensive users -->
		
		<?php
		// Assign Execution Values for Change Log
		if(isset($admin_id) && isset($timestamp)&& isset($id_affected) && isset($changes))
		{
			$admin_id = $_SESSION['username'];
			$timestamp = $_SESSION['username'];
			$id_affected = $_POST['user'];
			$changes = $_SESSION['changes'];
			// double check for null values
			if($admin_id != "" && $timestamp != "" && $id_affected != "" && $changes != "")
			{
				// update DB change log
				$connection = db_connect();
				$results = pg_execute($connection, "log_changes", array($admin_id, $timestamp, $id_affected, $changes));
			}
			else // display error for missing data
			{
				$_SESSION['error'] = "There was an error logging your changes! This event may not be trackable in the future.";
			}
		}
		else
		{
			// display the list of offensive users
			// buildOffensiveUsers();
		}
		?>	
	</div>

	<div id="disabled" class="tabcontent">
		<h3>Disabled Accounts</h3>
		<p>--- User Cards here ---</p>
		<!-- load disabled users -->
		<?php
		// Assign Execution Values for Change Log
		if(isset($admin_id) && isset($timestamp)&& isset($id_affected) && isset($changes))
		{
			$admin_id = $_SESSION['username'];
			$timestamp = $_SESSION['username'];
			$id_affected = $_POST['user'];
			$changes = $_SESSION['changes'];
			// double check for null values
			if($admin_id != "" && $timestamp != "" && $id_affected != "" && $changes != "")
			{
				// update DB change log
				$connection = db_connect();
				$results = pg_execute($connection, "log_changes", array($admin_id, $timestamp, $id_affected, $changes));
			}
			else // display error for missing data
			{
				$_SESSION['error'] = "There was an error logging your changes! This event may not be trackable in the future.";
			}
		}
		else
		{
			// display the list of disabled users
			// buildDisabledUsers();
		}
		?>
	</div>

	<div id="log" class="tabcontent">
		<h3>Change Log</h3>
		<!-- Display the Last Login timestamp -->
		<p style='display:inline-block; color:#285C9B;'>Last Login:</p>&nbsp;<p style='display:inline-block; color:green;'><?php echo($_SESSION['output']); ?></p>
		<!-- Load admin change log from database (always up-to-date) -->
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