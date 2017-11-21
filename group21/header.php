<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
    Created by Group 21
    File: <?php echo "$fileName \n"; ?>
    Date: <?php echo "$date \n"; ?>
-->
    <?php 
	require('includes/constants.php');
	require('includes/db.php');
	require('includes/functions.php');
	?>
    <?php ob_start();
    session_start(); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link rel="stylesheet" href="./css/crush.css" type="text/css" />
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab" />
	<meta name="theme-color" content="#4A7C59" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8;" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo "$title";?></title>
    <link rel="shortcut icon" type="image/x-icon" href="./images/cc_logo.png" />

</head>

<body>
    <div id="container">
        <div id="header" >
			<a href="./index.php" ><img class="grow" src="./images/cc_logo.png" alt="Campus Crush" /></a>
			<h1 class="ccmain"><?php echo $banner; ?></h1>
        </div>
		
		<?php
		echo('<div id="sites" class="w3-bar">');
		
			if(!isset($_SESSION['username']))
			{
				echo('<a href="./user-login.php" class="w3-bar-item w3-button">Login</a>');
				echo('<a href="./user-register.php" class="w3-bar-item w3-button">Register</a>');
			}
			else
			{
				echo('<a href="./dashboard.php" class="w3-bar-item w3-button">Dashboard</a>
						<a href="./profile-search.php" class="w3-bar-item w3-button">Search</a>');
						
			
				echo('
				<div class="w3-dropdown-hover">
					<a class="w3-bar-item w3-button">Profile</a>
					<div class="w3-dropdown-content w3-bar-block w3-card-4">');
					
					if($_SESSION['account_type'] == INCOMPLETE)
					{
						echo('
						<a href="./profile-create.php" class="w3-bar-item w3-button">Complete Profile</a>
						<a href="./user-update.php" class="w3-bar-item w3-button">Update Account</a>');
					}
					elseif($_SESSION['account_type'] == ADMIN)
					{
						echo('
						<a href="./user-update.php" class="w3-bar-item w3-button">Update Account</a>');
					}
					elseif($_SESSION['account_type'] == CLIENT)
					{
						echo('
						<a href="./profile-display.php?user=' . $_SESSION['username'] . '" class="w3-bar-item w3-button">Public Profile</a>
						<a href="./profile-create.php" class="w3-bar-item w3-button">Manage Profile</a>
						<a href="./user-update.php" class="w3-bar-item w3-button">Update Account</a>');
					}
					
					echo('<a href="./user-logout.php" class="w3-bar-item w3-button">Logout</a>');
			}
			echo('</div>
			  </div>
		</div>');
		?>
	</div>
	<div id="content-container">
		<div id="content">